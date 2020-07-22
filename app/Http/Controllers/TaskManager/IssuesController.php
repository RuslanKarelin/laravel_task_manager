<?php

namespace App\Http\Controllers\TaskManager;

use App\Http\Requests\IssueRequest;
use App\Interfaces\Repositories\IIssueRepository;
use App\Interfaces\Factories\IIssueFactory;
use App\Interfaces\Repositories\IProjectRepository;
use App\Interfaces\Repositories\IIssueStatusRepository;
use App\Interfaces\Services\IIssuesFilter;

class IssuesController extends BaseController
{

    protected $issueRepository;
    protected $issueFactory;

    /**
     * IssuesController constructor.
     * @param IIssueRepository $issueRepository
     * @param IIssueFactory $issueFactory
     */
    public function __construct(IIssueRepository $issueRepository, IIssueFactory $issueFactory)
    {
        $this->issueRepository = $issueRepository;
        $this->issueFactory = $issueFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        parent::index();
        $issues = $this->issueRepository->getAllWithPaginate(env('PAGINATE_LIMIT'));
        extract($this->getData());
        return view('taskmanager.issue.issues', compact(['issues', 'order', 'projects', 'statuses']));
    }


    /**
     * @param IProjectRepository $projectRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(IProjectRepository $projectRepository)
    {
        $projects = $projectRepository->getAll();
        return view('taskmanager.issue.create_issue', compact(['projects']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(IssueRequest $request)
    {
        $issue = $this->issueFactory->create($request);
        return redirect(route('issues.index'))->with('status', 'issue created, id=' . $issue->id);
    }


    /**
     * @param IProjectRepository $projectRepository
     * @param IIssueStatusRepository $issueStatusRepository
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(
        IProjectRepository $projectRepository,
        IIssueStatusRepository $issueStatusRepository,
        int $id
    )
    {
        return view('taskmanager.issue.show_issue',
            $this->getIssue($projectRepository, $issueStatusRepository, $id)
        );
    }


    /**
     * @param IProjectRepository $projectRepository
     * @param IIssueStatusRepository $issueStatusRepository
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(
        IProjectRepository $projectRepository,
        IIssueStatusRepository $issueStatusRepository,
        int $id
    )
    {
        return view('taskmanager.issue.edit_issue',
            $this->getIssue($projectRepository, $issueStatusRepository, $id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(IssueRequest $request, int $id)
    {
        $this->issueFactory->update($request, $id);
        return redirect(route('issues.edit', $id))->with('status', 'issue updated, id=' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->issueFactory->destroy($id);
        return redirect(route('issues.index'))->with('status', 'issue deleted, id=' . $id);
    }

    /**
     * @param IIssuesFilter $filterBuilder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(IIssuesFilter $filterBuilder)
    {
        extract($filterBuilder->build());
        extract($this->getData());
        return view('taskmanager.issue.issues_filter',
            compact(['issues', 'order', 'projects', 'statuses', 'issueCount', 'sumTime', 'sumEstimate'])
        );
    }

    /**
     * @param IProjectRepository $projectRepository
     * @param IIssueStatusRepository $issueStatusRepository
     * @param int $id
     * @return array
     */
    protected function getIssue(
        IProjectRepository $projectRepository,
        IIssueStatusRepository $issueStatusRepository,
        int $id)
    {
        return [
            'issue' => $this->issueRepository->getById($id),
            'projects' => $projectRepository->getAll(),
            'statuses' => $issueStatusRepository->getAll()
        ];
    }

    /**
     * @return array
     */
    protected function getData()
    {
        return [
            'projects' => app('App\Interfaces\Repositories\IProjectRepository')->getAll(),
            'statuses' => app('App\Interfaces\Repositories\IIssueStatusRepository')->getAll(),
            'order' => request()->input('order') == 'asc' ? 'desc' : 'asc'
        ];
    }
}
