<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->email = "admin@email.com";
        $admin->role_id = 4;
        $admin->name = "admin";
        $admin->password = bcrypt("admin");
        $admin->type = "App\User";
        $admin->save();
    }
}
