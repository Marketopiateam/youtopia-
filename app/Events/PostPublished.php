<?php

namespace App\Events;

use App\Models\WorklifePost;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostPublished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public WorklifePost $post;

    /**
     * Create a new event instance.
     */
    public function __construct(WorklifePost $post)
    {
        $this->post = $post;
    }
}
