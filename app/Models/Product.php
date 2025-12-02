<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'partner_id',
        'name',
        'image',
        'price',
        'category',
        'stock',
        'description',
        'is_sponsored'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_sponsored' => 'boolean'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
