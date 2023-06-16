<?php

namespace App\Services\Task;

use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

final class TaskService extends AbstractTaskService
{
    /**
     * @throws Exception
     */
    public function userHasAccessToTask(int $userId, int $taskId): bool
    {
        $user = User::findOrFail($userId);
        $task = Task::findOrFail($taskId);

        if (
            $task->user_id == $user->id
        ) {
            return true;
        } else {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => 'User has no assess to this task.'
            ]));
        }
    }
}
