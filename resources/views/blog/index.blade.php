@extends('base')

@section('title','Accueil du blog')

@section('content')
    <h1>Mon blog</h1>
    @foreach($posts as $post)
        <article class="card w-50 mt-3">
            <h5 class="card-title px-1 py-1 mx-auto">{{ $post->title }}</h5>
            <p class="small">
                @if($post->category)
                Catégorie : <strong>{{ $post->category?->name }}</strong>@if(!$post->tags->isEmpty()), @endif
                @endif

                @if(!$post->tags->isEmpty())
                    Tags :
                    @foreach($post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                @endif
            </p>
            <p>
                @if($post->image)
                    <img src="{{ $post->imageUrl() }}" alt="image {{ $post->id }}">
                @endif
            </p>
            <div class="btn-group btn-group-lg w-50 mt-1 px-2 py-2" role="group" aria-label="Action">
                <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-outline-primary">Lire la suite</a>
                <a href="{{ route('blog.edit', ['post' => $post->id]) }}" class="btn btn-outline-primary">Editer</a>
            </div>
        </article>
    @endforeach

    {{ $posts->links() }}
@endsection
