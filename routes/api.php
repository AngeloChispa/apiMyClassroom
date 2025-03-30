<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\SubjectController;
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

    Route::get('/career', [CareerController::class, 'index'])->middleware(RoleMiddleware::class.':1');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'teacher'
], function($router){
    Route::post('/subject/store', [SubjectController::class, 'store'])->middleware(RoleMiddleware::class.':1');
}   
); 
