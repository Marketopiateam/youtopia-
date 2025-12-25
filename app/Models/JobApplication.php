<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'job_post_id',
        'applicant_name',
        'email',
        'phone',
        'resume_path',
        'cover_letter',
        'status',
        'applied_at',
    ];

    protected $casts = [
        'status' => ApplicationStatus::class,
        'applied_at' => 'datetime',
    ];

    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(JobPost::class);
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class, 'application_id');
    }

    public function offerLetter(): HasOne
    {
        return $this->hasOne(OfferLetter::class, 'application_id');
    }
}
