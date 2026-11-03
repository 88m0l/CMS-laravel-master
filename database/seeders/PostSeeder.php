<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(3)->create([
            'user_id' => 1,
            'status' => PostStatus::Published,
        ]);

        Post::factory(7)->create(['status' => PostStatus::Published]);
        Post::factory(10)->create();
    }
}
