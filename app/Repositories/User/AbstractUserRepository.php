<?php

namespace App\Repositories\User;

abstract class AbstractUserRepository
{
    public abstract function create(array $data);
}
