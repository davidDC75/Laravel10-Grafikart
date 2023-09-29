@extends('base')

@section('title','Accueil du blog')

@section('content')
    <h1>Mon blog</h1>
    @foreach($posts as $post)
        <article class="card">
            <h5 class="card-title">{{ $post->title }}</h5>
            <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Lire la suite</a>
            <a href="{{ route('blog.edit', ['post' => $post->id]) }}" class="btn btn-primary">Editer</a>
        </article>
    @endforeach

    {{ $posts->links() }}
@endsection
