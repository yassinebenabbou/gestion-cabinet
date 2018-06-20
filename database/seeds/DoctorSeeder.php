<?php

use Illuminate\Database\Seeder;
use App\Doctor;

class DoctorSeeder extends Seeder
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
            $doc = new Doctor();
            $doc->name = "Doc{$i} Docteur";
            $doc->password = bcrypt("doc{$i}");
            $doc->email = "doc{$i}@email.com";
            $doc->role_id = 1;
            $doc->type = get_class($doc);
            $doc->save();
        }
    }
}
