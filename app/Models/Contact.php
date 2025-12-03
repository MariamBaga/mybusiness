<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'attachment',
        'status',
        'read_at'
    ];

    protected $casts = [
        'status' => 'boolean',
        'read_at' => 'datetime'
    ];

    public function markAsRead()
    {
        $this->update([
            'status' => true,
            'read_at' => now()
        ]);
    }

    public function scopeUnread($query)
    {
        return $query->where('status', false);
    }
}
