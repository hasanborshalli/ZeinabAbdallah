<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'ffe29b',
        ]);

        $this->call(CategorySeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(NoteSeeder::class);
        $this->call(CategoryImageSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(FeedbackSeeder::class);
    }
}