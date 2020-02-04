<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
   	protected $fillable = [
    	'name',
    ];

    public function project()
    {
        return $this->belongsTo('Project::class', 'foreign_key', 'status_id');
    }
}
