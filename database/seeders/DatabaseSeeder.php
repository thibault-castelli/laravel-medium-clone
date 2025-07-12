<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Thibault Castelli',
            'username' => 'thibault-castelli',
            'email' => 'thibault.castelli@pm.me'
        ]);

        User::factory(9)->create();

        $categories = [
            'Technology',
            'Health',
            'Science',
            'Sports',
            'Politics',
            'Entertainment',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

        Post::factory(100)->create();
    }
}
