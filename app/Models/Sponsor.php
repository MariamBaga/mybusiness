<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'url',
        'description',
        'level',
        'status',
        'order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            if (file_exists(public_path('storage/sponsors/' . $this->logo))) {
                return asset('storage/sponsors/' . $this->logo);
            }
            return asset('images/default-sponsor.png');
        }
        return asset('images/default-sponsor.png');
    }
}
