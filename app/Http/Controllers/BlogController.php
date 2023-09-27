<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View {
        return view('blog.index',[
            'posts' => Post::paginate(10,['id','title','slug'])
        ]);
    }

    public function show(string $slug, string $id, Request $request): RedirectResponse | View {
        // On récupère le post avec son id
        $post = Post::find($id);

        // Si il y a une erreur sur le slug dans l'url alors on redirige
        // vers la bonne url
        if ($post->slug !== $slug) {
            return to_route('blog.show',['slug'=>$post->slug,'id'=>$post->id]);
        }

        return view('blog.show', [
            'post' => $post
        ]);
    }
}
