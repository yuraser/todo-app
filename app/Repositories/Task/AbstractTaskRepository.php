<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Illuminate\Support\Collection;

abstract class AbstractTaskRepository
{
    public abstract function getById(int $id): Task;

    public abstract function getByFiltered(array $filters): Collection;

    public abstract function create(array $data);

    public abstract function update(int $id, array $data);

    public abstract function delete(int $id);

    public abstract function setStatus(int $id, int $statusId);
}
