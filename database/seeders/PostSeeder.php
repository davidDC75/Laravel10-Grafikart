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
        $faker=\Faker\Factory::create('fr_FR');

        for ($i=0;$i<$nbPostToCreate;$i++) {
            $post=new Post();
            $title=($i+1)." Article de ".$faker->name();
            $post->title=$title;
            $post->slug=SlugService::createSlug(Post::class,'slug',$title);
            $content='';
            for ($j=0;$j<30;$j++) {
                $content.=(' '.$faker->text());
            }
            $content=($i+1).$content;
            $post->content=$content;
            $post->save();
        }

    }
}
