<?php

namespace App\Factories;

use \App\Interfaces\Factories\IFileFactory;
use App\Models\TaskManager\File;
use Illuminate\Http\Request;

class FileFactory implements IFileFactory
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(array $params)
    {
        return File::create($params);
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id)
    {
        File::destroy($id);
    }
}