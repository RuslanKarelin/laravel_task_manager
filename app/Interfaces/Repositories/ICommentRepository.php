<?php

namespace App\Interfaces\Repositories;

interface ICommentRepository
{
    /**
     * @return mixed
     */
    public function getLast($limit);
}