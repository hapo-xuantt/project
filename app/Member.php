<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
    	'name', 'account', 'image', 'password', 'email', 'is_admin',
    ];

    public function project()
    {
        return $this->belongsToMany('App\Project', 'member_project', 'member_id', 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Tasks');
    }

    public function projects()
    {
        return $this->hasMany('App\Project', 'foreign_key', 'leader_id');
    }
}
