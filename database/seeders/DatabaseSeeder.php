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

        $users = User::all();

        foreach ($users as $user) {
            // Each user follows 1 to 3 random other users (excluding themselves)
            $toFollow = $users->where('id', '!=', $user->id)->random(rand(1, 3));
            foreach ($toFollow as $followed) {
                $user->followers()->attach($followed->id);
            }
        }

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
