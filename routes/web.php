<?php

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

// Création d'un groupe préfixé par /blog et blog.
Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function () {

    // Route /blog blog.index
    Route::get('/','index')->name('index');

    // Route /blog/{slug}-{id} blog.show
    Route::get('/{slug}-{post}', 'show')->where([
        'post' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');

});

