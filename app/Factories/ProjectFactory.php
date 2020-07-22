<?php

namespace App\Factories;

use \App\Interfaces\Factories\IProjectFactory;
use App\Models\TaskManager\Project;
use Illuminate\Http\Request;

class ProjectFactory implements IProjectFactory
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        return Project::create($request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed|void
     */
    public function update(Request $request, int $id)
    {
        $source = Project::findOrFail($id);
        $source->update($request->all());
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id)
    {
        Project::destroy($id);
    }

    /**
     * @param array $ids
     * @return mixed|void
     */
    public function destroyAll(array $ids)
    {
        Project::destroy($ids);
    }
}