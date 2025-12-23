# Module 8: Worklife Social Network - Complete Implementation

## ✅ Enums Created (3/3)
- ✅ ConversationType
- ✅ VoteStatus  
- ✅ SurveyStatus

---

## 📋 MIGRATIONS (19 Total)

### 1. Worklife Posts
```php
// File: database/migrations/2025_12_21_000080_create_worklife_posts_table.php
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
            $table->foreignId('author_employee_id')->constrained('employees')->restrictOnDelete();
            $table->string('source_type')->nullable(); // Polymorphic
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('post_type')->default('general'); // WorklifePostType enum
            $table->text('content');
            $table->string('audience_type')->default('company'); // AudienceType enum
            $table->unsignedBigInteger('audience_id')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['source_type', 'source_id']);
            $table->index(['audience_type', 'audience_id']);
            $table->index(['author_employee_id', 'published_at']);
            $table->index('is_pinned');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_posts');
    }
};
```

### 2. Worklife Comments
```php
// File: database/migrations/2025_12_21_000081_create_worklife_comments_table.php
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
            $table->foreignId('author_employee_id')->constrained('employees')->restrictOnDelete();
            $table->foreignId('parent_comment_id')->nullable()->constrained('worklife_comments')->cascadeOnDelete();
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();

            $table->index('post_id');
            $table->index('parent_comment_id');
            $table->index('author_employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_comments');
    }
};
```

### 3. Worklife Likes
```php
// File: database/migrations/2025_12_21_000082_create_worklife_likes_table.php
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

### 4. Worklife Reactions
```php
// File: database/migrations/2025_12_21_000083_create_worklife_reactions_table.php
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
            $table->index('employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_reactions');
    }
};
```

### 5. Worklife Attachments
```php
// File: database/migrations/2025_12_21_000084_create_worklife_attachments_table.php
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
            $table->string('file_type');
            $table->unsignedBigInteger('file_size');
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

### 6. Worklife Groups
```php
// File: database/migrations/2025_12_21_000085_create_worklife_groups_table.php
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
            $table->index('created_by_employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_groups');
    }
};
```

### 7. Conversations
```php
// File: database/migrations/2025_12_21_000086_create_conversations_table.php
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
            $table->string('type')->default('direct'); // ConversationType enum
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

### 8. Conversation Participants
```php
// File: database/migrations/2025_12_21_000087_create_conversation_participants_table.php
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

### 9. Messages
```php
// File: database/migrations/2025_12_21_000088_create_messages_table.php
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
            $table->foreignId('sender_employee_id')->constrained('employees')->restrictOnDelete();
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

### 10. Message Reads
```php
// File: database/migrations/2025_12_21_000089_create_message_reads_table.php
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
            $table->index('employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_reads');
    }
};
```

### 11. Message Attachments
```php
// File: database/migrations/2025_12_21_000090_create_message_attachments_table.php
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
            $table->string('file_type');
            $table->unsignedBigInteger('file_size');
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

### 12. Votes
```php
// File: database/migrations/2025_12_21_000091_create_votes_table.php
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
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->boolean('is_anonymous')->default(false);
            $table->string('status')->default('draft'); // VoteStatus enum
            $table->timestamps();

            $table->index(['audience_type', 'audience_id']);
            $table->index(['status', 'starts_at', 'ends_at']);
            $table->index('created_by_employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
```

### 13. Vote Options
```php
// File: database/migrations/2025_12_21_000092_create_vote_options_table.php
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

### 14. Vote Ballots
```php
// File: database/migrations/2025_12_21_000093_create_vote_ballots_table.php
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
            $table->index('option_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vote_ballots');
    }
};
```

### 15. Surveys
```php
// File: database/migrations/2025_12_21_000094_create_surveys_table.php
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
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->boolean('is_anonymous')->default(false);
            $table->string('status')->default('draft'); // SurveyStatus enum
            $table->timestamps();

            $table->index(['audience_type', 'audience_id']);
            $table->index(['status', 'starts_at', 'ends_at']);
            $table->index('created_by_employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
```

### 16. Survey Questions
```php
// File: database/migrations/2025_12_21_000095_create_survey_questions_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('surveys')->cascadeOnDelete();
            $table->text('question_text');
            $table->string('question_type'); // text, multiple_choice, rating
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index(['survey_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_questions');
    }
};
```

### 17. Survey Options
```php
// File: database/migrations/2025_12_21_000096_create_survey_options_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('survey_questions')->cascadeOnDelete();
            $table->string('option_text');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index(['question_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_options');
    }
};
```

### 18. Survey Responses
```php
// File: database/migrations/2025_12_21_000097_create_survey_responses_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('surveys')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->timestamp('submitted_at');
            $table->timestamps();

            $table->unique(['survey_id', 'employee_id']);
            $table->index('employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
```

### 19. Survey Answers
```php
// File: database/migrations/2025_12_21_000098_create_survey_answers_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('response_id')->constrained('survey_responses')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('survey_questions')->cascadeOnDelete();
            $table->foreignId('option_id')->nullable()->constrained('survey_options')->nullOnDelete();
            $table->text('answer_text')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamps();

            $table->index('response_id');
            $table->index('question_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_answers');
    }
};
```

---

## 🎯 IMPLEMENTATION INSTRUCTIONS

### Step 1: Copy all 19 migration files above
Create each file in `database/migrations/` with the exact filename and content.

### Step 2: Run migrations
```bash
php artisan migrate
```

### Step 3: Create Models (see next section)

---

## 📦 MODELS (19 Total)

Due to length, models are provided in `REMAINING_MODULES_COMPLETE_IMPLEMENTATION.md`.

Quick reference for model creation:
```bash
php artisan make:model WorklifePost
php artisan make:model WorklifeComment
php artisan make:model WorklifeLike
php artisan make:model WorklifeReaction
php artisan make:model WorklifeAttachment
php artisan make:model WorklifeGroup
php artisan make:model Conversation
php artisan make:model ConversationParticipant
php artisan make:model Message
php artisan make:model MessageRead
php artisan make:model MessageAttachment
php artisan make:model Vote
php artisan make:model VoteOption
php artisan make:model VoteBallot
php artisan make:model Survey
php artisan make:model SurveyQuestion
php artisan make:model SurveyOption
php artisan make:model SurveyResponse
php artisan make:model SurveyAnswer
```

---

## ✅ COMPLETION STATUS

After implementing Module 8, your system will be **100% COMPLETE** with:
- ✅ 72 Database Tables
- ✅ 70 Eloquent Models
- ✅ 20 Type-Safe Enums
- ✅ Complete HRMS/ERP System

**Estimated Implementation Time:** 4-6 hours

---

**For complete model code with relationships, see:**
- `REMAINING_MODULES_COMPLETE_IMPLEMENTATION.md`
- `HRMS_COMPLETE_IMPLEMENTATION.md`
