<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Models\Task;
use App\Traits\ResponseHelperTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Validator;
use Exception;

class TaskController extends Controller
{
    use ResponseHelperTrait;
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;

        $tasks = Task::paginate($limit);

        $data['tasks'] = TaskResource::collection($tasks);

        if ($data) {
            $data['pagination_links'] = PaginationHelper::paginationDetails($tasks);
        }

        return $this->response(
            Response::HTTP_OK,
            $data,
            'Tasks fetched successfully'
        );
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);


        if ($validation->fails()) {
            return $this->response(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $validation->errors(),
                'Validation error'
            );
        }

        Task::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return $this->response(
            Response::HTTP_CREATED,
            // data: [
            //     'task' => new TaskResource($task)
            // ],
            null,
            'Task created successfully'
        );
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id' => 'required',
            // 'id' => 'required|exists:' . Task::class . ',id',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:not_started,in_progress,completed',
        ]);


        if ($validation->fails()) {
            return $this->response(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $validation->errors(),
                'Validation error'
            );
        }
        try {

            $task = Task::where('id', $request->id)->first();

            if (!$task) {
                return $this->response(
                    Response::HTTP_NOT_FOUND,
                    null,
                    'Task not found'
                );
            }

            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status
            ]);

            return $this->response(
                Response::HTTP_OK,
                // data: [
                //     'task' => new TaskResource($task)
                // ],
                null,
                'Task updated successfully'
            );
        } catch (Exception $e) {
            return $this->response(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                null,
                'Something went wrong'
            );
        }
    }

    public function delete(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // 'id' => 'required|exists:' . Task::class . ',id',
            'id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->response(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $validation->errors(),
                'Validation error'
            );
        }

        try {
            $task = Task::where('id', $request->id)->first();
            if (!$task) {
                return $this->response(
                    Response::HTTP_NOT_FOUND,
                    null,
                    'Task not found'
                );
            }

            $task->delete();

            return $this->response(
                Response::HTTP_OK,
                null,
                'Task deleted successfully'
            );
        } catch (Exception $e) {
            return $this->response(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                null,
                'Something went wrong'
            );
        }
    }
}
