<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;

class EventIssue extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'body', 'issue_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function time()
    {
        return $this->hasOne(IssueTime::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
