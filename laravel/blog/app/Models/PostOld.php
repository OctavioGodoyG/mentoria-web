<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//se utilizara esta clase sólo como contenedor, no se extenderá de ninguna otra clase
class Post
{

    public string $title;
    public string $resumen;
    public string $date;
    public string $slug;
    public string $body;


    public function __construct($title, $resumen, $date, $slug, $body)
    {
        $this->title = $title;
        $this->resumen = $resumen;
        $this->date = $date;
        $this->slug = $slug;
        $this->body = $body;
    }

    public static function createFromDocument($document)
    {
        return new self(
            $document->title,
            $document->resumen,
            $document->date,
            $document->slug,
            $document->body()
        );
    }

    public static function all()
    {
        // $files = File::files(resource_path("posts/"));
        // return array_map(fn ($file) => $file->getContents(), $files);

        return collect(File::files(resource_path("posts/")))
            ->map(fn ($file) => YamlFrontMatter::parseFile($file))
            ->map(fn ($document) => Post::createFromDocument($document));
    }

    public static function find($slug)
    {

        // $posts = static::all()->firstWhere('slug', $slug);

        return cache()->remember("post.{$slug}", now()->addDays(1), fn () =>  static::all()->firstWhere('slug', $slug));


        // ddd($posts->firstWhere('slug', $slug));

        // if (!file_exists($path = resource_path("post/{$slug}.html"))) {
        //     throw new ModelNotFoundException();
        //     // return redirect('/');
        // }
        // return cache()->remember("post.{$slug}", now()->addDays(3), fn () =>  file_get_contents($path));
    }
}
