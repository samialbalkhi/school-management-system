<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassroomSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'en'=> 'class one',
                'ar'=> 'الصف الأول ',
            ],
            [
                'en'=> 'class two',
                'ar'=> 'الصف التاني',
            ],
            [
                'en'=> 'Tenth grade',
                'ar'=> 'الصف العاشر'
            ]
        ];
       DB::table('classrooms')->delete();

        foreach($data as $room)
        Classroom::create([
            'name'=>$room,
            'grade_id'=> 1
        ]);
    }
}
