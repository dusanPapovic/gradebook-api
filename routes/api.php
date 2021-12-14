<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradebookController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/gradebooks/freeteachers', [AuthController::class, 'getFreeTeachers']);
Route::post('/gradebooks', [GradebookController::class, 'store']);
Route::get('/gradebooks', [GradebookController::class, 'index']);
Route::get('/teachers', [AuthController::class, 'index']);
Route::get('/teachers/{teacher}', [AuthController::class, 'show']);
Route::get('/gradebooks/{gradebook}', [GradebookController::class, 'show']);
Route::get('/my-gradebook', [GradebookController::class, 'myGradebook']);
Route::post('/gradebooks/{gradebook}/students', [StudentController::class, 'store']);
Route::post('/gradebooks/{gradebook}/comments', [CommentController::class, 'store']);
Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
Route::delete('/gradebooks/{gradebook}', [GradebookController::class, 'destroy']);


Route::post('/auth/login', [AuthController::class, 'login']);
//Route::get('/auth/me', [AuthController::class, 'getActiveUser'])->middleware('auth:api');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::post('/auth/refresh', [AuthController::class, 'refreshToken']);
