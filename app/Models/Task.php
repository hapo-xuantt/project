<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $fillable = [
		'name', 'description', 'project_id', 'began_at', 'finished_at', 'status_id', 'member_id',
	];

	public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function taskStatuses()
    {
        return $this->belongsto(TaskStatus::class, 'status_id');
    }

    public function scopeSearchByProject($query, $request)
    {
        $query->join('projects', 'tasks.project_id', '=', 'projects.id')->select('tasks.*')->where('projects.name', 'like', '%' . $request->searchByProject . '%');
        return $query;
    }

    public function scopeSearchByMember($query, $request)
    {
        $query->join('members', 'tasks.member_id', '=', 'members.id')->select('tasks.*')->where('members.name', 'like', '%' . $request->searchByMember . '%');
        return $query;
    }
}
