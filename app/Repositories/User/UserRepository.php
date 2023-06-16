<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends UserRepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
