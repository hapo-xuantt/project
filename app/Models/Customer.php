<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'manager', 'image', 'email', 'phone', 'address',
    ];

    public function projects()
    {
        return $this->hasMany('Project::class');
    }

    public function scopeSearchByName($query, $request)
    {
        if(!empty($request->searchName)){
            $query->where('name', 'like', '%' . $request->searchName . '%');
        }
        return $query;
    }

    public function scopeSearchByPhone($query, $request){
        if(!empty($request->searchPhone)){
            $query->where('phone', 'like', '%' . $request->searchPhone . '%');
        }
        return $query;
    }
}
