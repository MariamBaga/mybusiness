<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'excerpt',
        'category_id',
        'author_id',
        'status',
        'views',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'published_at'
    ];

    protected $casts = [
        'status' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime'
    ];

    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
            if (empty($post->excerpt)) {
                $post->excerpt = Str::limit(strip_tags($post->content), 150);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', true)
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', false);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Essayer plusieurs emplacements
            $paths = [
                public_path('StockPiece/posts/' . $this->image),
                public_path('storage/posts/' . $this->image),
                storage_path('app/public/posts/' . $this->image)
            ];

            foreach ($paths as $path) {
                if (file_exists($path)) {
                    if (strpos($path, 'StockPiece') !== false) {
                        return asset('StockPiece/posts/' . $this->image);
                    } elseif (strpos($path, 'storage') !== false) {
                        return asset('storage/posts/' . $this->image);
                    }
                }
            }
        }
        return asset('images/default-post.jpg');
    }
}
