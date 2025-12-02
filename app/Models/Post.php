<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'category_id', // relation avec Category
        'status'       // true = publié, false = brouillon
    ];

    // Génération automatique du slug
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    // Scope : ne récupérer que les posts publiés
    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    // Relation avec la catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation many-to-many avec les tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
