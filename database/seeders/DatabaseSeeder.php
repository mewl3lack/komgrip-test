<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Position::factory()
        ->count(5)
        ->sequence(
                    ['name' => 'Developer'],
                    ['name' => 'Manager'],
                    ['name' => 'Projects Manager'],
                    ['name' => 'Tester'],
                    ['name' => 'System Analysis'],
                    ['name' => 'Senior Developer'],
                    ['name' => 'CEO'],
                    ['name' => 'Business Analysis'],
                    ['name' => 'Designer'],
                    ['name' => 'Planner'],
                )
        ->create();

        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
