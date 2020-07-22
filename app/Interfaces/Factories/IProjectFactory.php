<?php

namespace App\Interfaces\Factories;

use Illuminate\Http\Request;

interface IProjectFactory
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);

    /**
     * @param array $ids
     * @return mixed
     */
    public function destroyAll(array $ids);
}