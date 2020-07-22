<?php

namespace App\Factories;

use \App\Interfaces\Factories\IIssueFactory;
use App\Models\TaskManager\Issue;
use Illuminate\Http\Request;

class IssueFactory implements IIssueFactory
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        return Issue::create($request->all());
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed|void
     */
    public function update(Request $request, int $id)
    {
        $issue = Issue::findOrFail($id);
        $issue->update($request->all());
        $issue->createEvents();
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id)
    {
        Issue::destroy($id);
    }

    /**
     * @param array $ids
     * @return mixed|void
     */
    public function destroyAll(array $ids)
    {
        Issue::destroy($ids);
    }
}