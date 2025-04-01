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

    /*
        {
            "email":"user@correo.com",
            "password":"123Tamarindo"
        }
    */
    Route::post('/login', [AuthController::class, 'login']);

    /**
     * Esto desacativa el token (deberias borrarlo del localstorage)
     * 
     * Header Authorization*/
    Route::post('/logout', [AuthController::class, 'logout']);

    /** 
     * Esto regresa un token nuevo y desactiva el anterior
     * 
     * Header Authorization */
    Route::post('/refresh', [AuthController::class, 'refresh'])/* ->middleware(RoleMiddleware::class.':1') */;

    /**
     * Esto regresa los datos de usuario
     *  
     * Header Authorization */
    Route::post('/me', [AuthController::class, 'me']);

    /** 
     * Esto regresa todas las carreras
     * 
     * Header Authorization 
    */
    Route::get('/career', [CareerController::class, 'index'])->middleware(RoleMiddleware::class . ':0');

    /**
     * Dependiendo de si al final de la URL de la peticion pones un /1 o /2 regresa los estudiantes o los profes
     *
     * Ejemplo de URL: http://127.0.0.1:8000/api/auth/user/2
     * (Regresara todos los alumnos)
     * 
     * Header Authorization 
     */
    Route::get('/user/{role}', [UserController::class, 'users'])->middleware(RoleMiddleware::class . ':0');

    /**
     * Esto ocupa un multipart form donde ademas de los archivos mandes un json con el id de el aviso al que pertenecen. 
     */
    Route::post('/file', [FileController::class, 'uploadFiles'])->middleware(RoleMiddleware::class . ':0');

    /**
     * Esto regresa los subjects a los que pertenece el usuario.
     * 
     * Header Authorization
     */
    Route::get('/subjects', [UserController::class, 'subjects'])->middleware(RoleMiddleware::class . ':0');

    /**
     * Esto regresa los datos de un archivo en especifico (De momento no regresa los archivos con el para eso hay otra peticon)
     * 
     * Ejemplo de URL: http://127.0.0.1:8000/api/auth/notices/1
     * (Regresara los datos del aviso con id 1)
     */
    Route::get('/notices/{id}', [NoticeController::class, 'notices'])->middleware(RoleMiddleware::class . ':0');
});

Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'teacher'
    ],
    function ($router) {
        /**
         * ================================
         * Estas rutas son solo del maestro
         * ================================
         */

        /**
         * Esto guarda clases en la base de datos
         * 
         * {
         *   "name":"Programación Web",
         *   "description":"SI",
         *   "career_id":1,
         *   "grade":"6to Cuatrimestre"
         *   }
         */
        Route::post('/subject/subject', [SubjectController::class, 'store'])->middleware(RoleMiddleware::class . ':1');

        /**
         * Esto agrega 1 o más usuarios a una clase es necesario mandar el id de la clase en cuestrion.
         * 
         * {
         *   "subject":1,
         *   "users":[2,3,4,5]
         * }
         */
        Route::post('/subject/users', [SubjectController::class, 'addUsers'])->middleware(RoleMiddleware::class . ':1');

        /**
         * Esto guarda avisos en la base de datos
         * 
         * {
         *       "message":"Hola",
         *       "subject":1
         * }
         */
        Route::post('/subject/notice', [NoticeController::class, 'store'])->middleware(RoleMiddleware::class . ':1');
    }
);
