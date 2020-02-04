<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'manager', 'image', 'email', 'phone', 'address',
    ];

    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
