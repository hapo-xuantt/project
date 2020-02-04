<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusTask extends Model
{
    protected $fillable = [
    	'name',
    ]

    public function project()
    {
        return $this->belongsTo('App\Project', 'foreign_key', 'status_id');
    }
}
