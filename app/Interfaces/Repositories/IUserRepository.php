<?php

namespace App\Interfaces\Repositories;

interface IUserRepository
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);
}