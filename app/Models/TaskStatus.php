<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
   	protected $fillable = [
    	'name',
    ];

    public function project()
    {
        return $this->hasMany(Project::class, 'status_id', 'id');
    }
}
