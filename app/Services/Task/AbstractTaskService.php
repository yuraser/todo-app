<?php

namespace App\Services\Task;

abstract class AbstractTaskService
{
    /**
     * @param int $userId
     * @param int $taskId
     * @return bool
     */
    public abstract function userHasAccessToTask(int $userId, int $taskId): bool;
}
