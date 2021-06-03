@extends('layouts.guest')

@section('pageTitle')
    {{$post->title}}
@endsection

@section('content')
<div class="mt-3">
    <h1>{{$post->title}}</h1>
    <h4>{{$post->date}}</h4>
    <p>{{$post->content}}</p>

    <div class="mt-3">
        @if($post->comments->isNotEmpty())
        <h3>Commenti</h3>
        <ul>
            @forelse ($post->comments as $comment)
                <li>
                    <h5>{{$comment->name ? $comment->name : 'Anonimo'}}</h5>
                    <p>{{$comment->content}}</p>
                </li>
            @empty
                <p>Non ci sono commenti</p>  
            @endforelse
        </ul>
        @endif
        <h3>Aggiungi commento</h3>
        <form action="{{route('guest.posts.add-comment', ['post' => $post->id])}}" method="post">
            @method('POST')
            @csrf
        
            <div class="form-group">
                <label for="title">Nome</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="inserisci nome">
            </div>
            <div class="form-group">
                <label for="content">Commento</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="4" placeholder="inserisci il tuo commento"></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Inserisci</button>
            </div>
        </form>
    </div>   
</div>
@endsection