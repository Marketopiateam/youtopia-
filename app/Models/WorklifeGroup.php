<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorklifeGroup extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_by_employee_id',
    ];

    /**
     * Get the employee who created the group.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'created_by_employee_id');
    }

    /**
     * The employees that belong to the group.
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'worklife_group_employee', 'worklife_group_id', 'employee_id')
            ->withTimestamps();
    }

    /**
     * Get the posts that have this group as an audience.
     */
    public function posts(): HasMany
    {
        // Assuming audience_type is 'group' and audience_id matches group ID
        return $this->hasMany(WorklifePost::class, 'audience_id')
            ->where('audience_type', \App\Enums\AudienceType::Group);
    }
}
