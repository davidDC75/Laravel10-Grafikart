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

            $category = DB::table('categories')->inRandomOrder()->first();

            $post=new Post();
            $title=($i+1)." Article de ".$faker->name();
            $post->title=$title;
            $post->slug=\Str::slug($title);
            $content='';
            for ($j=0;$j<30;$j++) {
                $content.=(' '.$faker->text());
            }
            $content=($i+1).$content;
            $post->content=$content;
            $post->category_id=$category->id;
            $post->save();
        }

    }
}
