<?php

namespace App\Factories;

use \App\Interfaces\Factories\IIssueStatusFactory;
use App\Models\TaskManager\IssueStatus;
use Illuminate\Http\Request;

class IssueStatusFactory implements IIssueStatusFactory
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        return IssueStatus::create($request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed|void
     */
    public function update(Request $request, int $id)
    {
        $source = IssueStatus::findOrFail($id);
        $source->update($request->all());
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id)
    {
        IssueStatus::destroy($id);
    }

    /**
     * @param array $ids
     * @return mixed|void
     */
    public function destroyAll(array $ids)
    {
        IssueStatus::destroy($ids);
    }
}