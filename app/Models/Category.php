<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    // Un post appartient à une catégorie
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
