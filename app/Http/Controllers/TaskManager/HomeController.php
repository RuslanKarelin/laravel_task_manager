<?php

namespace App\Http\Controllers\TaskManager;

use App\Interfaces\Repositories\IIssueRepository;
use App\Interfaces\Repositories\ICommentRepository;
use App\Interfaces\Repositories\ISourceRepository;
use App\Interfaces\Repositories\IProjectRepository;
use App\Facades\TMHelper;

class HomeController extends BaseController
{
    protected $issueRepository;
    protected $commentRepository;
    protected $sourceRepository;
    protected $projectRepository;

    /**
     * HomeController constructor.
     * @param IIssueRepository $issueRepository
     * @param ICommentRepository $commentRepository
     * @param ISourceRepository $sourceRepository
     * @param IProjectRepository $projectRepository
     */
    public function __construct(
        IIssueRepository $issueRepository,
        ICommentRepository $commentRepository,
        ISourceRepository $sourceRepository,
        IProjectRepository $projectRepository
    )
    {
        $this->issueRepository = $issueRepository;
        $this->commentRepository = $commentRepository;
        $this->sourceRepository = $sourceRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $statisticData = $this->issueRepository->getStatisticData();
        extract(TMHelper::prepareStatisticData($statisticData));
        $issueCount = $this->issueRepository->getCount();
        $sourceCount = $this->sourceRepository->getCount();
        $projectCount = $this->projectRepository->getCount();
        $comments = $this->commentRepository->getLast(3);
        return view('taskmanager.home',
            compact(['sumTime', 'sumEstimate', 'issueCount', 'comments', 'sourceCount', 'projectCount'])
        );
    }
}
