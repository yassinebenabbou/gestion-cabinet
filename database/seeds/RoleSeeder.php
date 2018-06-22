<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [Role::Doctor, Role::Receptionist, Role::Patient, Role::Admin];
        foreach($roles as $r) {
            $role = new Role();
            $role->name = "{$r}";
            $role->save();
        }

    }
}
