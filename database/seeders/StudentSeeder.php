<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Father;
use App\Models\Grade;
use App\Models\Notionalitio;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->delete();
        Student::create([
            'name' => ['ar' => 'احمد ابراهيم', 'en' => 'Ahmed Ibrahim'],
            'email' => 'Ahmed_Ibrahim@yahoo.com',
            'password' =>Hash::make('password'),
            'gender_id' => 1,
            'notionalitio_id' => Notionalitio::all()
                ->unique()
                ->random()->id,
            'type_blood_id' =>1,
               

            'grade_id ' =>1,

            'classroom_id ' => 1,

            'section_id ' => 1,
            'father_id' => 1,
                'barth_day'=> date('1995-01-01'),
                'academic_year'=>'2023',
        ]);
    }
}
