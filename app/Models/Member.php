<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Member extends Authenticatable
{
    const IS_ADMIN = [
        0 => 'User',
        1 => 'Admin',
    ];

    use Notifiable;

    protected $guard = 'member';

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

    public function getIsAdminLabelAttribute()
    {
        return self::IS_ADMIN[$this->is_admin];
    }
}
