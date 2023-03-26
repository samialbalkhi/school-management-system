<?php

namespace Database\Seeders;

use App\Models\Type_blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blood =['O-','O+','A+','A-','B+','B-','AB+','AB-'];
        foreach($blood as $items){
            Type_blood::create([

                'name' => $items
            ]);
        }
    }
}
