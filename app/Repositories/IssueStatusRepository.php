<?php

namespace App\Repositories;

use \App\Interfaces\Repositories\IIssueStatusRepository;
use App\Models\TaskManager\IssueStatus;
use Illuminate\Http\Request;


class IssueStatusRepository implements IIssueStatusRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return IssueStatus::get();
    }

    /**
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function getAllWithPaginate(int $limit)
    {
        return IssueStatus::paginate($limit);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id)
    {
        return IssueStatus::findOrFail($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return IssueStatus::findOrFail($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        return IssueStatus::findOrFail($id);
    }
}