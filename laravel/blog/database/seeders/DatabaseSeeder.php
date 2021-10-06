<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();

        Category::factory()->create(['name' => 'Personal', 'slug' => 'personal']);
        Category::factory()->create(['name' => 'Work', 'slug' => 'work']);
        Category::factory()->create(['name' => 'Hobbies', 'slug' => 'hobbies']);

    }
}
