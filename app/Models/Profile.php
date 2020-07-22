<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskManager\Image;

class Profile extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
