<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @param Request $request
     * @return TaskResource
     */
    public function index(Request $request): TaskResource
    {
        return new TaskResource(Task::where('id', '=', 2001)->inRandomOrder()->first());
    }
}
