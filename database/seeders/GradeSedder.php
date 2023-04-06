<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
        [
            'en'=> 'Elementary stage',
            'ar'=> 'المرحلة الأبتدائية',
        ],
        [
            'en'=> 'middle School',
            'ar'=> 'المرحلة الأعدادية',
        ],
        [
            'en'=> 'Secondary stage',
            'ar'=> 'المرحلة الثانوية'
        ]
    ];
       DB::table('grades')->delete();
       foreach($data as $items)
        Grade::create([
            'name'=>$items ,
        ]);
    }
}
