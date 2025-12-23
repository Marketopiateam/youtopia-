# Complete HRMS/ERP Entity Relationship Diagram (ERD)

## Overview
This document provides the complete database schema for the enterprise-grade HRMS/ERP system with 80+ tables across 10 modules.

---

## Module 1: Recruitment & Onboarding (6 tables)

### job_posts
- **PK:** id
- **Fields:**
  - title (string)
  - description (text)
  - requirements (text, nullable)
  - department_id (FK → departments.id, nullable, onDelete: nullOnDelete)
  - created_by_employee_id (FK → employees.id, onDelete: cascade)
  - url (string, nullable)
  - status (enum: draft, published, closed, cancelled)
  - published_at (timestamp, nullable)
  - expires_at (timestamp, nullable)
  - timestamps, softDeletes
- **Indexes:**
  - (status, published_at)
  - department_id
  - created_by_employee_id

### job_applications
- **PK:** id
- **Fields:**
  - job_post_id (FK → job_posts.id, onDelete: cascade)
  - applicant_name (string)
  - email (string)
  - phone (string, nullable)
  - resume_path (string, nullable)
  - cover_letter (text, nullable)
  - status (enum: applied, screening, interview, offered, accepted, rejected, withdrawn)
  - applied_at (timestamp)
  - timestamps, softDeletes
- **Indexes:**
  - (job_post_id, status)
  - email
  - applied_at

### interviews
- **PK:** id
- **Fields:**
  - application_id (FK → job_applications.id, onDelete: cascade)
  - scheduled_at (timestamp)
  - location (string, nullable)
  - interview_type (string: in_person, phone, video)
  - status (enum: scheduled, in_progress, completed, cancelled, rescheduled)
  - notes (text, nullable)
  - timestamps, softDeletes
- **Indexes:**
  - (application_id, status)
  - scheduled_at

### interview_interviewers (pivot)
- **PK:** id
- **Fields:**
  - interview_id (FK → interviews.id, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - feedback (text, nullable)
  - rating (integer, nullable)
  - timestamps
- **Indexes:**
  - UNIQUE(interview_id, employee_id)
  - employee_id

### offer_letters
- **PK:** id
- **Fields:**
  - application_id (FK → job_applications.id, onDelete: cascade)
  - offered_position (string)
  - salary_amount (decimal 12,2)
  - currency_code (string(3), default: USD)
  - start_date (date)
  - status (enum: draft, sent, accepted, rejected, expired)
  - sent_at (timestamp, nullable)
  - accepted_at (timestamp, nullable)
  - terms (text, nullable)
  - timestamps, softDeletes
- **Indexes:**
  - (application_id, status)
  - sent_at

### onboarding_tasks
- **PK:** id
- **Fields:**
  - employee_id (FK → employees.id, onDelete: cascade)
  - title (string)
  - description (text, nullable)
  - assigned_by_employee_id (FK → employees.id, onDelete: cascade)
  - due_date (date, nullable)
  - status (enum: pending, in_progress, completed, skipped)
  - completed_at (timestamp, nullable)
  - timestamps, softDeletes
- **Indexes:**
  - (employee_id, status)
  - due_date
  - assigned_by_employee_id

---

## Module 2: Attendance & Leave (8 tables)

### attendance_devices
- **PK:** id
- **Fields:**
  - name (string)
  - location (string, nullable)
  - device_id (string, unique)
  - is_active (boolean, default: true)
  - timestamps
- **Indexes:**
  - is_active

### attendance_shifts
- **PK:** id
- **Fields:**
  - name (string)
  - start_time (time)
  - end_time (time)
  - grace_period_minutes (integer, default: 15)
  - is_active (boolean, default: true)
  - timestamps
- **Indexes:**
  - is_active

### shift_assignments
- **PK:** id
- **Fields:**
  - employee_id (FK → employees.id, onDelete: cascade)
  - shift_id (FK → attendance_shifts.id, onDelete: cascade)
  - effective_from (date)
  - effective_to (date, nullable)
  - timestamps
- **Indexes:**
  - (employee_id, effective_from, effective_to)

### attendance_logs
- **PK:** id
- **Fields:**
  - employee_id (FK → employees.id, onDelete: cascade)
  - device_id (FK → attendance_devices.id, nullable, onDelete: nullOnDelete)
  - check_in (timestamp)
  - check_out (timestamp, nullable)
  - date (date)
  - status (enum: present, absent, late, half_day, on_leave, holiday, weekend)
  - notes (text, nullable)
  - timestamps
- **Indexes:**
  - (employee_id, date)
  - status

### leave_types
- **PK:** id
- **Fields:**
  - name (string)
  - code (string, unique)
  - days_per_year (integer, default: 0)
  - requires_approval (boolean, default: true)
  - is_paid (boolean, default: true)
  - is_active (boolean, default: true)
  - timestamps
- **Indexes:**
  - is_active

### leave_balances
- **PK:** id
- **Fields:**
  - employee_id (FK → employees.id, onDelete: cascade)
  - leave_type_id (FK → leave_types.id, onDelete: cascade)
  - year (year)
  - total_days (decimal 5,2, default: 0)
  - used_days (decimal 5,2, default: 0)
  - remaining_days (decimal 5,2, default: 0)
  - timestamps
- **Indexes:**
  - UNIQUE(employee_id, leave_type_id, year)
  - (employee_id, year)

### leave_requests
- **PK:** id
- **Fields:**
  - employee_id (FK → employees.id, onDelete: cascade)
  - leave_type_id (FK → leave_types.id, onDelete: cascade)
  - from_date (date)
  - to_date (date)
  - days_count (decimal 5,2)
  - reason (text, nullable)
  - status (enum: pending, approved, rejected, cancelled)
  - submitted_at (timestamp)
  - timestamps, softDeletes
- **Indexes:**
  - (employee_id, status)
  - (from_date, to_date)

### overtime_requests
- **PK:** id
- **Fields:**
  - employee_id (FK → employees.id, onDelete: cascade)
  - date (date)
  - hours (decimal 5,2)
  - reason (text, nullable)
  - status (enum: pending, approved, rejected)
  - timestamps, softDeletes
- **Indexes:**
  - (employee_id, status)
  - date

---

## Module 3: Payroll (7 tables)

### employee_bank_accounts
- **PK:** id
- **Fields:**
  - employee_id (FK → employees.id, onDelete: cascade)
  - bank_name (string)
  - account_number (string)
  - iban (string, nullable)
  - swift_code (string, nullable)
  - is_primary (boolean, default: false)
  - timestamps
- **Indexes:**
  - (employee_id, is_primary)

### allowance_types
- **PK:** id
- **Fields:**
  - name (string)
  - code (string, unique)
  - is_taxable (boolean, default: true)
  - is_active (boolean, default: true)
  - timestamps
- **Indexes:**
  - is_active

### deduction_types
- **PK:** id
- **Fields:**
  - name (string)
  - code (string, unique)
  - is_mandatory (boolean, default: false)
  - is_active (boolean, default: true)
  - timestamps
- **Indexes:**
  - is_active

### salary_history
- **PK:** id
- **Fields:**
  - employee_id (FK → employees.id, onDelete: cascade)
  - basic_salary (decimal 12,2)
  - currency_code (string(3), default: USD)
  - effective_from (date)
  - effective_to (date, nullable)
  - changed_by_employee_id (FK → employees.id, nullable, onDelete: nullOnDelete)
  - reason (text, nullable)
  - timestamps
- **Indexes:**
  - (employee_id, effective_from, effective_to)

### payroll_cycles
- **PK:** id
- **Fields:**
  - year (year)
  - month (tinyInteger 1-12)
  - start_date (date)
  - end_date (date)
  - status (enum: draft, processing, processed, approved, paid)
  - processed_at (timestamp, nullable)
  - processed_by_employee_id (FK → employees.id, nullable, onDelete: nullOnDelete)
  - timestamps
- **Indexes:**
  - UNIQUE(year, month)
  - status

### payslips
- **PK:** id
- **Fields:**
  - payroll_cycle_id (FK → payroll_cycles.id, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - basic_salary (decimal 12,2)
  - total_earnings (decimal 12,2)
  - total_deductions (decimal 12,2)
  - net_salary (decimal 12,2)
  - currency_code (string(3), default: USD)
  - generated_at (timestamp)
  - timestamps
- **Indexes:**
  - UNIQUE(payroll_cycle_id, employee_id)
  - employee_id

### payslip_items
- **PK:** id
- **Fields:**
  - payslip_id (FK → payslips.id, onDelete: cascade)
  - item_type (enum: earning, deduction)
  - type_id (unsignedBigInteger) // allowance_type_id or deduction_type_id
  - amount (decimal 12,2)
  - description (string, nullable)
  - timestamps
- **Indexes:**
  - (payslip_id, item_type)

---

## Module 4: OKR & Performance (9 tables)

### okr_cycles
- **PK:** id
- **Fields:**
  - name (string)
  - start_date (date)
  - end_date (date)
  - status (enum: draft, active, on_track, at_risk, completed, cancelled)
  - timestamps
- **Indexes:**
  - status
  - (start_date, end_date)

### okr_objectives
- **PK:** id
- **Fields:**
  - cycle_id (FK → okr_cycles.id, onDelete: cascade)
  - title (string)
  - description (text, nullable)
  - scope (enum: company, department, employee)
  - scope_id (unsignedBigInteger, nullable) // department_id or employee_id
  - owner_employee_id (FK → employees.id, onDelete: cascade)
  - parent_objective_id (FK → okr_objectives.id, nullable, onDelete: cascade)
  - progress_percentage (decimal 5,2, default: 0)
  - status (enum: draft, active, on_track, at_risk, completed, cancelled)
  - timestamps
- **Indexes:**
  - cycle_id
  - (scope, scope_id)
  - owner_employee_id
  - status

### okr_key_results
- **PK:** id
- **Fields:**
  - objective_id (FK → okr_objectives.id, onDelete: cascade)
  - title (string)
  - target_value (decimal 12,2)
  - current_value (decimal 12,2, default: 0)
  - unit (string, nullable)
  - weight_percentage (decimal 5,2, default: 100)
  - status (enum: draft, active, on_track, at_risk, completed, cancelled)
  - timestamps
- **Indexes:**
  - objective_id
  - status

### okr_checkins
- **PK:** id
- **Fields:**
  - key_result_id (FK → okr_key_results.id, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - value (decimal 12,2)
  - notes (text, nullable)
  - checked_in_at (timestamp)
  - timestamps
- **Indexes:**
  - key_result_id
  - employee_id
  - checked_in_at

### performance_review_templates
- **PK:** id
- **Fields:**
  - name (string)
  - description (text, nullable)
  - is_active (boolean, default: true)
  - timestamps
- **Indexes:**
  - is_active

### performance_reviews
- **PK:** id
- **Fields:**
  - template_id (FK → performance_review_templates.id, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - reviewer_employee_id (FK → employees.id, onDelete: cascade)
  - review_period_start (date)
  - review_period_end (date)
  - overall_rating (decimal 3,2, nullable)
  - status (enum: draft, in_progress, submitted, completed)
  - submitted_at (timestamp, nullable)
  - timestamps
- **Indexes:**
  - (employee_id, status)
  - reviewer_employee_id
  - (review_period_start, review_period_end)

### review_questions
- **PK:** id
- **Fields:**
  - template_id (FK → performance_review_templates.id, onDelete: cascade)
  - question_text (text)
  - question_type (string: text, rating, multiple_choice)
  - weight (decimal 5,2, default: 1)
  - order (integer)
  - timestamps
- **Indexes:**
  - template_id
  - order

### review_answers
- **PK:** id
- **Fields:**
  - review_id (FK → performance_reviews.id, onDelete: cascade)
  - question_id (FK → review_questions.id, onDelete: cascade)
  - answer_text (text, nullable)
  - rating (decimal 3,2, nullable)
  - timestamps
- **Indexes:**
  - review_id
  - question_id

### peer_feedbacks
- **PK:** id
- **Fields:**
  - employee_id (FK → employees.id, onDelete: cascade)
  - reviewer_employee_id (FK → employees.id, onDelete: cascade)
  - feedback_text (text)
  - rating (decimal 3,2, nullable)
  - submitted_at (timestamp)
  - timestamps
- **Indexes:**
  - employee_id
  - reviewer_employee_id
  - submitted_at

---

## Module 5: Company Strategy & Goals (3 tables)

### company_goals
- **PK:** id
- **Fields:**
  - title (string)
  - description (text, nullable)
  - quarter (tinyInteger 1-4)
  - year (year)
  - status (enum: draft, active, on_track, at_risk, completed, cancelled)
  - owner_employee_id (FK → employees.id, nullable, onDelete: nullOnDelete)
  - timestamps
- **Indexes:**
  - (quarter, year)
  - status
  - owner_employee_id

### department_goals
- **PK:** id
- **Fields:**
  - department_id (FK → departments.id, onDelete: cascade)
  - title (string)
  - description (text, nullable)
  - quarter (tinyInteger 1-4)
  - year (year)
  - status (enum: draft, active, on_track, at_risk, completed, cancelled)
  - owner_employee_id (FK → employees.id, nullable, onDelete: nullOnDelete)
  - timestamps
- **Indexes:**
  - department_id
  - (quarter, year)
  - status
  - owner_employee_id

### goal_links
- **PK:** id
- **Fields:**
  - goal_type (enum: company, department)
  - goal_id (unsignedBigInteger) // company_goals.id or department_goals.id
  - objective_id (FK → okr_objectives.id, onDelete: cascade)
  - timestamps
- **Indexes:**
  - (goal_type, goal_id)
  - objective_id

---

## Module 6: Meetings (5 tables)

### meetings
- **PK:** id
- **Fields:**
  - title (string)
  - description (text, nullable)
  - scheduled_at (timestamp)
  - duration_minutes (integer)
  - location (string, nullable)
  - meeting_link (string, nullable)
  - organizer_employee_id (FK → employees.id, onDelete: cascade)
  - status (enum: scheduled, in_progress, completed, cancelled)
  - timestamps
- **Indexes:**
  - scheduled_at
  - organizer_employee_id
  - status

### meeting_attendees
- **PK:** id
- **Fields:**
  - meeting_id (FK → meetings.id, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - attendance_status (string: invited, accepted, declined, attended, absent)
  - timestamps
- **Indexes:**
  - meeting_id
  - employee_id
  - UNIQUE(meeting_id, employee_id)

### meeting_agenda_items
- **PK:** id
- **Fields:**
  - meeting_id (FK → meetings.id, onDelete: cascade)
  - title (string)
  - description (text, nullable)
  - order (integer)
  - duration_minutes (integer, nullable)
  - timestamps
- **Indexes:**
  - meeting_id
  - order

### meeting_minutes
- **PK:** id
- **Fields:**
  - meeting_id (FK → meetings.id, onDelete: cascade)
  - content (text)
  - recorded_by_employee_id (FK → employees.id, onDelete: cascade)
  - timestamps
- **Indexes:**
  - meeting_id
  - recorded_by_employee_id

### meeting_action_items
- **PK:** id
- **Fields:**
  - meeting_id (FK → meetings.id, onDelete: cascade)
  - title (string)
  - assigned_to_employee_id (FK → employees.id, onDelete: cascade)
  - due_date (date, nullable)
  - status (enum: pending, in_progress, completed, skipped)
  - timestamps
- **Indexes:**
  - meeting_id
  - assigned_to_employee_id
  - status

---

## Module 7: Workflow & Approvals (4 tables + ticket migration)

### approval_workflows
- **PK:** id
- **Fields:**
  - name (string)
  - entity_type (string: leave_request, expense, ticket, etc.)
  - department_id (FK → departments.id, nullable, onDelete: nullOnDelete)
  - is_active (boolean, default: true)
  - timestamps
- **Indexes:**
  - entity_type
  - department_id
  - is_active

### approval_steps
- **PK:** id
- **Fields:**
  - workflow_id (FK → approval_workflows.id, onDelete: cascade)
  - step_order (integer)
  - approver_role (string, nullable)
  - approver_employee_id (FK → employees.id, nullable, onDelete: nullOnDelete)
  - is_required (boolean, default: true)
  - timestamps
- **Indexes:**
  - workflow_id
  - step_order

### approval_requests
- **PK:** id
- **Fields:**
  - workflow_id (FK → approval_workflows.id, onDelete: cascade)
  - requestable_type (string) // polymorphic
  - requestable_id (unsignedBigInteger) // polymorphic
  - requester_employee_id (FK → employees.id, onDelete: cascade)
  - current_step (integer, default: 1)
  - status (enum: pending, in_progress, approved, rejected, cancelled)
  - submitted_at (timestamp)
  - completed_at (timestamp, nullable)
  - timestamps
- **Indexes:**
  - workflow_id
  - (requestable_type, requestable_id)
  - requester_employee_id
  - status

### approval_actions
- **PK:** id
- **Fields:**
  - approval_request_id (FK → approval_requests.id, onDelete: cascade)
  - step_id (FK → approval_steps.id, onDelete: cascade)
  - approver_employee_id (FK → employees.id, onDelete: cascade)
  - action (enum: approved, rejected)
  - notes (text, nullable)
  - acted_at (timestamp)
  - timestamps
- **Indexes:**
  - approval_request_id
  - step_id
  - approver_employee_id

### tickets (migration to add workflow support)
**Add fields:**
- approval_request_id (FK → approval_requests.id, nullable, onDelete: nullOnDelete)

**Keep existing fields for backward compatibility:**
- manager_approved, manager_reason, manager_action_at, manager_actor_email
- hr_approved, hr_reason, hr_action_at, hr_actor_email

---

## Module 8: Worklife (19 tables)

### worklife_posts
- **PK:** id
- **Fields:**
  - author_employee_id (FK → employees.id, onDelete: cascade)
  - source_type (string, nullable) // polymorphic
  - source_id (unsignedBigInteger, nullable) // polymorphic
  - post_type (enum: announcement, achievement, general, auto)
  - content (text)
  - audience_type (enum: company, department, team, role, custom)
  - audience_id (unsignedBigInteger, nullable)
  - is_pinned (boolean, default: false)
  - published_at (timestamp)
  - timestamps, softDeletes
- **Indexes:**
  - author_employee_id
  - (source_type, source_id)
  - post_type
  - (audience_type, audience_id)
  - published_at
  - is_pinned

### worklife_comments
- **PK:** id
- **Fields:**
  - post_id (FK → worklife_posts.id, onDelete: cascade)
  - author_employee_id (FK → employees.id, onDelete: cascade)
  - parent_comment_id (FK → worklife_comments.id, nullable, onDelete: cascade)
  - content (text)
  - timestamps, softDeletes
- **Indexes:**
  - post_id
  - author_employee_id
  - parent_comment_id

### worklife_likes
- **PK:** id
- **Fields:**
  - post_id (FK → worklife_posts.id, nullable, onDelete: cascade)
  - comment_id (FK → worklife_comments.id, nullable, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - timestamps
- **Indexes:**
  - post_id
  - comment_id
  - employee_id
  - UNIQUE(post_id, employee_id) where post_id is not null
  - UNIQUE(comment_id, employee_id) where comment_id is not null

### worklife_reactions
- **PK:** id
- **Fields:**
  - post_id (FK → worklife_posts.id, nullable, onDelete: cascade)
  - comment_id (FK → worklife_comments.id, nullable, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - reaction_type (string: like, love, celebrate, support, insightful)
  - timestamps
- **Indexes:**
  - post_id
  - comment_id
  - employee_id

### worklife_attachments
- **PK:** id
- **Fields:**
  - post_id (FK → worklife_posts.id, nullable, onDelete: cascade)
  - comment_id (FK → worklife_comments.id, nullable, onDelete: cascade)
  - file_path (string)
  - file_name (string)
  - file_type (string)
  - file_size (integer)
  - timestamps
- **Indexes:**
  - post_id
  - comment_id

### worklife_groups
- **PK:** id
- **Fields:**
  - name (string)
  - description (text, nullable)
  - department_id (FK → departments.id, nullable, onDelete: nullOnDelete)
  - created_by_employee_id (FK → employees.id, onDelete: cascade)
  - is_private (boolean, default: false)
  - timestamps
- **Indexes:**
  - department_id
  - created_by_employee_id
  - is_private

### conversations
- **PK:** id
- **Fields:**
  - type (enum: direct, group)
  - title (string, nullable)
  - timestamps
- **Indexes:**
  - type

### conversation_participants
- **PK:** id
- **Fields:**
  - conversation_id (FK → conversations.id, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - joined_at (timestamp)
  - left_at (timestamp, nullable)
  - timestamps
- **Indexes:**
  - conversation_id
  - employee_id
  - UNIQUE(conversation_id, employee_id)

### messages
- **PK:** id
- **Fields:**
  - conversation_id (FK → conversations.id, onDelete: cascade)
  - sender_employee_id (FK → employees.id, onDelete: cascade)
  - content (text)
  - timestamps, softDeletes
- **Indexes:**
  - conversation_id
  - sender_employee_id
  - created_at

### message_reads
- **PK:** id
- **Fields:**
  - message_id (FK → messages.id, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - read_at (timestamp)
  - timestamps
- **Indexes:**
  - message_id
  - employee_id
  - UNIQUE(message_id, employee_id)

### message_attachments
- **PK:** id
- **Fields:**
  - message_id (FK → messages.id, onDelete: cascade)
  - file_path (string)
  - file_name (string)
  - file_type (string)
  - file_size (integer)
  - timestamps
- **Indexes:**
  - message_id

### votes
- **PK:** id
- **Fields:**
  - title (string)
  - description (text, nullable)
  - created_by_employee_id (FK → employees.id, onDelete: cascade)
  - audience_type (enum: company, department, team, role, custom)
  - audience_id (unsignedBigInteger, nullable)
  - starts_at (timestamp)
  - ends_at (timestamp)
  - is_anonymous (boolean, default: false)
  - status (enum: draft, active, completed, cancelled)
  - timestamps
- **Indexes:**
  - created_by_employee_id
  - (audience_type, audience_id)
  - status
  - (starts_at, ends_at)

### vote_options
- **PK:** id
- **Fields:**
  - vote_id (FK → votes.id, onDelete: cascade)
  - option_text (string)
  - order (integer)
  - timestamps
- **Indexes:**
  - vote_id
  - order

### vote_ballots
- **PK:** id
- **Fields:**
  - vote_id (FK → votes.id, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - option_id (FK → vote_options.id, onDelete: cascade)
  - voted_at (timestamp)
  - timestamps
- **Indexes:**
  - vote_id
  - employee_id
  - option_id
  - UNIQUE(vote_id, employee_id)

### surveys
- **PK:** id
- **Fields:**
  - title (string)
  - description (text, nullable)
  - created_by_employee_id (FK → employees.id, onDelete: cascade)
  - audience_type (enum: company, department, team, role, custom)
  - audience_id (unsignedBigInteger, nullable)
  - starts_at (timestamp)
  - ends_at (timestamp)
  - is_anonymous (boolean, default: false)
  - status (enum: draft, active, completed, cancelled)
  - timestamps
- **Indexes:**
  - created_by_employee_id
  - (audience_type, audience_id)
  - status
  - (starts_at, ends_at)

### survey_questions
- **PK:** id
- **Fields:**
  - survey_id (FK → surveys.id, onDelete: cascade)
  - question_text (text)
  - question_type (enum: text, multiple_choice, rating)
  - is_required (boolean, default: false)
  - order (integer)
  - timestamps
- **Indexes:**
  - survey_id
  - order

### survey_options
- **PK:** id
- **Fields:**
  - question_id (FK → survey_questions.id, onDelete: cascade)
  - option_text (string)
  - order (integer)
  - timestamps
- **Indexes:**
  - question_id
  - order

### survey_responses
- **PK:** id
- **Fields:**
  - survey_id (FK → surveys.id, onDelete: cascade)
  - employee_id (FK → employees.id, onDelete: cascade)
  - submitted_at (timestamp)
  - timestamps
- **Indexes:**
  - survey_id
  - employee_id
  - UNIQUE(survey_id, employee_id)

### survey_answers
- **PK:** id
- **Fields:**
  - response_id (FK → survey_responses.id, onDelete: cascade)
  - question_id (FK → survey_questions.id, onDelete: cascade)
  - option_id (FK → survey_options.id, nullable, onDelete: cascade)
  - answer_text (text, nullable)
  - rating (integer, nullable)
  - timestamps
- **Indexes:**
  - response_id
  - question_id

---

## Module 9: Activity Logging (1 table)

### activity_logs
- **PK:** id
- **Fields:**
  - actor_user_id (FK → users.id, nullable, onDelete: nullOnDelete)
  - action (string: created, updated, deleted, viewed, etc.)
  - subject_type (string) // polymorphic
  - subject_id (unsignedBigInteger) // polymorphic
  - properties (json, nullable) // old/new values, metadata
  - ip_address (string(45), nullable)
  - user_agent (text, nullable)
  - created_at (timestamp only, no updated_at)
- **Indexes:**
  - (subject_type, subject_id)
  - (actor_user_id, created_at)
  - action

---

## Summary Statistics

- **Total Tables:** 81
- **Total Foreign Keys:** 150+
- **Total Indexes:** 200+
- **Polymorphic Relationships:** 8
- **Soft Deletes:** 25+ tables
- **Enums:** 17 enum classes

---

## Key Relationships Summary

1. **Employee-centric:** Most tables relate to employees table
2.
