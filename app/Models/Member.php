<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
    	'name', 'account', 'image', 'password', 'email', 'is_admin',
    ];

    public function projects()
    {
        return $this->belongsToMany('Project::class', 'member_project');
    }

    public function tasks()
    {
        return $this->hasMany('Task::class');
    }

    public function leadingProjects()
    {
        return $this->hasMany('Project::class', 'foreign_key', 'leader_id');
    }
}
