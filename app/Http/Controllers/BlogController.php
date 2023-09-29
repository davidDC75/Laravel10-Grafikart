<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BlogFilterRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View {
        //dd($request->validated());
        return view('blog.index',[
            'posts' => Post::paginate(10,['id','title','slug'])
        ]);
    }

    public function show(string $slug, string $id, Request $request): RedirectResponse | View {
        // On récupère le post avec son id
        $post = Post::find($id);

        dd($post);
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
