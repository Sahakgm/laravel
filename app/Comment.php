<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'task_id',
        'comment',
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
