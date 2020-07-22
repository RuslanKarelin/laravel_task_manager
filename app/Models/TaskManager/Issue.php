<?php

namespace App\Models\TaskManager;

use App\Facades\TMHelper;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    /**
     * @var array
     */
    protected $observables = [
        'addEvents'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'status_id', 'project_id', 'estimate', 'completion', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(IssueStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function times()
    {
        return $this->hasMany(IssueTime::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(EventIssue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * @return string
     */
    public function getFullTimePriceAttribute()
    {
        return number_format($this->times->sum('time') * $this->project->source->price, 0, ',', ' ');
    }

    /**
     * @return string
     */
    public function getEstimateTimePriceAttribute()
    {
        return number_format($this->estimate * $this->project->source->price, 0, ',', ' ');
    }

    /**
     * @return mixed
     */
    public function getFullTimeAttribute()
    {
        return TMHelper::formateTime($this->times->sum('time'));
    }

    /**
     * @return mixed
     */
    public function getFormatEstimateAttribute()
    {
        return TMHelper::formateTime($this->estimate);
    }

    /**
     *
     */
    public function createEvents()
    {
        $this->fireModelEvent('addEvents', false);
    }
}
