<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'مستخدم تجريبي',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        User::factory()->create([
            'name' => 'مستخدم اخر',
            'email' => 'test2@example.com',
            'password' => 'password'
        ]);
        
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            PageSeeder::class
        ]);
    }
}
