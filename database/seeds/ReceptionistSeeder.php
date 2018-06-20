<?php

use Illuminate\Database\Seeder;
use App\Receptionist;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 3; $i++)
        {
            $receptionist = new Receptionist();
            $receptionist->name = "Rec{$i} Receptionist";
            $receptionist->password = bcrypt("rec{$i}");
            $receptionist->email = "receptionist{$i}@email.com";
            $receptionist->role_id = 2;
            $receptionist->type = get_class($receptionist);
            $receptionist->save();
        }
    }
}
