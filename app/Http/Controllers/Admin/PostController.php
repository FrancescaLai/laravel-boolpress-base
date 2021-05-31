<?php

// qui devo aggiungere io Admin xk in web.php ho definito: ->namespace('Admin')
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

// Da includere a mano
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // VALIDAZIONE sulla base di quanto indicato nel file delle Migrations (create_posts_table) 
    protected $validation = [
        'title' => 'required|string|max:255|unique:posts',
        'date' => 'required|date|',
        'content' => 'required|string',
        'image' => 'nullable|url',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione (ripresa da quanto definito sopra)
        $request->validate($this->validation);

        $data = $request->all();

        // controllo x la checkbox
        $data['published'] = !isset($data['published']) ? 0 : 1;

        // imposto lo slug sul titolo
        $data['slug'] = Str::slug($data['title'], '-');

        //Insert
        Post::create($data);

        //Redirect
        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Validazione (ripresa da quanto definito sopra)
        $request->validate($this->validation);

        $data = $request->all();

        // controllo x la checkbox
        $data['published'] = !isset($data['published']) ? 0 : 1;

        // imposto lo slug sul titolo
        $data['slug'] = Str::slug($data['title'], '-');

        //update
        $post->update($data);

        //return
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'il post è stato cancellato');
    }
}
