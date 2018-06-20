<?php

use Illuminate\Database\Seeder;
use App\Treatment;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            ["type" => 'Filling', 'description' => '', 'price' => 400],
            ["type" => 'Extraction', 'description' => '', 'price' => 400],
            ["type" => 'Braces', 'description' => '', 'price' => 10000],
            ["type" => 'Root Canal', 'description' => '', 'price' => 400],
            ["type" => 'Whitening', 'description' => '', 'price' => 3000]
        ];

        foreach($arr as $t) {
            $treatment = new Treatment();
            $treatment->type = $t['type'];
            $treatment->description = $t['description'];
            $treatment->price = $t['price'];
            $treatment->save();
        }

    }
}
