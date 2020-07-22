<?php

namespace App\Interfaces\Repositories;

interface IFileRepository
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param string $fileName
     * @return mixed
     */
    public function getByName(string $fileName);
}