<?php

use App\Models\Post;
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
        $post = new Post();
        $post->title = 'Mon premier article';
        $post->slug = 'mon-premier-article';
        $post->content = 'Mon contenu';
        $post->save();

        return $post;
        //return [
        //    "link" => \route('blog.show', ['slug'=>'article','id'=>13])
        //];
    })->name('index');

    // Route /blog/{slug}-{id} blog.show
    Route::get('/{slug}-{id}', function (string $slug, string $id, Request $request) {
        return [
            "slug" => $slug,
            "id" => $id,
            "name" => $request->input('name','John Doe')
        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
});

