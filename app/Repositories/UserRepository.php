<?php

namespace App\Repositories;

use \App\Interfaces\Repositories\IUserRepository;
use App\Models\User;


class UserRepository implements IUserRepository
{

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return User::findOrFail($id)->load('profile');
    }
}