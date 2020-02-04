<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
   	protected $fillable = [
    	'name',
    ];

    public function project()
    {
        return $this->belongsTo('Project::class', 'foreign_key', 'status_id');
    }
}
