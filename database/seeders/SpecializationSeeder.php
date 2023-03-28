<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->delete();
        $specializations=[
            ['en'=>'Arabic','ar'=>'عربي'],
            ['en'=>'Sciences','ar'=>'علوم'],
            ['en'=>'computer','ar'=>'حاسب ألي'],
            ['en'=>'English','ar'=>'أنكليزي'],
        ];

        foreach($specializations as $items){

            Specialization::create([
                'name'=>$items,
            ]);
        }
    }
}
