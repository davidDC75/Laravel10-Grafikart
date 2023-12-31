<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFormPostRequest;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
//use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    // Affiche le formulaire de création
    public function create(): View {
        //dd(session()->all());
        $post = new Post();
        return view('blog.create',[
            'post' => $post,
            'categories' => Category::select('id','name')->get(),
            'tags' => Tag::select('id','name')->get()
        ]);
    }

    // Enregistre le nouveau post depuis le formualire de création
    public function store(BlogFormPostRequest $request) {
        $post = Post::create($this->extractData(new Post(),$request));
        $post->tags()->sync($request->validated('tags'));
        return redirect()
            ->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
            ->with('success','L\'article a bien été sauvegardé');
    }

    // Affiche le formulaire d'édition de post
    public function edit(Post $post) {

        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id','name')->get(),
            'tags' => Tag::select('id','name')->get()
        ]);
    }

    // Met à jour le post depuis le formulaire d'édition
    public function update(Post $post, BlogFormPostRequest $request) {
        $post->update($this->extractData($post,$request));
        $post->tags()->sync($request->validated('tags'));
        return redirect()
            ->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
            ->with('success','L\'article a bien été mise à jour');
    }

    private function extractData(Post $post, BlogFormPostRequest $request) {
        $data=$request->validated();
        /** @var UploadedFile|null $image */
        $image=$request->validated('image');
        if ($image===null || $image->getError()) {
            return $data;
        }
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $data['image']=$image->store('blog','public');
        return $data;
    }
    public function index(): View {
    /*
     * Crée un utilisateur
        User::create([
            'name' => 'david',
            'email' => 'segphault@gmail.com',
            'password' => Hash::make('seg')
        ]);
    */
        //dd(Auth::user());
        // Supprime le tag du post
        //$tags = $post->tags()->detach(2);
        // Ajoute le tag au post
        //$tags = $post->tags()->attach(2);

        // Supprime toutes les relations
        //$tags=$post->tags()->sync([]);
        // Ajoute les relations avec les tag id
        //$tags=$post->tags()->sync([1,2]);

        //$posts=Post::has('tags','>=',1)->get();

        //$tags = $post->tags;
        //$tags = $post->tags()->where('name','Tag 1')->get();
        /* Crée des tags
        $post->tags()->createMany([[
            'name' => 'Tag 1'
            ], [
                'name' => 'Tag 2'
        ]]);
        */
        return view('blog.index',[
            'posts' => Post::with('tags','category')->paginate(10)
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
