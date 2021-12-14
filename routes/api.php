<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradebookController;

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

Route::get('/gradebooks/create', [GradebookController::class, 'create']);
Route::post('/gradebooks/create', [GradebookController::class, 'store']);

Route::post('/auth/login', [AuthController::class, 'login']);
//Route::get('/auth/me', [AuthController::class, 'getActiveUser'])->middleware('auth:api');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::post('/auth/refresh', [AuthController::class, 'refreshToken']);
