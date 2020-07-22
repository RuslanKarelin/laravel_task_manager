<?php

namespace App\Repositories;

use \App\Interfaces\Repositories\IFileRepository;
use App\Models\TaskManager\File;


class FileRepository implements IFileRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return File::get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return File::findOrFail($id);
    }

    /**
     * @param string $fileName
     * @return mixed
     */
    public function getByName(string $fileName)
    {
        return File::where('filename', $fileName)->first();
    }
}