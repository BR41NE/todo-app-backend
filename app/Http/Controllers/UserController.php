<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseHelperTrait;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use ResponseHelperTrait;

    public function register(Request $request)
    {
        return $this->response(200, $request->all(), 'User registered successfully');
    }

    public function login(Request $request)
    {
        return $this->response(
            Response::HTTP_ACCEPTED,
            $request->all(),
            'User logged in successfully'
        );
    }
}
