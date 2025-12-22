<?php

// Script to fix ticket-manager relationship issues
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Employee;
use App\Models\Ticket;
use App\Enums\TicketStatus;
use App\Enums\TicketPriority;

echo "=== FIXING TICKET-MANAGER RELATIONSHIP ===\n\n";

try {
    DB::beginTransaction();

    // 1. Fix broken user-employee relationships
    echo "1. FIXING BROKEN USER-EMPLOYEE RELATIONSHIPS...\n";

    // Find employees without users
    $orphanedEmployees = Employee::leftJoin('users', 'employees.user_id', '=', 'users.id')
        ->whereNull('users.id')
        ->select('employees.*')
        ->get();

    echo "Found " . $orphanedEmployees->count() . " orphaned employees\n";

    foreach ($orphanedEmployees as $employee) {
        // Find matching user by email or create new user
        $user = User::where('email', 'employee_' . $employee->id . '@demo.com')->first();

        if (!$user) {
            // Create a new user for this employee
            $user = User::create([
                'name' => 'Employee User ' . $employee->id,
                'email' => 'employee_' . $employee->id . '@demo.com',
                'password' => 'password',
                'default_panel' => 'employee',
            ]);
            $user->assignRole('employee');
        }

        $employee->update(['user_id' => $user->id]);
        echo "  - Fixed Employee ID {$employee->id} -> User ID {$user->id}\n";
    }

    // 2. Fix the manager-employee relationships for existing tickets
    echo "\n2. FIXING MANAGER-EMPLOYEE RELATIONSHIPS...\n";

    // Get the first manager's employee ID
    $managerEmployee = Employee::whereHas('user.roles', function($q) {
        $q->where('name', 'manager');
    })->first();

    if ($managerEmployee) {
        echo "Found Manager Employee ID: {$managerEmployee->id}\n";

        // Get employees who should be assigned to this manager but aren't
        $unassignedEmployees = Employee::whereNull('manager_employee_id')
            ->whereHas('user', function($q) {
                $q->whereHas('roles', function($rq) {
                    $rq->where('name', 'employee');
                });
            })
            ->limit(10) // Limit to avoid assigning too many at once
            ->get();

        foreach ($unassignedEmployees as $employee) {
            $employee->update(['manager_employee_id' => $managerEmployee->id]);
            echo "  - Assigned Employee ID {$employee->id} to Manager ID {$managerEmployee->id}\n";
        }
    }

    // 3. Fix existing tickets to be associated with employees who have managers
    echo "\n3. FIXING EXISTING TICKETS...\n";

    $tickets = Ticket::with(['user.employee'])->get();

    foreach ($tickets as $ticket) {
        if ($ticket->user && $ticket->user->employee && !$ticket->user->employee->manager_employee_id) {
            // Find an employee with a manager to reassign this ticket to
            $employeeWithManager = Employee::whereNotNull('manager_employee_id')
                ->whereHas('user', function($q) {
                    $q->whereHas('roles', function($rq) {
                        $rq->where('name', 'employee');
                    });
                })
                ->first();

            if ($employeeWithManager) {
                // Reassign ticket to employee with manager
                $ticket->update(['user_id' => $employeeWithManager->user_id]);
                echo "  - Reassigned Ticket #{$ticket->id} to Employee ID {$employeeWithManager->id}\n";
            }
        }
    }

    // 4. Create new tickets for employees with managers if needed
    echo "\n4. CREATING NEW TICKETS FOR MANAGED EMPLOYEES...\n";

    $ticketTypes = \App\Models\TicketType::all();

    if ($ticketTypes->isNotEmpty() && $managerEmployee) {
        $managedEmployees = Employee::where('manager_employee_id', $managerEmployee->id)
            ->whereHas('user', function($q) {
                $q->whereHas('roles', function($rq) {
                    $rq->where('name', 'employee');
                });
            })
            ->with('user')
            ->get();

        foreach ($managedEmployees as $employee) {
            // Check if this employee already has tickets
            $existingTickets = Ticket::where('user_id', $employee->user_id)->count();

            if ($existingTickets == 0) {
                // Create a new ticket for this employee
                $ticket = Ticket::create([
                    'user_id' => $employee->user_id,
                    'ticket_type_id' => $ticketTypes->random()->id,
                    'reason' => 'Sample ticket for ' . ($employee->user?->name ?? 'Employee'),
                    'priority' => collect(TicketPriority::cases())->random(),
                    'expected_from' => now()->addDays(rand(1, 30)),
                    'expected_to' => now()->addDays(rand(31, 60)),
                    'amount' => rand(100, 1000),
                    'status' => TicketStatus::PendingManager,
                ]);

                echo "  - Created Ticket #{$ticket->id} for Employee ID {$employee->id} ({$employee->user?->name})\n";
            } else {
                echo "  - Employee ID {$employee->id} already has {$existingTickets} tickets\n";
            }
        }
    }

    DB::commit();
    echo "\n=== FIXES APPLIED SUCCESSFULLY ===\n";

} catch (Exception $e) {
    DB::rollBack();
    echo "\nERROR: " . $e->getMessage() . "\n";
    echo "Rollback completed.\n";
}

// Final verification
echo "\n=== FINAL VERIFICATION ===\n";

// Test the manager panel query again
$managerEmployeeId = Employee::query()
    ->whereHas('user.roles', function($q) {
        $q->where('name', 'manager');
    })
    ->value('id');

echo "Manager Employee ID: " . ($managerEmployeeId ?? 'NULL') . "\n";

if ($managerEmployeeId) {
    $matchingTickets = Ticket::with(['user.employee', 'type'])
        ->whereHas('user.employee', function($e) use ($managerEmployeeId) {
            $e->where('manager_employee_id', $managerEmployeeId);
        })
        ->get();

    echo "Tickets matching manager query: " . $matchingTickets->count() . "\n";

    foreach ($matchingTickets as $ticket) {
        $status = $ticket->status instanceof TicketStatus ? $ticket->status->value : (string) $ticket->status;
        $userName = $ticket->user?->name ?? 'NO USER';
        echo "  - Ticket #{$ticket->id} from {$userName} (Status: {$status})\n";
    }
}
