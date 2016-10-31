<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';

    public function providers()
    {
        return $this->belongsToMany('App\Provider', 'provider_resource', 'provider_id', 'resource_id');
    }
}
