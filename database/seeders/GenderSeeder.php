<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('genders')->delete();

        $gender=[
            ['en'=>'male', 'ar'=>'ذكر'],
            ['en'=>'female', 'ar'=>'أنثى'],  
        ];

        foreach($gender as $items){

            Gender::create(['name'=>$items]);
        }
    }
}
