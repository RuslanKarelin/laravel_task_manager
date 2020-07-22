<?php

namespace App\Models\TaskManager;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'price', 'email', 'phone', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
