@extends('layouts.base')

@section('pageTitle')
    {{$post->title}}
@endsection

@section('content')
   <p><strong>data:</strong>{{$post->date}}</p>
   <p><strong>stato:</strong>{{$post->published? 'pubblicato' : ''}}</p>
   <div><strong>tags:</strong>
       @foreach ($post->tags as $tag)
            <span class="badge badge-primary">{{$tag->name}}</span>
       @endforeach
   </div>
   <hr>
   <p>{{$post->content}}</p>

   @if ($post->comments->isNotEmpty())
       <div class="mt-5">
            <h3>Commenti</h3>
            <ul>
                @foreach ($post->comments as $comment)
                    <li>
                        <h5>{{$comment->name ? $comment->name : 'Anonimo'}}</h5>
                        <p>{{$comment->content}}</p>
                        <form action="{{route('admin.posts.destroy', ['post' => $post->id ])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </li>
                @endforeach
            </ul>
       </div>
   @endif
   <a href="{{route('admin.posts.index')}}">Torna alla lista articoli</a>
@endsection