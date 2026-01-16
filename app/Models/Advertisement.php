<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'url',
        'placement',
        'start_date',
        'end_date',
        'views',
        'clicks',
        'type',
        'status',
        'priority',
        'target',
        'advertiser_id',
        'advertiser_name',
        'price_paid',
        'payment_status',
        'payment_method',
        'transaction_id'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'boolean',
        'views' => 'integer',
        'clicks' => 'integer'
    ];

    public function isActive()
    {
        $now = now();
        return $this->status &&
               $now->gte($this->start_date) &&
               $now->lte($this->end_date);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function incrementClicks()
    {
        $this->increment('clicks');
    }
}
