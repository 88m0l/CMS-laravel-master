<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::factory()->create([
            'title' => 'من نحن',
            'slug' => 'من-نحن'
        ]);
        Page::factory()->create([
            'title' => 'تواصل معنا',
            'slug' => 'تواصل-معنا',
        ]);
    }
}
