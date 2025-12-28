<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_handled',
        'handled_at',
    ];

    protected $casts = [
        'is_handled' => 'boolean',
        'handled_at' => 'datetime',
    ];
}
