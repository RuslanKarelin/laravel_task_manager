<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;

class IssueStatus extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issues()
    {
        return $this->hasMany(Issue::class, 'status_id');
    }
}
