<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFormPostRequest;

use App\Models\Category;
use App\Models\Post;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogController extends Controller
{
    // Affiche le formulaire de création
    public function create(): View {
        //dd(session()->all());
        $post = new Post();
        return view('blog.create',[
            'post' => $post
        ]);
    }

    // Enregistre le nouveau post depuis le formualire de création
    public function store(BlogFormPostRequest $request) {
        $post = Post::create($request->validated());
        return redirect()
            ->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
            ->with('success','L\'article a bien été sauvegardé');
    }

    // Affiche le formulaire d'édition de post
    public function edit(Post $post) {
        return view('blog.edit', [
            'post' => $post
        ]);
    }

    // Met à jour le post depuis le formulaire d'édition
    public function update(Post $post, BlogFormPostRequest $request) {
        $post->update($request->validated());
        return redirect()
            ->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
            ->with('success','L\'article a bien été mise à jour');
    }

    public function index(): View {
        $category = Category::find(1);
        $post = Post::find(185);
        $post->category()->associate($category);
        $post->save();

        //dd($category);
        return view('blog.index',[
            'posts' => Post::paginate(10,['id','title','slug'])
        ]);
    }

    // On passe en paramètre un Post. Laravel va récupèrer le post directement depuis son id
    public function show(string $slug, Post $post, Request $request): RedirectResponse | View {
        // On récupère le post avec son id
        //$post = Post::findOrFail($post);

        // Si il y a une erreur sur le slug dans l'url alors on redirige
        // vers la bonne url
        if ($post->slug !== $slug) {
            return to_route('blog.show',['slug'=>$post->slug,'post'=>$post->id]);
        }

        return view('blog.show', [
            'post' => $post
        ]);
    }
}
