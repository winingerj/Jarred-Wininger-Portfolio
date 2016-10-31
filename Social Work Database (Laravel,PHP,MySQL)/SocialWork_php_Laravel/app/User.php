<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role'
    ];

    public function hasRole($roleNeeded)
    {
		$roleHas = $this->role;
        switch($roleNeeded){
			case 'waiting':
				if($roleHas == 5)
					return true;
			case 'worker':
				if($roleHas == 4)
					return true;
			case 'GA':
				if($roleHas == 3)
					return true;
			case 'admin':
				if($roleHas == 2)
					return true;
			case 'superAdmin':
				if($roleHas == 1)
					return true;
			default:
				return false;	//should probably throw some kind of exception.
			return false;
		}
    }

    public function getRole()
    {
        switch($this->role){
			case 5:
				return 'waiting';
			case 4:
				return 'worker';
			case 3:
    			return 'GA';
			case 2:
				return 'admin';
			case 1:
				return 'superAdmin';
			return 'unknown';
		}
    }

    public function getRoleFormatted()
    {
        switch($this->role){
			case 5:
				return 'Waiting for Approval';
			case 4:
				return 'Worker';
			case 3:
    			return 'GA';
			case 2:
				return 'Super GA';
			case 1:
				return 'Admin';
			return 'unknown';
		}
    }
}
