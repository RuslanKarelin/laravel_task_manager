<?php

namespace App\Models\TaskManager;


use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'source_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
