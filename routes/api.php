<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::controller(UserController::class)
//     ->middleware('guest')
//     ->group(function () {
//         // register route
//         Route::post('/register', 'register');

//         // login route
//         Route::post('/login', 'login');
//     });


Route::controller(TaskController::class)
    ->prefix('tasks')
    ->group(function () {
        Route::get('/', 'index')->name('tasks.list');
        // create route
        Route::post('/create', 'create')->name('tasks.create');
        // update route
        Route::post('/update', 'update')->name('tasks.update');
        // delete route
        Route::post('/delete', 'delete')->name('tasks.delete');
    });
