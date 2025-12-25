<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'is_active',
        'needs_dates',
        'needs_amount',
        'allow_attachments'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'needs_dates' => 'boolean',
        'needs_amount' => 'boolean',
        'allow_attachments' => 'boolean',
    ];
}
