<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    // Ajouter le trait Sluggable
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'content'
    ];

    // C'est ici qu'on défini le(ou les) slug
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }
}
