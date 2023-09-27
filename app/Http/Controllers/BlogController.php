<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(): Paginator {
        return Post::paginate(25);
    }

    public function show(string $slug, string $id, Request $request): RedirectResponse | Post {
        // On récupère le post avec son id
        $post = Post::find($id);

        // Si il y a une erreur sur le slug dans l'url alors on redirige
        // vers la bonne url
        if ($post->slug !== $slug) {
            return to_route('blog.show',['slug'=>$post->slug,'id'=>$post->id]);
        }

        return $post;
    }
}
