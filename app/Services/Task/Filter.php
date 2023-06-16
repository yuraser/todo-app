<?php

namespace App\Services\Task;

use App\Services\Filter\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class Filter extends QueryFilter
{
    /**
     * @param int $status
     */
    public function status(int $status): void
    {
        $this->builder->where('status_id', $status)->where('user_id', $this->userId);
    }

    /**
     * @param int $priority
     */
    public function priority(int $priority): void
    {
        $this->builder->where('priority', $priority)->where('user_id', $this->userId);
    }

    /**
     * @param string $title
     */
    public function name(string $title): void
    {
        $words = array_filter(explode(' ', $title));

        // Better not to use `LIKE` but i have no time =)
        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('name', 'like', "%$word%");
            }
        });
    }

    public function created_at(string $direction): void
    {
        $this->builder->where('user_id', $this->userId)->orderBy('created_at', $direction);
    }

    public function updated_at(string $direction): void
    {
        $this->builder->where('user_id', $this->userId)->orderBy('updated_at', $direction);
    }

    public function completed_at(string $direction): void
    {
        $this->builder->where('user_id', $this->userId)->orderBy('completed_at', $direction);
    }

}
