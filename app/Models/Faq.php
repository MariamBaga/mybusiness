<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'status'
    ];

    public function scopeActive($q)
    {
        return $q->where('status', true);
    }
}
