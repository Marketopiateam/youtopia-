<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\WorklifePost;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WorklifeFeedService
{
    /**
     * Get the personalized worklife feed for a given employee.
     *
     * @param Employee $employee The employee for whom to retrieve the feed.
     * @param int $perPage The number of posts per page.
     * @param int $page The current page number.
     * @return LengthAwarePaginator A paginated collection of WorklifePost models.
     */
    public function getFeedForEmployee(Employee $employee, int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return WorklifePost::query()
            ->with([
                'author.user', // Assuming employee has a user relation for basic info
                'source', // Load polymorphic source (Announcement, Survey, Vote)
                'comments.author.user', // Load comments and their authors
                'likes.user', // Load likes and the users who liked them
                'audienceGroup', // If audience is a group
            ])
            ->visibleTo($employee) // Apply audience visibility logic
            ->published() // Only show published posts
            ->orderBy('is_pinned', 'desc') // Pinned posts first
            ->latest('published_at') // Latest published posts first
            ->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Publish a new Worklife Post.
     *
     * @param Employee $author The employee publishing the post.
     * @param array $data Data for the post (content, post_type, audience_type, audience_id, etc.).
     * @param Model|null $source Optional polymorphic source model (e.g., Announcement, Survey, Vote).
     * @return WorklifePost
     */
    public function publishPost(Employee $author, array $data, ?Model $source = null): WorklifePost
    {
        $post = new WorklifePost();
        $post->author_employee_id = $author->id;
        $post->fill($data);

        if ($source) {
            $post->source()->associate($source);
        }

        // Ensure published_at is set if not provided and status allows
        if (!isset($data['published_at'])) {
            $post->published_at = now();
        }

        $post->save();

        // TODO: Dispatch PostPublished event
        // event(new PostPublished($post));

        return $post;
    }

    // TODO: Add methods for liking/unliking posts/comments, commenting, etc.
}
