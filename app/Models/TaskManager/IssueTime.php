<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;

class IssueTime extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'time', 'event_id', 'issue_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(EventIssue::class);
    }
}
