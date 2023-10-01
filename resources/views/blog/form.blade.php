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
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select name="category_id" class="form-control" id="category">
                    <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $category)
                    <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error("category_id")
            {{ $message }}
            @enderror
        </div>
        @php
            $tagsIds=$post->tags()->pluck('id');
        @endphp

        <div class="form-group">
            <label for="tag">Tags</label>
            <select name="tags[]" class="form-control" id="tag" multiple>
                @foreach($tags as $tag)
                    <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            @error("tags")
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
