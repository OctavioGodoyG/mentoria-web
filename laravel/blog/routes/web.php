<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// $document = YamlFrontMatter::parseFile(
//     resource_path('posts/my-first-post.html')
// );
//ddd : Dump, Die, Debug
//ddd($document->matter('title'));
// $files = File::files(resource_path("posts/"));
// $posts = [];
// $posts = cache()->rememberForever( 'posts.all', fn () => Post::all());
// collect( File::files(resource_path("posts/")))
//     ->map(fn ($file) => YamlFrontMatter::parseFile($file))
//     ->map(fn ($document) => Post::createFromDocument($document))
// );
//ddd($posts);

// Route::get('/post/{post}', function ($slug) {
//     return view('post', [
//         'post' => Post::find($slug)
//     ]);
// })->where('post', '[A-Za-z\_-]+');

// Route::get('/post/{post:slug}', function (Post $post) {

Route::get('/', function () {
    DB::listen(function ($query) {
        logger($query->sql, $query->bindings);
    });

    return view('posts', [
        'posts' => Post::with('category')->get()
    ]);
});

Route::get('/post/{post}', fn (Post $post) => view('post', ['post' => $post,]));

Route::get('/category/{category:slug}', fn(Category $category) => view('posts', ['posts' => $category->posts,]) );
