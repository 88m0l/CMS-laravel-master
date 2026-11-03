<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory(5)->create(['post_id' => 1]);
        Comment::factory(10)->create();

        Comment::factory(2)->create([
            'post_id'=>1,
            'parent_id' => 1,
        ]);

        Comment::factory(2)->create([
            'post_id'=>1,
            'parent_id' => 2,
        ]);

        $comment = Comment::factory()->create([
            'post_id'=>1,
            'parent_id' => 3,
        ]);

        Comment::factory()->create([
            'post_id'=>1,
            'parent_id' => $comment->id
        ]);
    }
}
