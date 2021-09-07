<?php

use App\Models\Post;
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

Route::get('/', function () {
    // $document = YamlFrontMatter::parseFile(
    //     resource_path('posts/my-first-post.html')
    // );
    //ddd($document->matter('title'));
    // $files = File::files(resource_path("posts/"));
    // $posts = [];
  
    
    // $posts = cache()->rememberForever( 'posts.all', fn () => Post::all());
        // collect( File::files(resource_path("posts/")))
        //     ->map(fn ($file) => YamlFrontMatter::parseFile($file))
        //     ->map(fn ($document) => Post::createFromDocument($document))
    // );
    //ddd($posts);

    $posts = Post::all();

    return view('posts', [
        //'posts' => Post::all()
        'posts' => $posts
    ]);
});

// Route::get('/post/{post}', function ($slug) {
//     return view('post', [
//         'post' => Post::find($slug)
//     ]);
// })->where('post', '[A-Za-z\_-]+');

Route::get('/post/{post:slug}', function (Post $post) {
    return view('post', [
     'post' => $post, 
    ]);
});