<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\Task\AbstractTaskRepository;
use App\Services\Task\Filter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * @var AbstractTaskRepository
     */
    public AbstractTaskRepository $taskRepository;

    /**
     * @param AbstractTaskRepository $taskRepository
     */
    public function __construct(
        AbstractTaskRepository $taskRepository
    )
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param Request $request
     * @return TaskResource
     */
    public function index(Request $request): TaskResource
    {
        return new TaskResource(Task::where('id', '=', 2001)->inRandomOrder()->first());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $this->taskRepository->create($request->all());
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function edit(Request $request): JsonResponse
    {
        try {
            $this->taskRepository->update($request->get('id'), $request->all());
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        try {
            $this->taskRepository->delete($request->get('id'));
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function setStatus(Request $request): JsonResponse
    {
        try {
            $this->taskRepository->setStatus($request->get('id'), $request->get('status_id'));
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        try {
            $tasks = $this->taskRepository->getByFiltered($request->all(), new Filter($request->all(), Auth::id()));
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => true, 'tasks' => $tasks]);
    }
}
