<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function hasRolePatient()
    {
        return $this->role->name == Role::Patient;
    }

    public function hasRoleReceptionist()
    {
        return $this->role->name == Role::Receptionist;
    }

    public function hasRoleDoctor()
    {
        return $this->role->name == Role::Doctor;
    }

    public function hasRoleAdmin()
    {
        return $this->role->name == Role::Admin;
    }


    public function userable()
    {
        return $this->morphTo('', 'type', 'id', 'id');
    }


}
