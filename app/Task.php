<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name',
        'user_id',
        'body',
    ];

    /**
     * Select all comments of ONE task.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'task_id', 'id');
    }


    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}