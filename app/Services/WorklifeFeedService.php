<?php

namespace App\Services;

use App\Enums\ReactionType;
use App\Events\PostPublished;
use App\Models\Employee;
use App\Models\WorklifeAttachment;
use App\Models\WorklifeComment;
use App\Models\WorklifePost;
use App\Models\WorklifeReaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

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
                'author.user',
                'source',
                'comments.author',
                'comments.replies.author',
                'reactions.employee.user',
                'comments.reactions.employee.user',
                'attachments',
                'comments.attachments',
                'audienceGroup',
            ])
            ->visibleTo($employee)
            ->published()
            ->orderBy('is_pinned', 'desc')
            ->latest('published_at')
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

        if (! isset($data['published_at'])) {
            $post->published_at = now();
        }

        $post->save();

        event(new PostPublished($post));

        return $post;
    }

    /**
     * Add a reaction to a reactable model (WorklifePost or WorklifeComment).
     *
     * @param Employee $employee The employee adding the reaction.
     * @param Model $reactable The model to react to (WorklifePost or WorklifeComment).
     * @param ReactionType $reactionType The type of reaction.
     * @return WorklifeReaction
     */
    public function addReaction(Employee $employee, Model $reactable, ReactionType $reactionType): WorklifeReaction
    {
        $reaction = WorklifeReaction::firstOrCreate([
            'reactable_type' => $reactable->getMorphClass(),
            'reactable_id' => $reactable->id,
            'employee_id' => $employee->id,
            'reaction_type' => $reactionType->value,
        ]);

        // TODO: Dispatch ReactionAdded event
        return $reaction;
    }

    /**
     * Remove a reaction from a reactable model.
     *
     * @param Employee $employee The employee removing the reaction.
     * @param Model $reactable The model to remove the reaction from.
     * @param ReactionType $reactionType The type of reaction to remove.
     * @return void
     */
    public function removeReaction(Employee $employee, Model $reactable, ReactionType $reactionType): void
    {
        WorklifeReaction::where([
            'reactable_type' => $reactable->getMorphClass(),
            'reactable_id' => $reactable->id,
            'employee_id' => $employee->id,
            'reaction_type' => $reactionType->value,
        ])->delete();

        // TODO: Dispatch ReactionRemoved event
    }

    /**
     * Add a comment to a worklife post.
     *
     * @param Employee $author The employee authoring the comment.
     * @param WorklifePost $post The post to comment on.
     * @param string $content The content of the comment.
     * @param WorklifeComment|null $parentComment The parent comment if this is a reply.
     * @return WorklifeComment
     */
    public function addComment(Employee $author, WorklifePost $post, string $content, ?WorklifeComment $parentComment = null): WorklifeComment
    {
        if (! $author->user_id) {
            throw new InvalidArgumentException('Employee must have a user to author comments.');
        }

        $comment = $post->comments()->create([
            'author_user_id' => $author->user_id,
            'content' => $content,
            'parent_comment_id' => $parentComment?->id,
        ]);

        // TODO: Dispatch CommentAdded event
        return $comment;
    }

    /**
     * Delete a worklife comment.
     *
     * @param WorklifeComment $comment The comment to delete.
     * @return void
     */
    public function deleteComment(WorklifeComment $comment): void
    {
        $comment->delete();

        // TODO: Dispatch CommentDeleted event
    }

    /**
     * Attach a file to an attachable model (WorklifePost or WorklifeComment).
     * This is a simplified placeholder; real implementation would involve file storage.
     *
     * @param Employee $uploader The employee uploading the file.
     * @param Model $attachable The model to attach the file to.
     * @param array $fileData Array containing file information (e.g., 'path', 'name', 'mime', 'size').
     * @return WorklifeAttachment
     */
    public function attachFile(Employee $uploader, Model $attachable, array $fileData): WorklifeAttachment
    {
        $attachment = $attachable->attachments()->create([
            'uploaded_by_employee_id' => $uploader->id,
            'file_path' => $fileData['file_path'],
            'file_name' => $fileData['file_name'],
            'mime_type' => $fileData['mime_type'] ?? null,
            'file_size' => $fileData['file_size'],
        ]);

        // TODO: Dispatch AttachmentAdded event
        return $attachment;
    }

    /**
     * Detach (soft delete) a worklife attachment.
     *
     * @param WorklifeAttachment $attachment The attachment to detach.
     * @return void
     */
    public function detachFile(WorklifeAttachment $attachment): void
    {
        $attachment->delete();

        // TODO: Dispatch AttachmentRemoved event
    }
}
