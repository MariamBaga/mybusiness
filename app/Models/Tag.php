<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    // Relation many-to-many avec les posts
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
