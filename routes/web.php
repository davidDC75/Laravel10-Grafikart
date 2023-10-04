<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
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

Route::name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'doLogin')->name('login');
    Route::delete('/logout', 'logout')->name('logout');
});

// Création d'un groupe préfixé par /blog et blog.
Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function () {

    // Route /blog blog.index
    Route::get('/','index')->name('index');

    // Route /blog/new blog.create
    Route::get('/new','create')->name('create')->middleware('auth');

    // Route pour le traitement du formulaire de création
    // /blog/new blog.new
    Route::post('/new', 'store')->name('new')->middleware('auth');

    // Route pour le formulaire d'édition
    Route::get('/{post}/edit','edit')->name('edit')->middleware('auth');
    // Route pour mettre à jour le post depuis le formulaire d'édition
    Route::patch('/{post}/edit','update')->name('update')->middleware('auth');

    // Route /blog/{slug}-{id} blog.show
    Route::get('/{slug}-{post}', 'show')->where([
        'post' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');

});

