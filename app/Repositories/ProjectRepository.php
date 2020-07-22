<?php

namespace App\Repositories;

use \App\Interfaces\Repositories\IProjectRepository;
use App\Models\TaskManager\Project;


class ProjectRepository implements IProjectRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return Project::get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Project::findOrFail($id);
    }

    /**
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function getAllWithPaginate(int $limit)
    {
        return Project::paginate($limit);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id)
    {
        return Project::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return Project::count();
    }
}