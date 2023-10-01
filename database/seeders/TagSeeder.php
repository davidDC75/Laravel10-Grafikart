<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tblTags=[
            'Jouet','Photo','Vidéo','IA','OS','Apple','Microsoft','IBM','Oracle','PhP','Dev','DevOps',
            'Jeu Vidéo', 'Databases', 'Interview'
        ];
        foreach ($tblTags as $tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        }
    }
}
