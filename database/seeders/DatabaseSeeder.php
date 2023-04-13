<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Type_blood;
use Illuminate\Database\Seeder;
use Database\Seeders\ReligionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminSedder::class);
        $this->call(GradeSedder::class);
        $this->call(ClassroomSedder::class);
        $this->call(SectionSeeder::class);
        $this->call(BloodSeeder::class);
        $this->call(NotionalitioSedder::class);
        $this->call(ReligionsSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(FathersSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
