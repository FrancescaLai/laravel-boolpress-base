@extends('layouts.base')

@section('pageTitle')
    Lista articoli
@endsection

@section('content')
<div>
    <a href="{{route('admin.posts.create')}}"><button type="button" class="btn btn-success">Aggiungi Post</button></a>
</div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Immagine</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Data</th>
                    <th scope="col">Pubblicato</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
            <tr>
                <td><img src="{{$post->image ? $post->image : 'https://via.placeholder.com/200' }}" alt="{{$post->title}}" style="width: 100px"></td>
                <td>{{$post->title}}</td>
                <td>{{$post->date}}</td>
                <td>{{$post->published}}</td>
                <td>
                    <a href="{{route('admin.posts.show', [ 'post' => $post->id ])}}"><button type="button" class="btn btn-outline-info"><i class="far fa-eye"></i></button></a>
                    <a href="{{route('admin.posts.edit', [ 'post' => $post->id ])}}"><button type="button" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button></a>
                    <form action="{{route('admin.posts.destroy', ['post' => $post->id ])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Elimina</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>	
        </table>
        @if (session('message'))
            <div class="alert alert-success" style="position: fixed; bottom: 30px; right: 30px">
                {{ session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif	
	</body>
</html>
@endsection

