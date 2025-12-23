# Remaining Modules Complete Implementation Guide

This document provides the complete implementation for:
- Module 5: Company Strategy & Goals ✅ (DONE)
- Module 6: Meetings ✅ (DONE - migrations only, models below)
- Module 7: Workflow & Approvals (4 tables + ticket migration)
- Module 8: Worklife Social Network (19 tables)

---

## Module 5 & 6: Models to Create

### Module 5 Models (Already have migrations, need models)

**CompanyGoal.php** ✅ Created
**DepartmentGoal.php** ✅ Created  
**GoalLink.php** ✅ Created

### Module 6 Models (Migrations done, need models)

#### 1. Meeting.php
```php
<?php

namespace App\Models;

use App\Enums\MeetingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    protected $fillable = [
        'title',
        'description',
        'scheduled_at',
        'duration_minutes',
        'location',
        'meeting_link',
        'organizer_employee_id',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'duration_minutes' => 'integer',
        'status' => MeetingStatus::class,
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'organizer_employee_id');
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(MeetingAttendee::class);
    }

    public function agendaItems(): HasMany
    {
        return $this->hasMany(MeetingAgendaItem::class)->orderBy('order');
    }

    public function minutes(): HasMany
    {
        return $this->hasMany(MeetingMinute::class);
    }

    public function actionItems(): HasMany
    {
        return $this->hasMany(MeetingActionItem::class);
    }
}
```

#### 2. MeetingAttendee.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingAttendee extends Model
{
    protected $fillable = [
        'meeting_id',
        'employee_id',
        'attendance_status',
    ];

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
```

#### 3. MeetingAgendaItem.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingAgendaItem extends Model
{
    protected $fillable = [
        'meeting_id',
        'title',
        'description',
        'order',
        'duration_minutes',
    ];

    protected $casts = [
        'order' => 'integer',
        'duration_minutes' => 'integer',
    ];

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }
}
```

#### 4. MeetingMinute.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingMinute extends Model
{
    protected $fillable = [
        'meeting_id',
        'content',
        'recorded_by_employee_id',
    ];

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'recorded_by_employee_id');
    }
}
```

#### 5. MeetingActionItem.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingActionItem extends Model
{
    protected $fillable = [
        'meeting_id',
        'title',
        'description',
        'assigned_to_employee_id',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assigned_to_employee_id');
    }
}
```

---

## Module 7: Workflow & Approvals

### Migrations

#### 1. 2025_12_21_000070_create_approval_workflows_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_workflows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('entity_type'); // leave_request, expense, ticket, etc.
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['entity_type', 'is_active']);
            $table->index('department_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_workflows');
    }
};
```

#### 2. 2025_12_21_000071_create_approval_steps_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_id')->constrained('approval_workflows')->cascadeOnDelete();
            $table->integer('step_order');
            $table->string('approver_role')->nullable(); // manager, hr, admin
            $table->foreignId('approver_employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->boolean('is_required')->default(true);
            $table->timestamps();

            $table->index(['workflow_id', 'step_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_steps');
    }
};
```

#### 3. 2025_12_21_000072_create_approval_requests_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_id')->constrained('approval_workflows')->restrictOnDelete();
            $table->string('requestable_type'); // Polymorphic
            $table->unsignedBigInteger('requestable_id');
            $table->foreignId('requester_employee_id')->constrained('employees')->restrictOnDelete();
            $table->integer('current_step')->default(1);
            $table->string('status')->default('pending'); // ApprovalStatus enum
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['requestable_type', 'requestable_id']);
            $table->index(['status', 'current_step']);
            $table->index('requester_employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_requests');
    }
};
```

#### 4. 2025_12_21_000073_create_approval_actions_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_request_id')->constrained('approval_requests')->cascadeOnDelete();
            $table->foreignId('step_id')->constrained('approval_steps')->restrictOnDelete();
            $table->foreignId('approver_employee_id')->constrained('employees')->restrictOnDelete();
            $table->string('action'); // approved, rejected
            $table->text('notes')->nullable();
            $table->timestamp('acted_at');
            $table->timestamps();

            $table->index('approval_request_id');
            $table->index(['approver_employee_id', 'acted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_actions');
    }
};
```

#### 5. 2025_12_21_000074_add_workflow_support_to_tickets_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('approval_request_id')->nullable()->after('hr_actor_email')
                ->constrained('approval_requests')->nullOnDelete();
            
            // Keep old fields for backward compatibility but add comment
            $table->comment('Legacy approval fields (manager_approved, hr_approved) kept for backward compatibility');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['approval_request_id']);
            $table->dropColumn('approval_request_id');
        });
    }
};
```

### Models

#### 1. ApprovalWorkflow.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApprovalWorkflow extends Model
{
    protected $fillable = [
        'name',
        'entity_type',
        'department_id',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(ApprovalStep::class, 'workflow_id')->orderBy('step_order');
    }

    public function requests(): HasMany
    {
        return $this->hasMany(ApprovalRequest::class, 'workflow_id');
    }
}
```

#### 2. ApprovalStep.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApprovalStep extends Model
{
    protected $fillable = [
        'workflow_id',
        'step_order',
        'approver_role',
        'approver_employee_id',
        'is_required',
    ];

    protected $casts = [
        'step_order' => 'integer',
        'is_required' => 'boolean',
    ];

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(ApprovalWorkflow::class, 'workflow_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'approver_employee_id');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(ApprovalAction::class, 'step_id');
    }
}
```

#### 3. ApprovalRequest.php
```php
<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ApprovalRequest extends Model
{
    protected $fillable = [
        'workflow_id',
        'requestable_type',
        'requestable_id',
        'requester_employee_id',
        'current_step',
        'status',
        'submitted_at',
        'completed_at',
    ];

    protected $casts = [
        'current_step' => 'integer',
        'status' => ApprovalStatus::class,
        'submitted_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(ApprovalWorkflow::class, 'workflow_id');
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'requester_employee_id');
    }

    public function requestable(): MorphTo
    {
        return $this->morphTo();
    }

    public function actions(): HasMany
    {
        return $this->hasMany(ApprovalAction::class)->orderBy('acted_at');
    }
}
```

#### 4. ApprovalAction.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApprovalAction extends Model
{
    protected $fillable = [
        'approval_request_id',
        'step_id',
        'approver_employee_id',
        'action',
        'notes',
        'acted_at',
    ];

    protected $casts = [
        'acted_at' => 'datetime',
    ];

    public function approvalRequest(): BelongsTo
    {
        return $this->belongsTo(ApprovalRequest::class);
    }

    public function step(): BelongsTo
    {
        return $this->belongsTo(ApprovalStep::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'approver_employee_id');
    }
}
```

---

## Module 8: Worklife Social Network (19 Tables)

### Migrations

#### Worklife Posts & Interactions

##### 1. 2025_12_21_000080_create_worklife_posts_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worklife_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('source_type')->nullable(); // job_post, meeting, okr_objective
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('post_type')->default('general'); // WorklifePostType enum
            $table->longText('content');
            $table->string('audience_type')->default('company'); // AudienceType enum
            $table->unsignedBigInteger('audience_id')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['author_employee_id', 'published_at']);
            $table->index(['source_type', 'source_id']);
            $table->index(['audience_type', 'audience_id']);
            $table->index(['post_type', 'is_pinned']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_posts');
    }
};
```

##### 2. 2025_12_21_000081_create_worklife_comments_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worklife_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('worklife_posts')->cascadeOnDelete();
            $table->foreignId('author_employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('parent_comment_id')->nullable()->constrained('worklife_comments')->cascadeOnDelete();
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['post_id', 'created_at']);
            $table->index('author_employee_id');
            $table->index('parent_comment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_comments');
    }
};
```

##### 3. 2025_12_21_000082_create_worklife_likes_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worklife_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->nullable()->constrained('worklife_posts')->cascadeOnDelete();
            $table->foreignId('comment_id')->nullable()->constrained('worklife_comments')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['post_id', 'employee_id']);
            $table->unique(['comment_id', 'employee_id']);
            $table->index('employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_likes');
    }
};
```

##### 4. 2025_12_21_000083_create_worklife_reactions_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worklife_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->nullable()->constrained('worklife_posts')->cascadeOnDelete();
            $table->foreignId('comment_id')->nullable()->constrained('worklife_comments')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('reaction_type'); // like, love, celebrate, support, insightful
            $table->timestamps();

            $table->unique(['post_id', 'employee_id']);
            $table->unique(['comment_id', 'employee_id']);
            $table->index(['reaction_type', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_reactions');
    }
};
```

##### 5. 2025_12_21_000084_create_worklife_attachments_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worklife_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->nullable()->constrained('worklife_posts')->cascadeOnDelete();
            $table->foreignId('comment_id')->nullable()->constrained('worklife_comments')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->timestamps();

            $table->index('post_id');
            $table->index('comment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_attachments');
    }
};
```

##### 6. 2025_12_21_000085_create_worklife_groups_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worklife_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('created_by_employee_id')->constrained('employees')->restrictOnDelete();
            $table->boolean('is_private')->default(false);
            $table->timestamps();

            $table->index('department_id');
            $table->index(['is_private', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_groups');
    }
};
```

#### Chat System

##### 7. 2025_12_21_000086_create_conversations_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('direct'); // direct, group
            $table->string('title')->nullable();
            $table->timestamps();

            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
```

##### 8. 2025_12_21_000087_create_conversation_participants_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversation_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->timestamp('joined_at')->nullable();
            $table->timestamp('left_at')->nullable();
            $table->timestamps();

            $table->unique(['conversation_id', 'employee_id']);
            $table->index('employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversation_participants');
    }
};
```

##### 9. 2025_12_21_000088_create_messages_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations')->cascadeOnDelete();
            $table->foreignId('sender_employee_id')->constrained('employees')->cascadeOnDelete();
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['conversation_id', 'created_at']);
            $table->index('sender_employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
```

##### 10. 2025_12_21_000089_create_message_reads_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('message_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained('messages')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->timestamp('read_at');
            $table->timestamps();

            $table->unique(['message_id', 'employee_id']);
            $table->index(['employee_id', 'read_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_reads');
    }
};
```

##### 11. 2025_12_21_000090_create_message_attachments_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('message_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained('messages')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->timestamps();

            $table->index('message_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_attachments');
    }
};
```

#### Voting System

##### 12. 2025_12_21_000091_create_votes_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('created_by_employee_id')->constrained('employees')->restrictOnDelete();
            $table->string('audience_type')->default('company'); // AudienceType enum
            $table->unsignedBigInteger('audience_id')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->string('status')->default('draft'); // draft, active, closed
            $table->timestamps();

            $table->index(['status', 'starts_at', 'ends_at']);
            $table->index(['audience_type', 'audience_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
```

##### 13. 2025_12_21_000092_create_vote_options_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vote_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vote_id')->constrained('votes')->cascadeOnDelete();
            $table->string('option_text');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index(['vote_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vote_options');
    }
};
```

##### 14. 2025_12_21_000093_create_vote_ballots_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vote_ballots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vote_id')->constrained('votes')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('option_id')->constrained('vote_options')->cascadeOnDelete();
            $table->timestamp('voted_at');
            $table->timestamps();

            $table->unique(['vote_id', 'employee_id']);
            $table->index(['option_id', 'voted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vote_ballots');
    }
};
```

#### Survey System

##### 15. 2025_12_21_000094_create_surveys_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('created_by_employee_id')->constrained('employees')->restrictOnDelete();
            $table->string('audience_type')->default('company'); // AudienceType enum
            $table->unsignedBigInteger('audience_id')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->string('status')->default('draft'); // draft, active, closed
            $table->timestamps();

            $table->index(['status', 'starts_at', 'ends_at']);
            $table->index(['audience_type', 'audience_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
```

##### 16. 2025_12_21_000095_create_survey_
