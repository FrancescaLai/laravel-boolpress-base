<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
        // Prendo i dati dal database
        $posts = Post::where('published', 1)->orderBy('date', 'desc')->limit(5)->get();

        // Restituisco la pagina index/home
        return view('guest.index', compact('posts'));
    }

    public function show($slug)
    {
        // Prendo i dati dal database
        $post = Post::where('slug', $slug)->first();

        // Se non trova la pagina (lo slug/id)
        if ( $post == null) {
            abort(404);
        }

        // Restituisco la pagina del singolo post
        return view('guest.show', compact('post'));
    }
}
