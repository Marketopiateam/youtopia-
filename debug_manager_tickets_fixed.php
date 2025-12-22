<?php

// Debug script to examine data relationships for tickets and managers
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Employee;
use App\Models\Ticket;
use App\Enums\TicketStatus;

echo "=== DEBUGGING TICKET-MANAGER RELATIONSHIP ===\n\n";

// 1. Check if managers have employee records
echo "1. MANAGERS WITH EMPLOYEE RECORDS:\n";
$managers = User::whereHas('roles', function($q) {
    $q->where('name', 'manager');
})->with('employee')->get();

foreach ($managers as $manager) {
    echo "Manager: {$manager->name} ({$manager->email})\n";
    if ($manager->employee) {
        echo "  - Employee ID: {$manager->employee->id}\n";
        echo "  - Employee Number: {$manager->employee->employee_number}\n";
        echo "  - Manager Employee ID: " . ($manager->employee->manager_employee_id ?? 'NULL') . "\n";
    } else {
        echo "  - NO EMPLOYEE RECORD!\n";
    }
    echo "\n";
}

// 2. Check employees with managers
echo "2. EMPLOYEES WITH MANAGERS:\n";
$employeesWithManagers = Employee::whereNotNull('manager_employee_id')
    ->with(['user', 'manager.user'])
    ->get();

echo "Found " . $employeesWithManagers->count() . " employees with managers:\n";
foreach ($employeesWithManagers as $employee) {
    $userName = $employee->user?->name ?? 'NO USER';
    $userEmail = $employee->user?->email ?? 'NO EMAIL';
    $managerUserName = $employee->manager?->user?->name ?? 'NO MANAGER USER';
    $managerUserEmail = $employee->manager?->user?->email ?? 'NO MANAGER EMAIL';

    echo "Employee: {$userName} ({$userEmail})\n";
    echo "  - Employee ID: {$employee->id}\n";
    echo "  - Manager Employee ID: {$employee->manager_employee_id}\n";
    echo "  - Manager: {$managerUserName} ({$managerUserEmail})\n";
    echo "\n";
}

// 3. Check tickets and their relationships
echo "3. TICKETS WITH RELATIONSHIPS:\n";
$tickets = Ticket::with(['user.employee', 'user.employee.manager'])
    ->get();

echo "Found " . $tickets->count() . " tickets:\n";
foreach ($tickets as $ticket) {
    $status = $ticket->status instanceof TicketStatus ? $ticket->status->value : (string) $ticket->status;
    $userName = $ticket->user?->name ?? 'NO USER';
    $userEmail = $ticket->user?->email ?? 'NO EMAIL';

    echo "Ticket #{$ticket->id} - Status: {$status}\n";
    echo "  - User: {$userName} ({$userEmail})\n";

    if ($ticket->user?->employee) {
        echo "  - Employee ID: {$ticket->user->employee->id}\n";
        echo "  - Manager Employee ID: " . ($ticket->user->employee->manager_employee_id ?? 'NULL') . "\n";

        if ($ticket->user->employee->manager) {
            $managerName = $ticket->user->employee->manager->user?->name ?? 'NO MANAGER';
            echo "  - Manager: {$managerName}\n";
        }
    }
    echo "\n";
}

// 4. Test the exact query used in TicketResource for managers
echo "4. MANAGER PANEL QUERY TEST:\n";
$panel = 'manager';
if ($panel === 'manager') {
    // Get the first manager's employee ID
    $managerEmployeeId = Employee::query()
        ->whereHas('user.roles', function($q) {
            $q->where('name', 'manager');
        })
        ->value('id');

    echo "Manager Employee ID from PanelContext: " . ($managerEmployeeId ?? 'NULL') . "\n";

    if ($managerEmployeeId) {
        $query = Ticket::query()
            ->with(['user.employee.profile', 'type'])
            ->whereHas('user.employee', function($e) use ($managerEmployeeId) {
                $e->where('manager_employee_id', $managerEmployeeId);
            });

        $matchingTickets = $query->get();
        echo "Tickets matching manager query: " . $matchingTickets->count() . "\n";

        foreach ($matchingTickets as $ticket) {
            $status = $ticket->status instanceof TicketStatus ? $ticket->status->value : (string) $ticket->status;
            $userName = $ticket->user?->name ?? 'NO USER';
            echo "  - Ticket #{$ticket->id} from {$userName} (Status: {$status})\n";
        }
    }
}

echo "\n=== DEBUG COMPLETE ===\n";
