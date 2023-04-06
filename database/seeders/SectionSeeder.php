<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sections')->delete();

        $section=[
            ['en'=>'a','ar'=>'أ'],
            ['en'=>'b','ar'=>'ب'],
            ['en'=>'c','ar'=>'ت'],

        ];

        foreach($section as $items){
            Section::create([

                    'name'=>$items,
                    'status'=>1,
                    'grade_id'=>1,
                    'classroom_id'=>1
            ]);
        }
    }
}
