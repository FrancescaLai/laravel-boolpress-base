<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Tag;

class BlogController extends Controller
{
    public function index()
    {
        // Prendo i dati dal database
        $posts = Post::where('published', 1)->orderBy('date', 'desc')->limit(5)->get();
        // Prendo i tag
        $tags = Tag::all();
        // Restituisco la pagina index/home
        return view('guest.index', compact('posts', 'tags'));
    }

    public function show($slug)
    {
        // Prendo i dati dal database
        $post = Post::where('slug', $slug)->first();
        // Prendo i tag
        $tags = Tag::all();

        // Se non trova la pagina (lo slug/id)
        if ( $post == null) {
            abort(404);
        }

        // Altrimenti (se trovo la pagina) restituisco la pagina del singolo post
        return view('guest.show', compact('post', 'tags'));
    }

    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'content' => 'required|string',
        ]);

        $newComment = new Comment();
        $newComment->name = $request->name;
        $newComment->content = $request->content;
        $newComment->post_id = $post->id;

        $newComment->save();

        return back();

    }

    public function filterTag($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $tags = Tag::all();
        $posts = $tag->posts;

        // Restituisco la pagina index/home
        return view('guest.index', compact('posts', 'tags'));
    }
}
