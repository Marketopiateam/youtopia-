<?php

namespace App\Events;

use App\Models\OkrObjective;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OKRObjectiveCompleted
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public OkrObjective $objective
    ) {}
}
