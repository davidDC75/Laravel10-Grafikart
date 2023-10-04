<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            // Sélectionne une catégorie au hasard
            $category = DB::table('categories')->inRandomOrder()->first();

            $post=new Post();
            $title=($i+1)." Article de ".$faker->name();
            $post->title=$title;
            $post->slug=\Str::slug($title);
            $post->image=null;
            $content='';
            for ($j=0;$j<30;$j++) {
                $content.=(' '.$faker->text());
            }
            $content=($i+1).$content;
            $post->content=$content;
            $post->category_id=$category->id;
            // Ajoute des tags au hasard
            $tblTags=[];
            $nbTags=rand(1,6);
            for ($n=0;$n<$nbTags;$n++) {
                $exit=false;
                do {
                    $tag = DB::table('tags')->inRandomOrder()->first();
                    if (array_search($tag->id,$tblTags)==false) {
                        $tblTags[] = $tag->id;
                        $exit=true;
                    }
                } while (!$exit);
            }
            $post->save();
            $post->tags()->sync($tblTags);
        }

    }
}
