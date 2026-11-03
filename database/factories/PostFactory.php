<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        $imagePath = $this->faker->image(
            storage_path('app/public/images'),
            640,
            320,
            false
        );
        return [
            'title' => $title,
            'slug' => Str::slug($title, language: false),
            'content' => $this->faker->paragraph,
            'status' => Arr::random(array_column(PostStatus::cases(), 'value')),
            'image_path' => $imagePath,
            'category_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
