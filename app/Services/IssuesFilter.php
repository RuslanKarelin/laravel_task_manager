<?php

namespace App\Services;

use App\Interfaces\Services\IIssuesFilter;
use Illuminate\Http\Request;
use App\Interfaces\Repositories\IIssueRepository;
use App\Facades\TMHelper;

class IssuesFilter implements IIssuesFilter
{
    protected $request;
    protected $issues;
    protected $issueRepository;

    /**
     * IssuesFilter constructor.
     * @param Request $request
     * @param IIssueRepository $repository
     */
    public function __construct(Request $request, IIssueRepository $repository)
    {
        $this->request = $request;
        $this->issues = $repository->getBuilder();
        $this->issueRepository = $repository;
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $this->status()
            ->project()
            ->date();

        return $this->afterBuild();
    }

    /**
     * @return $this|mixed
     */
    public function status()
    {
        if ($this->request->has('status_id') && !empty($this->request->input('status_id'))) {
            $this->issues = $this->issueRepository
                ->where(
                    $this->issues,
                    'status_id',
                    $this->request->input('status_id')
                );
        }
        return $this;
    }

    /**
     * @return $this|mixed
     */
    public function project()
    {
        if ($this->request->has('project_id') && !empty($this->request->input('project_id'))) {
            $this->issues = $this->issueRepository
                ->where(
                    $this->issues,
                    'project_id',
                    $this->request->input('project_id')
                );
        }
        return $this;
    }


    /**
     * @return $this|mixed
     */
    public function date()
    {
        if ($this->request->has('date') && !empty($this->request->input('date'))) {
            $dateRange = explode(' - ', $this->request->input('date'));
            $this->issues = $this->issueRepository
                ->whereBetween(
                    $this->issues,
                    $this->request->input('dateType') ?? 'created_at',
                    $dateRange[0],
                    $dateRange[1]
                );
        }
        return $this;
    }

    /**
     * @return array|mixed
     */
    public function afterBuild()
    {
        extract(TMHelper::sumTimeAndEstimate($this->issues));
        $sumTime = number_format($sumTime, 0, ',', ' ');
        $sumEstimate = number_format($sumEstimate, 0, ',', ' ');
        $issues = $this->issueRepository->paginate($this->issues, env('PAGINATE_LIMIT'));
        $issueCount = $issues->total();
        return compact(['sumTime', 'sumEstimate', 'issues', 'issueCount']);
    }
}