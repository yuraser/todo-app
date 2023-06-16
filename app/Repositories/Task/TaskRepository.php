<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Services\Filter\QueryFilter;
use Exception;
use Illuminate\Support\Collection;

class TaskRepository extends AbstractTaskRepository
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        // It would be great to use DTO
        return Task::create([
            'name' => (string) $data['name'],
            'priority' => (int) $data['priority'],
            'description' => (string) $data['description'],
            'user_id' => (int) $data['user_id'],
            'status_id' => (int) $data['status_id'],
            'parent_id' => (int) $data['parent_id'],
        ]);
    }

    /**
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function delete(int $id)
    {
        $task = Task::findOrFail($id);

        if ($task->status->id == 2) {
            throw new Exception('User can not delete complited tasks.');
        }

        Task::destroy($id);
    }

    /**
     * @param array $filters
     * @param QueryFilter $filter
     * @return Collection
     */
    public function getByFiltered(array $filters, QueryFilter $filter): Collection
    {
        return Task::filter($filter)->get();
    }

    /**
     * @param int $id
     * @return Task
     */
    public function getById(int $id): Task
    {
        return Task::findOrFail($id);
    }

    /**
     * @param int $id
     * @param int $statusId
     * @return void
     */
    public function setStatus(int $id, int $statusId)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'status_id' => $statusId,
            'completed_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data)
    {
        $task = Task::findOrFail($id);
        if ($data['status_id']) {
            $data['completed_at'] = date('Y-m-d H:i:s');
        }
        $task->update($data);
    }
}
