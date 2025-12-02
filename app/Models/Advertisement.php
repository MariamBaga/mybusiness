<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'title',
        'image',
        'url',
        'placement',
        'start_date',
        'end_date',
        'views',
        'clicks',
        'type'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    // Vérifier si la publicité est active
    public function isActive()
    {
        return now()->between($this->start_date, $this->end_date);
    }
}
