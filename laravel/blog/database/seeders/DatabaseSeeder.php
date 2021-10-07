<?php

namespace Database\Seeders;

use App\Models\Post;
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

        User::truncate();
        Category::truncate();
        Post::truncate();

        $user = User::factory()->create();

        $personal =Category::create(['name' => 'Personal', 'slug' => 'personal']);
        $work =Category::create(['name' => 'Work', 'slug' => 'work']);
        $hobbies =Category::create(['name' => 'Hobbies', 'slug' => 'hobbies']);

        Post::create([
            'category_id' => $work->id,
            'user_id' => $user->id,
            'slug' => 'my-first-post',
            'title' => 'Mi primer post',
            'resumen' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
            'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi cumque veritatis, tempora deleniti laborum in blanditiis quidem similique nulla hic fuga explicabo aperiam consectetur omnis aut voluptates, aliquid cum! Nesciunt.',
        ]);

        Post::create([
            'category_id' => $personal->id,
            'user_id' => $user->id,
            'slug' => 'my-second-post',
            'title' => 'Mi Segundo post',
            'resumen' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
            'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi cumque veritatis, tempora deleniti laborum in blanditiis quidem similique nulla hic fuga explicabo aperiam consectetur omnis aut voluptates, aliquid cum! Nesciunt.',
        ]);

        Post::create([
            'category_id' => $hobbies->id,
            'user_id' => $user->id,
            'slug' => 'my-third-post',
            'title' => 'Mi Tercer post',
            'resumen' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
            'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi cumque veritatis, tempora deleniti laborum in blanditiis quidem similique nulla hic fuga explicabo aperiam consectetur omnis aut voluptates, aliquid cum! Nesciunt.',
        ]);

    }
}
