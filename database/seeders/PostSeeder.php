<?php

namespace Database\Seeders;

use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nombre de poste à créer
        $nbPostToCreate=50;
        // Initialisation de faker
        $faker=\Faker\Factory::create();

        for ($i=0;$i<$nbPostToCreate;$i++) {
            $post=new Post();
            $title=($i+1)."Article blabla";
            $title=($i+1)."Article blabla";
            $post->title=$title;
            $post->slug=SlugService::createSlug(Post::class,'slug',$title);
            $post->content=($i+1)."Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum ";
            $post->save();
        }

    }
}
