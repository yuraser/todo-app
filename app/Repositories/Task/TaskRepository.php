<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param array $filters
     * @return Collection
     */
    public function getByFiltered(array $filters): Collection
    {
        // TODO: Implement getByFiltered() method.
    }

    /**
     * @param int $id
     * @return Task
     */
    public function getById(int $id): Task
    {
        // TODO: Implement getById() method.
    }

    /**
     * @param int $id
     * @param int $statusId
     * @return void
     */
    public function setStatus(int $id, int $statusId)
    {
        // TODO: Implement setStatus() method.
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }
}
