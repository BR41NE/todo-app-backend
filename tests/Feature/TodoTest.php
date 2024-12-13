<?php

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });
use App\Models\Task;


test('list all tasks', function () {
    $response = $this->get(route('tasks.list'));

    // dd($response->json());

    $response_data = $response->json();

    $this->assertEquals(200, $response->status());

    $this->assertEquals(3, count($response_data));

    // keys sent back
    $this->assertArrayHasKey('data', $response_data);

    $this->assertArrayHasKey('status', $response_data);

    $this->assertArrayHasKey('message', $response_data);

    $this->assertEquals('array', gettype($response_data['data']));

    $this->assertEquals('string', gettype($response_data['message']));

    $this->assertEquals('integer', gettype($response_data['status']));
});


test('create task', function () {
    $response = $this->post(route('tasks.create'), [
        'title' => 'Task 4',
        'description' => 'Description 4',
    ]);

    $response_data = $response->json();

    $this->assertEquals(201, $response->status());

    $this->assertEquals(3, count($response_data));

    // keys sent back
    $this->assertArrayHasKey('data', $response_data);

    $this->assertArrayHasKey('status', $response_data);

    $this->assertArrayHasKey('message', $response_data);

    // $this->assertEquals('array', gettype($response_data['data']));

    $this->assertEquals('string', gettype($response_data['message']));

    $this->assertEquals('integer', gettype($response_data['status']));
});


test('update task', function () {
    $task = Task::create([
        'title' => 'Task new',
        'description' => 'Description new',
    ]);

    $response = $this->post(route('tasks.update'), [
        'id' => $task->id,
        'title' => 'Task 4',
        'description' => 'Description 4',
        'status' => 'completed',
    ]);

    $response_data = $response->json();

    $this->assertEquals(200, $response->status());

    $this->assertEquals(3, count($response_data));

    // keys sent back
    $this->assertArrayHasKey('data', $response_data);

    $this->assertArrayHasKey('status', $response_data);

    $this->assertArrayHasKey('message', $response_data);

    // $this->assertEquals('array', gettype($response_data['data']));

    $this->assertEquals('string', gettype($response_data['message']));

    $this->assertEquals('integer', gettype($response_data['status']));
});


test('delete task', function () {
    $task = Task::first();
    $response = $this->post(route('tasks.delete'), [
        'id' => $task->id,
    ]);

    $response_data = $response->json();

    $this->assertEquals(200, $response->status());

    $this->assertEquals(3, count($response_data));


    // keys sent back
    $this->assertArrayHasKey('data', $response_data);

    $this->assertArrayHasKey('status', $response_data);

    $this->assertArrayHasKey('message', $response_data);

    // $this->assertEquals('array', gettype($response_data['data']));

    $this->assertEquals('string', gettype($response_data['message']));

    $this->assertEquals('integer', gettype($response_data['status']));
});
