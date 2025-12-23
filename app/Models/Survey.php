<?php

namespace App\Models;

use App\Enums\SurveyStatus;
use App\Enums\AudienceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'created_by_employee_id',
        'audience_type',
        'audience_id',
        'starts_at',
        'ends_at',
        'is_anonymous',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_anonymous' => 'boolean',
        'status' => SurveyStatus::class,
        'audience_type' => AudienceType::class,
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'created_by_employee_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(SurveyQuestion::class)->orderBy('order');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', SurveyStatus::Published)
                    ->where(function ($q) {
                        $q->whereNull('starts_at')
                          ->orWhere('starts_at', '<=', now());
                    })
                    ->where(function ($q) {
                        $q->whereNull('ends_at')
                          ->orWhere('ends_at', '>=', now());
                    });
    }

    public function scopeForAudience($query, Employee $employee)
    {
        return $query->where(function ($q) use ($employee) {
            $q->where('audience_type', AudienceType::Company)
              ->orWhere(function ($sq) use ($employee) {
                  $sq->where('audience_type', AudienceType::Department)
                     ->where('audience_id', $employee->department_id);
              })
              ->orWhere(function ($sq) use ($employee) {
                  $sq->where('audience_type', AudienceType::Team)
                     ->where('audience_id', $employee->department_id); // Assuming team = department
              });
        });
    }
}
