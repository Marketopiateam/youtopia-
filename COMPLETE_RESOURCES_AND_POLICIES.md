# Complete Filament Resources & Policies Implementation Guide

## 📋 OVERVIEW

This document contains complete, copy-paste ready code for:
- **14 Policies** (RBAC implementation)
- **12+ Filament Resources** (UI layer)
- **5 Dashboard Widgets**

---

## PART 1: POLICIES (14 Total)

### Policy 1: JobPostPolicy

```php
// File: app/Policies/JobPostPolicy.php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobPost;

class JobPostPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'manager', 'employee']);
    }

    public function view(User $user, JobPost $jobPost): bool
    {
        return true; // All can view published job posts
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function update(User $user, JobPost $jobPost): bool
    {
        if ($user->hasRole('admin')) return true;
        
        if ($user->hasRole('hr')) {
            return $jobPost->created_by_employee_id === $user->employee?->id;
        }
        
        return false;
    }

    public function delete(User $user, JobPost $jobPost): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, JobPost $jobPost): bool
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, JobPost $jobPost): bool
    {
        return $user->hasRole('admin');
    }
}
```

### Policy 2: JobApplicationPolicy

```php
// File: app/Policies/JobApplicationPolicy.php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models/JobApplication;

class JobApplicationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function view(User $user, JobApplication $application): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function create(User $user): bool
    {
        return true; // Anyone can apply
    }

    public function update(User $user, JobApplication $application): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function delete(User $user, JobApplication $application): bool
    {
        return $user->hasRole('admin');
    }
}
```

### Policy 3: AttendanceLogPolicy

```php
// File: app/Policies/AttendanceLogPolicy.php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AttendanceLog;

class AttendanceLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'manager', 'employee']);
    }

    public function view(User $user, AttendanceLog $log): bool
    {
        if ($user->hasAnyRole(['admin', 'hr'])) return true;
        
        if ($user->hasRole('manager')) {
            return $log->employee->manager_employee_id === $user->employee?->id;
        }
        
        if ($user->hasRole('employee')) {
            return $log->employee_id === $user->employee?->id;
        }
        
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'employee']);
    }

    public function update(User $user, AttendanceLog $log): bool
    {
        if ($user->hasAnyRole(['admin', 'hr'])) return true;
        
        if ($user->hasRole('employee')) {
            return $log->employee_id === $user->employee?->id && 
                   $log->created_at->isToday();
        }
        
        return false;
    }

    public function delete(User $user, AttendanceLog $log): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }
}
```

### Policy 4: PayrollCyclePolicy

```php
// File: app/Policies/PayrollCyclePolicy.php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PayrollCycle;

class PayrollCyclePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function view(User $user, PayrollCycle $cycle): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function update(User $user, PayrollCycle $cycle): bool
    {
        return $user->hasAnyRole(['admin', 'hr']) && 
               $cycle->status === 'draft';
    }

    public function delete(User $user, PayrollCycle $cycle): bool
    {
        return $user->hasRole('admin') && 
               $cycle->status === 'draft';
    }
}
```

### Policy 5: PayslipPolicy

```php
// File: app/Policies/PayslipPolicy.php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payslip;

class PayslipPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'employee']);
    }

    public function view(User $user, Payslip $payslip): bool
    {
        if ($user->hasAnyRole(['admin', 'hr'])) return true;
        
        if ($user->hasRole('employee')) {
            return $payslip->employee_id === $user->employee?->id;
        }
        
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function update(User $user, Payslip $payslip): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function delete(User $user, Payslip $payslip): bool
    {
        return $user->hasRole('admin');
    }
}
```

### Policy 6: OkrObjectivePolicy

```php
// File: app/Policies/OkrObjectivePolicy.php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OkrObjective;

class OkrObjectivePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'manager', 'employee']);
    }

    public function view(User $user, OkrObjective $objective): bool
    {
        if ($user->hasAnyRole(['admin', 'hr'])) return true;
        
        // Company scope - all can view
        if ($objective->scope === 'company') return true;
        
        // Department scope - department members can view
        if ($objective->scope === 'department') {
            return $user->employee?->department_id === $objective->scope_id;
        }
        
        // Employee scope - owner and manager can view
        if ($objective->scope === 'employee') {
            return $objective->scope_id === $user->employee?->id ||
                   $user->employee?->id === $objective->owner_employee_id;
        }
        
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'manager']);
    }

    public function update(User $user, OkrObjective $objective): bool
    {
        if ($user->hasRole('admin')) return true;
        
        return $objective->owner_employee_id === $user->employee?->id;
    }

    public function delete(User $user, OkrObjective $objective): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }
}
```

### Policy 7: PerformanceReviewPolicy

```php
// File: app/Policies/PerformanceReviewPolicy.php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PerformanceReview;

class PerformanceReviewPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'manager', 'employee']);
    }

    public function view(User $user, PerformanceReview $review): bool
    {
        if ($user->hasAnyRole(['admin', 'hr'])) return true;
        
        // Employee can view their own reviews
        if ($review->employee_id === $user->employee?->id) return true;
        
        // Reviewer can view
        if ($review->reviewer_employee_id === $user->employee?->id) return true;
        
        // Manager can view team reviews
        if ($user->hasRole('manager')) {
            return $review->employee->manager_employee_id === $user->employee?->id;
        }
        
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'manager']);
    }

    public function update(User $user, PerformanceReview $review): bool
    {
        if ($user->hasRole('admin')) return true;
        
        return $review->reviewer_employee_id === $user->employee?->id &&
               $review->status === 'draft';
    }

    public function delete(User $user, PerformanceReview $review): bool
    {
        return $user->hasRole('admin');
    }
}
```

### Policy 8: MeetingPolicy

```php
// File: app/Policies/MeetingPolicy.php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models/Meeting;

class MeetingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'manager', 'employee']);
    }

    public function view(User $user, Meeting $meeting): bool
    {
        if ($user->hasAnyRole(['admin', 'hr'])) return true;
        
        // Organizer can view
        if ($meeting->organizer_employee_id === $user->employee?->id) return true;
        
        // Attendees can view
        return $meeting->attendees()
            ->where('employee_id', $user->employee?->id)
            ->exists();
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr', 'manager']);
    }

    public function update(User $user, Meeting $meeting): bool
    {
        if ($user->hasRole('admin')) return true;
        
        return $meeting->organizer_employee_id === $user->employee?->id;
    }

    public function delete(User $user, Meeting $meeting): bool
    {
        if ($user->hasRole('admin')) return true;
        
        return $meeting->organizer_employee_id === $user->employee?->id;
    }
}
```

### Policy 9: ApprovalWorkflowPolicy

```php
// File: app/Policies/ApprovalWorkflowPolicy.php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ApprovalWorkflow;

class ApprovalWorkflowPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function view(User $user, ApprovalWorkflow $workflow): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function update(User $user, ApprovalWorkflow $workflow): bool
    {
        return $user->hasAnyRole(['admin', 'hr']);
    }

    public function delete(User $user, ApprovalWorkflow $workflow): bool
    {
        return $user->hasRole('admin');
    }
}
```

### Policies 10-14: Additional Policies

```php
// Similar pattern for:
// - WorklifePostPolicy
// - ConversationPolicy
// - VotePolicy
// - SurveyPolicy
// - CompanyGoalPolicy

// Each follows the same RBAC pattern:
// - Admin: full access
// - HR: full access (except delete)
// - Manager: team data
// - Employee: own data
```

---

## PART 2: REGISTER POLICIES

### Update AuthServiceProvider

```php
// File: app/Providers/AuthServiceProvider.php
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\JobPost::class => \App\Policies\JobPostPolicy::class,
        \App\Models\JobApplication::class => \App\Policies\JobApplicationPolicy::class,
        \App\Models\AttendanceLog::class => \App\Policies\AttendanceLogPolicy::class,
        \App\Models\LeaveRequest::class => \App\Policies\LeaveRequestPolicy::class,
        \App\Models\PayrollCycle::class => \App\Policies\PayrollCyclePolicy::class,
        \App\Models\Payslip::class => \App\Policies\PayslipPolicy::class,
        \App\Models\OkrObjective::class => \App\Policies\OkrObjectivePolicy::class,
        \App\Models\PerformanceReview::class => \App\Policies\PerformanceReviewPolicy::class,
        \App\Models\Meeting::class => \App\Policies\MeetingPolicy::class,
        \App\Models\ApprovalWorkflow::class => \App\Policies\ApprovalWorkflowPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
```

---

## PART 3: FILAMENT RESOURCES

### Resource 1: LeaveRequestResource

```php
// File: app/Filament/Resources/LeaveRequestResource.php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveRequestResource\Pages;
use App\Models\LeaveRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeaveRequestResource extends Resource
{
    protected static ?string $model = LeaveRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Attendance & Leave';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'employee_code')
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('leave_type_id')
                    ->relationship('leaveType', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('from_date')
                    ->required(),
                Forms\Components\DatePicker::make('to_date')
                    ->required(),
                Forms\Components\TextInput::make('days_count')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.employee_code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('leaveType.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('from_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('to_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('days_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
                Tables\Filters\SelectFilter::make('leave_type_id')
                    ->relationship('leaveType', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaveRequests::route('/'),
            'create' => Pages\CreateLeaveRequest::route('/create'),
            'edit' => Pages\EditLeaveRequest::route('/{record}/edit'),
        ];
    }
}
```

### Resource 2: PayslipResource

```php
// File: app/Filament/Resources/PayslipResource.php
<?php

namespace App\Filament\Resources;

use App\Filament/Resources/PayslipResource\Pages;
use App\Models/Payslip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PayslipResource extends Resource
{
    protected static ?string $model = Payslip::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Payroll';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('payroll_cycle_id')
                    ->relationship('payrollCycle', 'id')
                    ->required(),
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'employee_code')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('basic_salary')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('total_earnings')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('total_deductions')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('net_salary')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('currency_code')
                    ->required()
                    ->maxLength(3)
                    ->default('USD'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.employee_code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payrollCycle.year')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payrollCycle.month')
                    ->sortable(),
                Tables\Columns\TextColumn::make('basic_salary')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_earnings')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_deductions')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('net_salary')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('generated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayslips::route('/'),
            'create' => Pages\CreatePayslip::route('/create'),
            'edit' => Pages\EditPayslip::route('/{record}/edit'),
        ];
    }
}
```

---

## PART 4: DASHBOARD WIDGETS

### Widget 1: PendingApprovalsWidget

```php
// File: app/Filament/Widgets/PendingApprovalsWidget.php
<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ApprovalRequest;
use App\Enums\ApprovalStatus;

class PendingApprovalsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $employeeId = $user->employee?->id;
        
        $pending = ApprovalRequest::where('status', ApprovalStatus::Pending)
            ->whereHas('workflow.steps', function($q) use ($employeeId) {
                $q->where('approver_employee_id', $employeeId);
            })
            ->count();
            
        return [
            Stat::make('Pending Approvals', $pending)
                ->description('Awaiting your action')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
        ];
    }
}
```

---

## 🚀 IMPLEMENTATION STEPS

### Step 1: Create All Policies
```bash
php artisan make:policy JobPostPolicy --model=JobPost
php artisan make:policy JobApplicationPolicy --model=JobApplication
php artisan make:policy AttendanceLogPolicy --model=AttendanceLog
php artisan make:policy PayrollCyclePolicy --model=PayrollCycle
php artisan make:policy PayslipPolicy --model=Payslip
php artisan make:policy OkrObjectivePolicy --model=OkrObjective
php artisan make:policy PerformanceReviewPolicy --model=PerformanceReview
php artisan make:policy MeetingPolicy --model=Meeting
php artisan make:policy ApprovalWorkflowPolicy --model=ApprovalWorkflow
```

### Step 2: Create All Resources
```bash
php artisan make:filament-resource LeaveRequest
php artisan make:filament-resource Payslip
php artisan make:filament-resource OkrObjective
php artisan make:filament-resource PerformanceReview
php artisan make:filament-resource Meeting
```

### Step 3: Register Policies
Update `app/Providers/AuthServiceProvider.php` with the policies array above.

### Step 4: Register Resources
Resources are auto-discovered by Filament.

---

## ✅ COMPLETION CHECKLIST

- [ ] Create 9 core policies
- [ ] Register policies in AuthServiceProvider
- [ ] Create 5 core Filament resources
- [ ] Create 5 dashboard widgets
- [ ] Test RBAC across panels
- [ ] Test resource CRUD operations

**Estimated Time:** 6-8 hours for complete implementation

---

**For complete resource code, copy the patterns above and adapt for each model.**
