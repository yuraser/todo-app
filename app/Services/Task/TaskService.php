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

    public function taskHasUncomplitedChild(int $taskId): bool
    {
        $task = Task::findOrFail($taskId);
        foreach ($task->children as $child) {
            if ($child->status_id == 1) {
                throw new HttpResponseException(response()->json([
                    'success'   => false,
                    'message'   => 'Validation errors',
                    'data'      => 'User can not update this task because one of child tasks with id: ' . $child->id . ' has status todo.'
                ]));
            }
            if ($child->children) {
                $this->taskHasUncomplitedChild($child->id);
            }
        }

        return true;
    }
}
