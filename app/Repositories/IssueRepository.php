<?php

namespace App\Repositories;

use \App\Interfaces\Repositories\IIssueRepository;
use App\Models\TaskManager\Issue;
use Illuminate\Http\Request;


class IssueRepository implements IIssueRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return Issue::with(['status', 'project', 'times', 'project.source'])->get();
    }

    /**
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function getAllWithPaginate(int $limit)
    {
        $issue = Issue::with(['status', 'project', 'times', 'project.source']);
        $sort = 'id';
        $order = 'desc';
        if (request()->has('sort')) {
            $sort = request()->input('sort');
            $order = request()->input('order');
        }
        $issue->orderBy($sort, $order);
        return $issue->paginate($limit);
    }

    /**
     * @return mixed
     */
    public function getBuilder()
    {
        return Issue::with(['status', 'project', 'times', 'project.source']);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Issue::findOrFail($id)->load('status', 'project', 'times', 'events', 'events.comments', 'files', 'project.source');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id)
    {
        return Issue::findOrFail($id)->load('status', 'project', 'times', 'files', 'events', 'events.comments', 'project.source');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getStatisticData()
    {
        return Issue::with(['status', 'project', 'times'])
            ->whereYear('created_at', date('Y'))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->month;
            });;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return Issue::count();
    }

    /**
     * @param $builder
     * @param $field
     * @param $firstValue
     * @param $lastValue
     * @return mixed
     */
    public function whereBetween($builder, $field, $firstValue, $lastValue)
    {
        return $builder->whereBetween($field, [$firstValue, $lastValue]);
    }

    /**
     * @param $builder
     * @param $field
     * @param $value
     * @return mixed
     */
    public function where($builder, $field, $value)
    {
        return $builder->where($field, $value);
    }

    /**
     * @param $builder
     * @param $limit
     * @return mixed
     */
    public function paginate($builder, $limit)
    {
        return $builder->paginate($limit);
    }
}