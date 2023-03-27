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
        $this->call(BloodSeeder::class);
        $this->call(NotionalitioSedder::class);
        $this->call(ReligionsSeeder::class);
    }
}
