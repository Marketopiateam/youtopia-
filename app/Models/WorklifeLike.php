<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorklifeLike extends Model
{
    protected $fillable = [
        'post_id',
        'comment_id',
        'employee_id',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(WorklifePost::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(WorklifeComment::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeForPost($query, $postId)
    {
        return $query->where('post_id', $postId)->whereNull('comment_id');
    }

    public function scopeForComment($query, $commentId)
    {
        return $query->where('comment_id', $commentId);
    }
}
