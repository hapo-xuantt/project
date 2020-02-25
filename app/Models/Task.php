<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopesearchByProject($query, $request)
    {
        $searchByProject = $request->searchByProject;
        $query->whereHas('project', function ($query) use ($searchByProject){
           $query->where('name', 'like',  '%' .  $searchByProject . '%');
        });
        return $query;
    }

    public function scopesearchByMember($query, $request)
    {
        $searchByMember = $request->searchByMember;
        $query->whereHas('member', function ($query) use ($searchByMember){
            $query->where('name', 'like',  '%' .  $searchByMember . '%');
        });
        return $query;
    }
}
