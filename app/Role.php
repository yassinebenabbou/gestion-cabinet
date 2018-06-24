<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    private $id;
    private $name;

    public const Patient = 'role_patient';
    public const Receptionist = 'role_receptionist';
    public const Doctor = 'role_doctor';
    public const Admin = 'role_admin';
}
