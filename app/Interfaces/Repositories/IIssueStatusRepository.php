<?php

namespace App\Interfaces\Repositories;

interface IIssueStatusRepository
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param int $limit
     * @return mixed
     */
    public function getAllWithPaginate(int $limit);

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id);
}