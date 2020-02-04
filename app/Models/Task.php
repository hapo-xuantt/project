<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $fillable = [
		'name', 'description', 'project_id', 'began_at', 'finished_at', 'status_id', 'member_id',
	];

	public function member()
    {
        return $this->belongsTo('Member::class');
    }

    public function project()
    {
        return $this->belongsTo('Project::class');
    }

    public function statusTasks()
    {
        return $this->hasMany('App\StatusTask');
    }
}
