<?php

namespace App\Interfaces\Factories;

use Illuminate\Http\Request;

interface IFileFactory
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(array $params);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);
}