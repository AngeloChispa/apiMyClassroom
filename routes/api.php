<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh'])/* ->middleware(RoleMiddleware::class.':1') */;
    Route::post('/me', [AuthController::class, 'me']);

    Route::get('/career', [CareerController::class, 'index'])->middleware(RoleMiddleware::class.':0');
    Route::get('/user/{role}', [UserController::class, 'users'])->middleware(RoleMiddleware::class.':0');
    Route::post('/file', [FileController::class, 'uploadFiles'])->middleware(RoleMiddleware::class.':0');
    Route::get('/subjects', [UserController::class, 'subjects'])->middleware(RoleMiddleware::class.':0');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'teacher'
], function($router){
    Route::get('/subjects', [SubjectController::class, 'index'])->middleware(RoleMiddleware::class.':1');
    Route::post('/subject/subject', [SubjectController::class, 'store'])->middleware(RoleMiddleware::class.':1');
    Route::post('/subject/users', [SubjectController::class, 'addUsers'])->middleware(RoleMiddleware::class.':1');
    Route::post('/subject/notice', [NoticeController::class, 'store'])->middleware(RoleMiddleware::class.':1');
}   
); 
