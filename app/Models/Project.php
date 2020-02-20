<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	'name', 'description', 'began_at', 'finished_at', 'status_id', 'customer_id', 'leader_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function leader()
    {
        return $this->belongsTo(Member::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_project')
            ->withPivot('began_at', 'finished_at')
            ->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }

    public function projectStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'status_id');
    }

    public function scopeSearchByName($query, $request){
        if(isset($request->searchByName)){
            $query->where('name', 'like', '%' . $request->searchByName . '%');
        }
        return $query;
    }
}
