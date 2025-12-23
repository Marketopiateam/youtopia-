# HRMS/ERP Complete Implementation Guide

## 📋 Overview

This guide provides step-by-step instructions for implementing the complete enterprise-grade HRMS/ERP system with 81 tables across 10 modules.

---

## ✅ What Has Been Completed

### Phase 1: Core Infrastructure ✅
- ✅ **17 Enums Created:**
  - JobPostStatus, ApplicationStatus, InterviewStatus, OfferStatus
  - OnboardingTaskStatus, AttendanceStatus, LeaveStatus
  - PayrollCycleStatus, OKRScope, OKRStatus, ReviewStatus
  - MeetingStatus, ApprovalStatus, WorklifePostType
  - AudienceType, PayslipItemType, GoalType

- ✅ **Activity Logging System:**
  - Migration: `2025_12_21_000001_create_activity_logs_table.php`
  - Model: `app/Models/ActivityLog.php`

### Phase 2: Module 1 - Recruitment & Onboarding ✅
- ✅ **6 Migrations Created:**
  - `2025_12_21_000010_create_job_posts_table.php`
  - `2025_12_21_000011_create_job_applications_table.php`
  - `2025_12_21_000012_create_interviews_table.php`
  - `2025_12_21_000013_create_interview_interviewers_table.php`
  - `2025_12_21_000014_create_offer_letters_table.php`
  - `2025_12_21_000015_create_onboarding_tasks_table.php`

- ✅ **3 Models Created:**
  - `app/Models/JobPost.php` (with event firing)
  - `app/Models/JobApplication.php`
  - Partial models documented in HRMS_COMPLETE_IMPLEMENTATION.md

---

## 📦 What Needs to Be Implemented

### Remaining Models for Module 1
Create these model files from the code in `HRMS_COMPLETE_IMPLEMENTATION.md`:
- [ ] `app/Models/Interview.php`
- [ ] `app/Models/OfferLetter.php`
- [ ] `app/Models/OnboardingTask.php`

### Module 2: Attendance & Leave
- [ ] 8 Migrations (code provided in ERD document)
- [ ] 8 Models (code provided in implementation document)

### Module 3: Payroll
- [ ] 7 Migrations
- [ ] 7 Models

### Module 4: OKR & Performance
- [ ] 9 Migrations
- [ ] 9 Models

### Module 5: Company Strategy & Goals
- [ ] 3 Migrations
- [ ] 3 Models

### Module 6: Meetings
- [ ] 5 Migrations
- [ ] 5 Models

### Module 7: Workflow & Approvals
- [ ] 4 Migrations + 1 ticket migration
- [ ] 4 Models

### Module 8: Worklife (Social Network)
- [ ] 19 Migrations
- [ ] 19 Models

### Events & Listeners
- [ ] `app/Events/JobPostPublished.php`
- [ ] `app/Listeners/CreateWorklifePostForJobOpening.php`
- [ ] `app/Events/MeetingCreated.php`
- [ ] `app/Listeners/CreateWorklifeAnnouncementForMeeting.php`
- [ ] `app/Listeners/SendMeetingNotifications.php`
- [ ] `app/Events/OKRObjectiveCompleted.php`
- [ ] `app/Listeners/CreateWorklifeAchievementPost.php`
- [ ] `app/Events/LeaveRequestSubmitted.php`
- [ ] `app/Listeners/CreateApprovalRequest.php`
- [ ] `app/Events/ApprovalActionTaken.php`
- [ ] `app/Listeners/NotifyNextApprover.php`
- [ ] `app/Listeners/NotifyRequester.php`
- [ ] Register all in `EventServiceProvider.php`

### Policies
Create policies for all new models with RBAC rules:
- [ ] JobPostPolicy
- [ ] JobApplicationPolicy
- [ ] InterviewPolicy
- [ ] OnboardingTaskPolicy
- [ ] AttendanceLogPolicy
- [ ] LeaveRequestPolicy
- [ ] PayrollCyclePolicy
- [ ] PayslipPolicy
- [ ] OKRObjectivePolicy
- [ ] PerformanceReviewPolicy
- [ ] MeetingPolicy
- [ ] ApprovalWorkflowPolicy
- [ ] WorklifePostPolicy
- [ ] And more...

### Query Scopes
Implement global scopes for RBAC:
- [ ] `app/Models/Scopes/EmployeeScope.php`
- [ ] `app/Models/Scopes/ManagerScope.php`
- [ ] Apply to relevant models

### Filament Resources (HR Panel)
- [ ] Dashboard Widgets (5 widgets)
- [ ] RecruitmentResource (JobPosts, Applications, Interviews)
- [ ] OnboardingResource
- [ ] AttendanceResource
- [ ] LeaveResource
- [ ] PayrollResource
- [ ] OKRResource
- [ ] PerformanceResource
- [ ] GoalsResource
- [ ] MeetingResource
- [ ] WorkflowResource
- [ ] WorklifeResource
- [ ] ChatResource
- [ ] VotingResource
- [ ] SurveyResource

### Seeders
- [ ] LeaveTypeSeeder
- [ ] AllowanceTypeSeeder
- [ ] DeductionTypeSeeder
- [ ] AttendanceShiftSeeder
- [ ] ApprovalWorkflowSeeder

---

## 🚀 Implementation Steps

### Step 1: Complete Remaining Models for Module 1
```bash
# Create the 3 remaining models from HRMS_COMPLETE_IMPLEMENTATION.md
# Copy the code for Interview, OfferLetter, and OnboardingTask models
```

### Step 2: Implement Module 2 (Attendance & Leave)
```bash
# Create 8 migrations (timestamps: 2025_12_21_000020 to 000027)
# Create 8 models
# All code is provided in HRMS_COMPLETE_IMPLEMENTATION.md
```

### Step 3: Implement Module 3 (Payroll)
```bash
# Create 7 migrations (timestamps: 2025_12_21_000030 to 000036)
# Create 7 models
```

### Step 4: Implement Module 4 (OKR & Performance)
```bash
# Create 9 migrations (timestamps: 2025_12_21_000040 to 000048)
# Create 9 models
```

### Step 5: Implement Module 5 (Company Strategy & Goals)
```bash
# Create 3 migrations (timestamps: 2025_12_21_000050 to 000052)
# Create 3 models
```

### Step 6: Implement Module 6 (Meetings)
```bash
# Create 5 migrations (timestamps: 2025_12_21_000060 to 000064)
# Create 5 models
```

### Step 7: Implement Module 7 (Workflow & Approvals)
```bash
# Create 4 migrations (timestamps: 2025_12_21_000070 to 000073)
# Create 1 migration to add approval_request_id to tickets table
# Create 4 models
```

### Step 8: Implement Module 8 (Worklife)
```bash
# Create 19 migrations (timestamps: 2025_12_21_000080 to 000098)
# Create 19 models
```

### Step 9: Create Events & Listeners
```bash
php artisan make:event JobPostPublished
php artisan make:listener CreateWorklifePostForJobOpening --event=JobPostPublished
# ... create all other events and listeners
```

### Step 10: Create Policies
```bash
php artisan make:policy JobPostPolicy --model=JobPost
# ... create all other policies
```

### Step 11: Create Filament Resources
```bash
php artisan make:filament-resource JobPost --generate
# ... create all other resources
```

### Step 12: Create Seeders
```bash
php artisan make:seeder LeaveTypeSeeder
# ... create all other seeders
```

### Step 13: Run Migrations
```bash
php artisan migrate
```

### Step 14: Run Seeders
```bash
php artisan db:seed --class=LeaveTypeSeeder
php artisan db:seed --class=AllowanceTypeSeeder
php artisan db:seed --class=DeductionTypeSeeder
php artisan db:seed --class=AttendanceShiftSeeder
php artisan db:seed --class=ApprovalWorkflowSeeder
```

---

## 📝 Migration Order (Critical!)

Migrations must be run in this exact order due to foreign key dependencies:

### Phase 1: Core Infrastructure
1. `2025_12_21_000001_create_activity_logs_table.php`

### Phase 2: Recruitment & Onboarding
2. `2025_12_21_000010_create_job_posts_table.php`
3. `2025_12_21_000011_create_job_applications_table.php`
4. `2025_12_21_000012_create_interviews_table.php`
5. `2025_12_21_000013_create_interview_interviewers_table.php`
6. `2025_12_21_000014_create_offer_letters_table.php`
7. `2025_12_21_000015_create_onboarding_tasks_table.php`

### Phase 3: Attendance & Leave
8. `2025_12_21_000020_create_attendance_devices_table.php`
9. `2025_12_21_000021_create_attendance_shifts_table.php`
10. `2025_12_21_000022_create_shift_assignments_table.php`
11. `2025_12_21_000023_create_attendance_logs_table.php`
12. `2025_12_21_000024_create_leave_types_table.php`
13. `2025_12_21_000025_create_leave_balances_table.php`
14. `2025_12_21_000026_create_leave_requests_table.php`
15. `2025_12_21_000027_create_overtime_requests_table.php`

### Phase 4: Payroll
16. `2025_12_21_000030_create_employee_bank_accounts_table.php`
17. `2025_12_21_000031_create_allowance_types_table.php`
18. `2025_12_21_000032_create_deduction_types_table.php`
19. `2025_12_21_000033_create_salary_history_table.php`
20. `2025_12_21_000034_create_payroll_cycles_table.php`
21. `2025_12_21_000035_create_payslips_table.php`
22. `2025_12_21_000036_create_payslip_items_table.php`

### Phase 5: OKR & Performance
23. `2025_12_21_000040_create_okr_cycles_table.php`
24. `2025_12_21_000041_create_okr_objectives_table.php`
25. `2025_12_21_000042_create_okr_key_results_table.php`
26. `2025_12_21_000043_create_okr_checkins_table.php`
27. `2025_12_21_000044_create_performance_review_templates_table.php`
28. `2025_12_21_000045_create_performance_reviews_table.php`
29. `2025_12_21_000046_create_review_questions_table.php`
30. `2025_12_21_000047_create_review_answers_table.php`
31. `2025_12_21_000048_create_peer_feedbacks_table.php`

### Phase 6: Company Strategy & Goals
32. `2025_12_21_000050_create_company_goals_table.php`
33. `2025_12_21_000051_create_department_goals_table.php`
34. `2025_12_21_000052_create_goal_links_table.php`

### Phase 7: Meetings
35. `2025_12_21_000060_create_meetings_table.php`
36. `2025_12_21_000061_create_meeting_attendees_table.php`
37. `2025_12_21_000062_create_meeting_agenda_items_table.php`
38. `2025_12_21_000063_create_meeting_minutes_table.php`
39. `2025_12_21_000064_create_meeting_action_items_table.php`

### Phase 8: Workflow & Approvals
40. `2025_12_21_000070_create_approval_workflows_table.php`
41. `2025_12_21_000071_create_approval_steps_table.php`
42. `2025_12_21_000072_create_approval_requests_table.php`
43. `2025_12_21_000073_create_approval_actions_table.php`
44. `2025_12_21_000074_add_approval_request_to_tickets_table.php`

### Phase 9: Worklife (Social Network)
45. `2025_12_21_000080_create_worklife_posts_table.php`
46. `2025_12_21_000081_create_worklife_comments_table.php`
47. `2025_12_21_000082_create_worklife_likes_table.php`
48. `2025_12_21_000083_create_worklife_reactions_table.php`
49. `2025_12_21_000084_create_worklife_attachments_table.php`
50. `2025_12_21_000085_create_worklife_groups_table.php`
51. `2025_12_21_000086_create_conversations_table.php`
52. `2025_12_21_000087_create_conversation_participants_table.php`
53. `2025_12_21_000088_create_messages_table.php`
54. `2025_12_21_000089_create_message_reads_table.php`
55. `2025_12_21_000090_create_message_attachments_table.php`
56. `2025_12_21_000091_create_votes_table.php`
57. `2025_12_21_000092_create_vote_options_table.php`
58. `2025_12_21_000093_create_vote_ballots_table.php`
59. `2025_12_21_000094_create_surveys_table.php`
60. `2025_12_21_000095_create_survey_questions_table.php`
61. `2025_12_21_000096_create_survey_options_table.php`
62. `2025_12_21_000097_create_survey_responses_table.php`
63. `2025_12_21_000098_create_survey_answers_table.php`

---

## 🔐 RBAC Implementation Strategy

### Role Definitions
```php
// In RolesSeeder or similar
'super_admin' => full access to everything
'admin' => full access to everything
'hr' => HR modules + payroll (configurable)
'manager' => team data only (where manager_employee_id = auth employee id)
'employee' => own data only
```

### Policy Template
```php
public function viewAny(User $user): bool
{
    if ($user->hasRole(['super_admin', 'admin'])) {
        return true;
    }
    
    if ($user->hasRole('hr')) {
        return true; // or specific logic
    }
    
    if ($user->hasRole('manager')) {
        return true; // will be filtered by scope
    }
    
    if ($user->hasRole('employee')) {
        return true; // will be filtered by scope
    }
    
    return false;
}

public function view(User $user, Model $model): bool
{
    if ($user->hasRole(['super_admin', 'admin', 'hr'])) {
        return true;
    }
    
    if ($user->hasRole('manager')) {
        // Check if model belongs to manager's team
        return $model->employee->manager_employee_id === $user->employee->id;
    }
    
    if ($user->hasRole('employee')) {
        // Check if model belongs to user
        return $model->employee_id === $user->employee->id;
    }
    
    return false;
}
```

### Global Scope Template
```php
<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class EmployeeScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = auth()->user();
        
        if (!$user) {
            return;
        }
        
        // Admin and HR see everything
        if ($user->hasRole(['super_admin', 'admin', 'hr'])) {
            return;
        }
        
        // Manager sees team data
        if ($user->hasRole('manager') && $user->employee) {
            $builder->whereHas('employee', function ($query) use ($user) {
                $query->where('manager_employee_id', $user->employee->id);
            });
            return;
        }
        
        // Employee sees own data
        if ($user->hasRole('employee') && $user->employee) {
            $builder->where('employee_id', $user->employee->id);
        }
    }
}
```

---

## 🎯 Automation Rules Implementation

### 1. JobPost Published → Worklife Post
```php
// In JobPost model
protected static function booted(): void
{
    static::updated(function (JobPost $jobPost) {
        if ($jobPost->isDirty('status') && $jobPost->status === JobPostStatus::Published) {
            event(new JobPostPublished($jobPost));
        }
    });
}

// In CreateWorklifePostForJobOpening listener
public function handle(JobPostPublished $event): void
{
    WorklifePost::create([
        'author_employee_id' => $event->jobPost->created_by_employee_id,
        'source_type' => JobPost::class,
        'source_id' => $event->jobPost->id,
        'post_type' => WorklifePostType::Auto,
        'content' => "New Job Opening: {$event->jobPost->title}",
        'audience_type' => AudienceType::Company,
        'published_at' => now(),
    ]);
}
```

### 2. Meeting Created → Worklife Post + Notifications
```php
// In Meeting model
protected static function booted(): void
{
    static::created(function (Meeting $meeting) {
        event(new MeetingCreated($meeting));
    });
}

// In CreateWorklifeAnnouncementForMeeting listener
public function handle(MeetingCreated $event): void
{
    $attendeeIds = $event->meeting->attendees->pluck('employee_id')->toArray();
    
    WorklifePost::create([
        'author_employee_id' => $event->meeting->organizer_employee_id,
        'source_type' => Meeting::class,
        'source_id' => $event->meeting->id,
        'post_type' => WorklifePostType::Announcement,
        'content' => "Meeting Scheduled: {$event->meeting->title}",
        'audience_type' => AudienceType::Custom,
        'audience_id' => json_encode($attendeeIds),
        'published_at' => now(),
    ]);
}

// In SendMeetingNotifications listener
public function handle(MeetingCreated $event): void
{
    foreach ($event->meeting->attendees as $attendee) {
        $attendee->employee->user->notify(
            new MeetingScheduledNotification($event->meeting)
        );
    }
}
```

### 3. OKR Objective Completed → Achievement Post
```php
// In OKRObjective model
protected static function booted(): void
{
    static::updated(function (OKRObjective $objective) {
        if ($objective->isDirty('status') && $objective->status === OKRStatus::Completed) {
            event(new OKRObjectiveCompleted($objective));
        }
    });
}

// In CreateWorklifeAchievementPost listener
public function handle(OKRObjectiveCompleted $event): void
{
    $objective = $event->objective;
    
    [$audienceType, $audienceId] = match($objective->scope) {
        OKRScope::Company => [AudienceType::Company, null],
        OKRScope::Department => [AudienceType::Department, $objective->scope_id],
        OKRScope::Employee => [AudienceType::Custom, json_encode([
            $objective->scope_id,
            $objective->employee->manager_employee_id,
        ])],
    };
    
    WorklifePost::create([
        'author_employee_id' => $objective->owner_employee_id,
        'source_type' => OKRObjective::class,
        'source_id' => $objective->id,
        'post_type' => WorklifePostType::Achievement,
        'content' => "🎉 Objective Completed: {$objective->title}",
        'audience_type' => $audienceType,
        'audience_id' => $audienceId,
        'published_at' => now(),
    ]);
}
```

---

## 📊 Dashboard Widgets

### 1. PendingApprovalsWidget
Shows count of pending approval requests assigned to current user.

### 2. TodayAttendanceAnomaliesWidget
Shows employees who are late, absent, or haven't checked in today.

### 3. UpcomingInterviewsWidget
Shows interviews scheduled for the next 7 days.

### 4. PayrollCycleStatusWidget
Shows current payroll cycle status and progress.

### 5. ActiveOKRProgressWidget
Shows progress of active OKR objectives.

---

## 🔄 Backward Compatibility for Tickets

### Migration Strategy
```php
// In migration: 2025_12_21_000074_add_approval_request_to_tickets_table.php
Schema::table('tickets', function (Blueprint $table) {
    $table->foreignId('approval_request_id')
        ->nullable()
        ->after('hr_actor_email')
        ->constrained('approval_requests')
        ->nullOnDelete();
});

// Keep existing fields:
// - manager_approved, manager_reason, manager_action_at, manager_actor_email
// - hr_approved, hr_reason, hr_action_at, hr_actor_email

// New tickets will use approval_request_id
// Old tickets will continue to use legacy fields
```

### Logic in Ticket Model
```php
public function isApproved(): bool
{
    // New workflow system
    if ($this->approval_request_id) {
        return $this->approvalRequest->status === ApprovalStatus::Approved;
    }
    
    // Legacy system
    return $this->manager_approved && $this->hr_approved;
}
```

---

## 📚 Reference Documents

1. **HRMS_ERD_COMPLETE.md** - Complete database schema with all 81 tables
2. **HRMS_COMPLETE_IMPLEMENTATION.md** - All migrations and models code
3. **HRMS_IMPLEMENTATION_TODO.md** - Progress tracking checklist

---

## 🎓 Next Steps

1. **Review the ERD** (`HRMS_ERD_COMPLETE.md`) to understand the complete database structure
2. **Copy migration code** from `HRMS_COMPLETE_IMPLEMENTATION.md` for each module
3. **Copy model code** from `HRMS_COMPLETE_IMPLEMENTATION.md` for each module
4. **Create events and listeners** for automation
5. **Create policies** for RBAC
6. **Create Filament resources** for UI
7. **Create seeders** for initial data
8. **Test thoroughly** across all panels

---

## ⚠️ Important Notes

1. **Do not skip migration order** - Foreign keys depend on correct order
2. **Test RBAC thoroughly** - Ensure managers only see their team data
3. **Backup existing data** before running migrations
4. **Test automation events** - Ensure Worklife posts are created correctly
5. **Monitor performance** - Add indexes as needed for large datasets

---

## 🆘 Support

If you encounter issues:
1. Check migration order
2. Verify foreign key relationships
3. Ensure enums are properly imported
4. Check policy and scope implementations
5. Review event listener registrations

---

## 🎉 Conclusion

This is a comprehensive enterprise-grade HRMS/ERP system with:
- ✅ 81 tables across 10 modules
- ✅ Complete RBAC with policies and scopes
- ✅ Automated Worklife posts for key events
- ✅ Multi-panel Filament UI (admin/hr/manager/employee)
- ✅ Backward compatibility with existing tickets
- ✅ Scalable architecture for future growth

Good luck with your implementation! 🚀
