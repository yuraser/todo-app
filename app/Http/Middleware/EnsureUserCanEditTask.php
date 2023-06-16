<?php

namespace App\Http\Middleware;

use App\Services\Task\AbstractTaskService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCanEditTask
{

    /**
     * @var AbstractTaskService
     */
    private AbstractTaskService $taskService;

    /**
     * @param AbstractTaskService $taskService
     */
    public function __construct(
        AbstractTaskService $taskService
    )
    {
        $this->taskService = $taskService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->taskService->userHasAccessToTask(Auth::user()->id, $request->get('id'))) {
            return $next($request);
        }
    }
}
