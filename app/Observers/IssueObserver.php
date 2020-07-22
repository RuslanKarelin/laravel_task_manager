<?php

namespace App\Observers;

use App\Interfaces\Repositories\IIssueStatusRepository;
use App\Models\TaskManager\Issue;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Facades\TMHelper;
use Illuminate\Support\Facades\Storage;

class IssueObserver
{
    const NEW_ISSUE_SATUS = 1;
    const BEGINNING_ISSUE_SATUS = 2;
    const DECIDED_ISSUE_SATUS = 5;
    const CLOSED_ISSUE_SATUS = 6;

    protected $request;
    protected $issueStatusRepository;

    /**
     * IssueObserver constructor.
     * @param Request $request
     * @param IIssueStatusRepository $issueStatusRepository
     */
    public function __construct(Request $request, IIssueStatusRepository $issueStatusRepository)
    {
        $this->request = $request;
        $this->issueStatusRepository = $issueStatusRepository;
    }

    /**
     * @param Issue $issue
     */
    public function addEvents(Issue $issue)
    {
        $this->createEvents($issue);
    }

    /**
     * Handle the issue "created" event.
     *
     * @param  \App\Issue $issue
     * @return void
     */
    public function created(Issue $issue)
    {
        $this->createEvents($issue);
    }

    /**
     * @param Issue $issue
     */
    public function creating(Issue $issue)
    {
        $issue->status_id = static::NEW_ISSUE_SATUS;
    }

    /**
     * Handle the issue "updated" event.
     *
     * @param  \App\Issue $issue
     * @return void
     */
    public function updating(Issue $issue)
    {
        if ($issue->isDirty('status_id')) {

            $dirtyStatusId = $issue->getDirty()['status_id'];

            if ($dirtyStatusId == static::BEGINNING_ISSUE_SATUS && $issue->beginning === null) {
                $issue->beginning = Carbon::now()->toDateTimeString();
            }

            if ($dirtyStatusId == static::DECIDED_ISSUE_SATUS || $dirtyStatusId == static::CLOSED_ISSUE_SATUS) {
                $issue->completion = Carbon::now()->toDateTimeString();
            }
        }
    }

    /**
     * @param Issue $issue
     */
    public function deleting(Issue $issue)
    {
        $issue->files->each(function ($file) {
            Storage::deleteDirectory(env('FILES_PATH') . $file->filename);
        });
    }

    /**
     * @param Issue $issue
     * @return string
     */
    protected function createEventBody(Issue $issue): string
    {
        $eventBody = '';
        if ($this->request->input('dirty_status_id') != $issue->status_id) {
            $eventBody .= __('app.Status changed to') . $issue->status->name . '. ';
        }

        if (
            $this->request->has('estimate') &&
            $this->request->input('dirty_estimate') != $issue->estimate &&
            $issue->estimate != 0
        ) {
            $eventBody .= __('app.Evaluating the issue') . TMHelper::formateTime($this->request->input('estimate')) . '. ';
        }

        if ($this->request->has('time') && !empty($this->request->input('time'))) {
            $eventBody .= __('app.Time deducted') . TMHelper::formateTime($this->request->input('time')) . '.';
        }

        return $eventBody;
    }

    /**
     * @param Issue $issue
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function createEvent(Issue $issue)
    {
        return $issue->events()->create(['body' => $this->createEventBody($issue)]);
    }

    /**
     * @param Issue $issue
     */
    protected function createEvents(Issue $issue)
    {
        $event = null;

        if ($this->request->input('dirty_status_id') != $issue->status_id) {
            $event = $this->createEvent($issue);
        }

        if ($this->request->has('estimate') && $this->request->input('dirty_estimate') != $issue->estimate) {
            $event = $event ?? $this->createEvent($issue);
        }

        if ($this->request->has('time') && !empty($this->request->input('time'))) {
            $event = $event ?? $this->createEvent($issue);
            $issue->times()->create([
                'time' => floatval($this->request->input('time')),
                'event_id' => $event->id
            ]);
        }

        if ($this->request->has('comment') && !empty(trim($this->request->input('comment')))) {
            $event = $event ?? $this->createEvent($issue);
            $event->comments()->create(['body' => $this->request->input('comment')]);
        }
    }
}
