<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorklifeComment extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'post_id',
        'author_user_id', // Migration uses author_user_id
        'parent_comment_id',
        'content',
    ];

    /**
     * Get the post that the comment belongs to.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(WorklifePost::class);
    }

    /**
     * Get the author of the comment.
     */
    public function author(): BelongsTo
    {
        // Assuming a User model for authentication, related to Employee
        return $this->belongsTo(User::class, 'author_user_id');
    }

    /**
     * Get the parent comment if this is a reply.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(WorklifeComment::class, 'parent_comment_id');
    }

    /**
     * Get the replies to this comment.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(WorklifeComment::class, 'parent_comment_id');
    }

    /**
     * Get the reactions for the comment.
     */
    public function reactions(): MorphMany
    {
        return $this->morphMany(WorklifeReaction::class, 'reactable');
    }

    /**
     * Get the attachments for the comment.
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(WorklifeAttachment::class, 'attachable');
    }

    /**
     * Scope a query to only include root comments (no parent).
     */
    public function scopeRootComments(Builder $query): Builder
    {
        return $query->whereNull('parent_comment_id');
    }

    /**
     * Scope a query to only include comments for a specific post.
     */
    public function scopeForPost(Builder $query, WorklifePost $post): Builder
    {
        return $query->where('post_id', $post->id);
    }

    /**
     * Scope a query to order comments by creation date (latest first).
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }
}
