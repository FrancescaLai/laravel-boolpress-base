<?php

// qui devo aggiungere io Admin xk in web.php ho definito: ->namespace('Admin')
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

// Da includere a mano
use App\Post;
use App\Tag;
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
        // Creo/prendo i tag
        $tags = Tag::all();

        return view('admin.posts.create', compact('tags'));
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
        $validation = $this->validation;
        $request->validate($validation);

        $data = $request->all();

        // controllo x la checkbox
        $data['published'] = !isset($data['published']) ? 0 : 1;

        // imposto lo slug sul titolo
        $data['slug'] = Str::slug($data['title'], '-');

        //Insert
        $newPost = Post::create($data);

        // Se aggiungo dei tag, alla creazione del post associo i tag selezionati e creati sopra 
        if( isset($data['tags'])){
            $newPost->tags()->attach($data['tags']);
        }
        

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

        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'tags'));
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
        // Validazione + esclusione dell'id sul title
        $validation = $this->validation;
        $validation['title'] = $validation['title'] . ',title,' . $post->id;
        $request->validate($validation);

        $data = $request->all();

        // controllo x la checkbox
        $data['published'] = !isset($data['published']) ? 0 : 1;

        // imposto lo slug sul titolo
        $data['slug'] = Str::slug($data['title'], '-');

        //update
        $post->update($data);

        // prima controllo che funzioni anche se non c'è alcun tag selezionato
        if( !isset($data['tags']) ){
            $data['tags'] = [];
        }
        // in caso invece ci siano tag selezionati, li aggiorno e salvo (x aggiornare uso SYNC che fa attach + detach in automatico)
        $post->tags()->sync($data['tags']);

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
        // x eliminare i post
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'il post è stato cancellato');
    }
}
