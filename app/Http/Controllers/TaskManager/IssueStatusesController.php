<?php

namespace App\Http\Controllers\TaskManager;

use App\Http\Requests\IssueStatusRequest;
use App\Interfaces\Repositories\IIssueStatusRepository;
use App\Interfaces\Factories\IIssueStatusFactory;

class IssueStatusesController extends BaseController
{

    protected $issueStatusRepository;
    protected $issueStatusFactory;

    /**
     * IssueStatusesController constructor.
     * @param IIssueStatusRepository $issueStatusRepository
     * @param IIssueStatusFactory $issueStatusFactory
     */
    public function __construct(IissueStatusRepository $issueStatusRepository, IissueStatusFactory $issueStatusFactory)
    {
        $this->issueStatusRepository = $issueStatusRepository;
        $this->issueStatusFactory = $issueStatusFactory;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function index()
    {
        parent::index();
        $statuses = $this->issueStatusRepository->getAllWithPaginate(env('PAGINATE_LIMIT'));
        return view('taskmanager.status.statuses', compact('statuses'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('taskmanager.status.create_status');
    }

    /**
     * @param IssueStatusRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(IssueStatusRequest $request)
    {
        $status = $this->issueStatusFactory->create($request);
        return redirect(route('issue-statuses.index'))->with('status', 'status created, id=' . $status->id);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $status = $this->issueStatusRepository->getById($id);
        return view('taskmanager.status.edit_status', compact(['status']));
    }

    /**
     * @param IssueStatusRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(IssueStatusRequest $request, int $id)
    {
        $this->issueStatusFactory->update($request, $id);
        return redirect(route('issue-statuses.edit', $id))->with('status', 'status updated, id=' . $id);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(int $id)
    {
        $this->issueStatusFactory->destroy($id);
        return redirect(route('issue-statuses.index'))->with('status', 'status deleted, id=' . $id);
    }
}
