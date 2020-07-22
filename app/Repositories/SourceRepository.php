<?php

namespace App\Repositories;

use \App\Interfaces\Repositories\ISourceRepository;
use App\Models\TaskManager\Source;
use Illuminate\Http\Request;


class SourceRepository implements ISourceRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return Source::get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Source::findOrFail($id);
    }

    /**
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function getAllWithPaginate(int $limit)
    {
        return Source::paginate($limit);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id)
    {
        return Source::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return Source::count();
    }
}