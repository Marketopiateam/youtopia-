<?php

namespace App\Models;

use App\Enums\OfferStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferLetter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'application_id',
        'offered_position',
        'salary_amount',
        'currency_code',
        'start_date',
        'status',
        'sent_at',
        'accepted_at',
        'terms',
    ];

    protected $casts = [
        'status' => OfferStatus::class,
        'salary_amount' => 'decimal:2',
        'start_date' => 'date',
        'sent_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class, 'application_id');
    }
}
