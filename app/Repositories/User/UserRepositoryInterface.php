<?php

namespace App\Repositories\User;

abstract class UserRepositoryInterface
{
    public abstract function create(array $data);
}
