<?php

namespace App\Services\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
{
    /**
     * @var array
     */
    protected array $request;

    /**
     * @var int
     */
    protected int $userId;

    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * @param array $request
     * @param int $userId
     */
    public function __construct(
        array $request,
        int $userId
    )
    {
        $this->request = $request;
        $this->userId = $userId;
    }

    /**
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            $method = $field;
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], (array)$value);
            }
        }
    }

    /**
     * @return array
     */
    protected function fields(): array
    {
        return array_filter(
            array_map('trim', $this->request)
        );
    }
}
