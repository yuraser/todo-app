<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Middleware\EnsureUserCanEditTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/random-task', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/task/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/task/edit', [TaskController::class, 'edit'])->name('tasks.edit')->middleware(EnsureUserCanEditTask::class);
    Route::post('/task/delete', [TaskController::class, 'delete'])->name('tasks.delete')->middleware(EnsureUserCanEditTask::class);
    Route::post('/task/set-status', [TaskController::class, 'setStatus'])->name('tasks.setStatus')->middleware(EnsureUserCanEditTask::class);
    Route::get('/task/search', [TaskController::class, 'getFiltered'])->name('tasks.getFiltered');
});
