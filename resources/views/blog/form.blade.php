    <form action="" method="post">
        @csrf
        @method($post->id ? "PATCH" : "Post")
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title',$post->title) }}">
            @error("title")
            {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $post->slug) }}">
            @error("slug")
            {{ $message }}
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea name="content" class="form-control" cols="30" rows="10" id="content">{{ old('content', $post->content) }}</textarea>
            @error("content")
            {{ $message }}
            @enderror
        </div>

        <button class="btn btn-primary">
            @if($post->id)
                Modifier
            @else
                Ajouter
            @endif
        </button>
    </form>
