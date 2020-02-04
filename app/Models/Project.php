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
        return $this->belongsTo('Customer::class');
    }

    public function leader()
    {
        return $this->belongsTo('Member::class');
    }

    public function members()
    {
        return $this->belongsToMany('Member::class', 'member_project');
    }

    public function tasks()
    {
        return $this->hasMany('Tasks::class');
    }

    public function projectStatuses()
    {
        return $this->hasMany('ProjectStatus::class');
    }
}
