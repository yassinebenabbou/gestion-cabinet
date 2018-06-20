<?php

use Illuminate\Database\Seeder;
use App\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 6; $i++)
        {
            $patient = new Patient();
            $patient->name = "Pat{$i} Patient";
            $patient->password = bcrypt("pat{$i}");
            $patient->email = "patient{$i}@email.com";
            $patient->role_id = 3;
            $patient->phone = '06'.rand(10000000, 99999999);
            $patient->type = get_class($patient);
            $patient->save();
        }
    }
}
