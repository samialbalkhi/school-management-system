<?php

namespace Database\Seeders;

use App\Models\Type_blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('type_bloods')->delete();

        $blood =['O-','O+','A+','A-','B+','B-','AB+','AB-'];
        foreach($blood as $items){
            Type_blood::create([

                'name' => $items
            ]);
        }
    }
}
