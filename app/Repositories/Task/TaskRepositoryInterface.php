<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function getById(int $id): Task;

    public function getByFiltered(array $filters): Collection;

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function setStatus(int $id, int $statusId);
}
