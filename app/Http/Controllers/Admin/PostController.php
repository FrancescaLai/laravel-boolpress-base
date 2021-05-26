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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();
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
        $data = $request->all();

        //validazione a parte x la checkbox
        if ( !isset($data['published'])) {
            $data['published'] = false;
        } else {
            $data['published'] = true;
        }
        //validazione da fare sulla base di quanto indicato nel file delle Migrations (create_posts_table) 
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date|',
            'content' => 'required|string',
            'image' => 'nullable|url',
        ]);

        // imposto lo slug sul title
        $data['slug'] = Str::slug($data['title'], '-');

        //Insert
        // $newPost = new Post();
        // $newPost->title = $data['title'];
        // $newPost->date = $data['date']; 
        // $newPost->content = $data['content'];
        // $newPost->image = $data['image'];
        // $newPost->slug = Str::slug($data['title'], '-');
        // $newPost->published = $data['published'];
        // $newPost->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
