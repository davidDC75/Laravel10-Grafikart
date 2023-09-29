@extends('base')

@section('title','Création d\'un article pour le blog')

@section('content')
    <form action="{{ route('blog.new') }}" method="post">
        @csrf
        <div>
            <input type="text" name="title" id="" value="{{ old('title','Titre de l`article') }}">
            @error("title")
                {{ $message }}
            @enderror
        </div>
        <div>
            <textarea name="content" cols="30" rows="10">{{ old('content', 'Contenu de l`article') }}</textarea>
            @error("content")
                {{ $message }}
            @enderror
        </div>

        <button>Créer l'article</button>
    </form>
@endsection
