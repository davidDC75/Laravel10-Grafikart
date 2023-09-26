<?php

use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Création d'un groupe préfixé par /blog et blog.
Route::prefix('/blog')->name('blog.')->group(function () {

    // Route /blog blog.index
    Route::get('/', function (Request $request) {

        // Création d'un premier post
        //$post = new Post();
        //$post->title = 'Mon second article';
        //$post->slug = 'mon-second-article';
        //$post->content = 'Mon second contenu';
        //$post->save();

        ////// DIFFERENTES RECUPERATIONS DE POSTS //////
        // Renvoie en json l'ensemble des articles
        //$posts = Post::all();

        // Fait la même chose mais retourne les champs sélectionnés
        //$posts = Post::all(['id','title']);

        // Retourne l'article avec l'id correspondant
        // Renvoie null si rien n'est trouvé
        //$posts = Post::find(34);

        // Retourne une 404 si rien n'est trouvé
        //$posts = Post::findOrFail(104);

        // Système de pagination. Retourne aussi des informations à utiliser pour générer les liens
        // On peut utiliser le paramètre 'page' en GET pour sélectionner la page souhaitée
        //$posts = Post::paginate(10,['id','title']);

        //$posts = Post::where('id','>',15)->first();
        //$posts = Post::where('id','>',15)->get();
        //$posts = Post::where('id','>',15)->limit(10)->get();

        /////// MODIFICATIONS POST /////////
        //$post = Post::find(1);
        //$newTitle="Nouveau titre";
        //$post->title=$newTitle;
        //$post->slug=SlugService::createSlug(Post::class,'slug',$newTitle);
        //$post->save();

        ///////// SUPPRESSION POST ////////
        //$post = Post::find(10);
        //$post->delete();
        // Vérification suppression
        //$posts=Post::where('id','>',9)->limit(2)->get();


        // la fonction dd() est utile pour le debug
        //dd($posts);
        //dd($posts[0]->title);
        //dd($posts->first());

        //// CREATION POST AVEC TABLEAU ASSOCIATIF /////
        //$newTitle = 'Annonce virale';
        //$post = Post::create([
        //    'title' => $newTitle,
        //    'slug'  => SlugService::createSlug(Post::class,'slug',$newTitle),
        //   'content' => 'On en parle tout le temps'
        //]);
        // Vérification
        //$post = Post::find(54, ['id','title']);

        return Post::paginate(25);

        //return [
        //    "link" => \route('blog.show', ['slug'=>'article','id'=>13])
        //];
    })->name('index');

    // Route /blog/{slug}-{id} blog.show
    Route::get('/{slug}-{id}', function (string $slug, string $id, Request $request) {

        // On récupère le post avec son id
        $post = Post::find($id);

        // Si il y a une erreur sur le slug dans l'url alors on redirige
        // vers la bonne url
        if ($post->slug !== $slug) {
            return to_route('blog.show',['slug'=>$post->slug,'id'=>$post->id]);
        }
        // On retourne un JSON
        return [
            "id" => $post->id,
            "title" => $post->title,
            "slug" => $post->slug,
            "content" => $post->content
        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
});

