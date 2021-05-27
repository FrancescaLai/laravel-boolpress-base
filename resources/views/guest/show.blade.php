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
        <h3>Commenti</h3>
        <ul>
            @forelse ($post->comments as $comment)
                <li>
                    <h5>{{$comment->name}}</h5>
                    <p>{{$comment->content}}</p>
                </li>
            @empty
                <p>Non ci sono commenti</p>  
            @endforelse
        </ul>
    </div>
    
</div>
@endsection