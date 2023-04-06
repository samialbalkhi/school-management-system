<?php

namespace Database\Seeders;

use App\Models\Father;
use App\Models\Notionalitio;
use App\Models\Religion;
use App\Models\Type_blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class FathersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fathers')->delete();
        Father::create([

            'email'=>'samir.gamal77@yahoo.com',
            'password'=>Hash::make('password'),
            'name'=> ['en' => 'samirgamal', 'ar' => 'سمير جمال'],
            'notionalitio_id'=>Notionalitio::all()->unique()->random()->id,
            'type_blood_id'=>Type_blood::all()->unique()->random()->id,
            'religion_id'=>Religion::all()->unique()->random()->id,
            'national_id'=>'1234567810',
            'passport_id'=>'1234567810',
            'phone'=>'1234567810',
            'job'=> ['en' => 'Teacher', 'ar' => 'معلم'],
            'address'=>'القاهرة',

        ]);
    }
}
