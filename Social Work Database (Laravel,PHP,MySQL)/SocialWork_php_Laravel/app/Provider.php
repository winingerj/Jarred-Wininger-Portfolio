<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    public function resources()
    {
        return $this->belongsToMany('App\Resource', 'provider_resource', 'provider_id', 'resource_id');
    }
}
