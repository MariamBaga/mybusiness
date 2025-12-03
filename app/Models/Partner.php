<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'logo',
        'website',
        'description',
        'address',
        'status',
        'type',
        'featured'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            if (file_exists(public_path('storage/partners/' . $this->logo))) {
                return asset('storage/partners/' . $this->logo);
            }
            return asset('images/default-partner.png');
        }
        return asset('images/default-partner.png');
    }
}
