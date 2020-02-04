<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	'name', 'description', 'began_at', 'finished_at', 'status_id', 'customer_id', 'leader_id',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function members()
    {
        return $this->belongsToMany('App\Member', 'member_project', 'member_id', 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Tasks');
    }

    public function statusProjects()
    {
        return $this->hasMany('App\StatusProject');
    }
}
