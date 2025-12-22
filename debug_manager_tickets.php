<?php

// Debug script to examine data relationships for tickets and managers
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Employee;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

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
        echo "  - Manager Employee ID: {$manager->employee->manager_employee_id}\n";
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
    echo "Employee: {$employee->user?->name} ({$employee->user?->email})\n";
    echo "  - Employee ID: {$employee->id}\n";
    echo "  - Manager Employee ID: {$employee->manager_employee_id}\n";
    if ($employee->manager) {
        echo "  - Manager: {$employee->manager->user?->name} ({$employee->manager->user?->email})\n";
    }
    echo "\n";
}

// 3. Check tickets and their relationships
echo "3. TICKETS WITH RELATIONSHIPS:\n";
$tickets = Ticket::with(['user.employee', 'user.employee.manager'])
    ->get();

echo "Found " . $tickets->count() . " tickets:\n";
foreach ($tickets as $ticket) {
    echo "Ticket #{$ticket->id} - Status: {$ticket->status}\n";
    echo "  - User: {$ticket->user?->name} ({$ticket->user?->email})\n";
    if ($ticket->user?->employee) {
        echo "  - Employee ID: {$ticket->user->employee->id}\n";
        echo "  - Manager Employee ID: {$ticket->user->employee->manager_employee_id}\n";
        if ($ticket->user->employee->manager) {
            echo "  - Manager: {$ticket->user->employee->manager->user?->name}\n";
        }
    }
    echo "\n";
}

// 4. Test the exact query used in TicketResource for managers
echo "4. MANAGER PANEL QUERY TEST:\n";
$panel = 'manager';
if ($panel === 'manager') {
    // Simulate PanelContext::currentEmployeeId()
    $managerEmployeeId = Employee::query()
        ->where('user_id', function($q) {
            // This would normally be the authenticated user ID
            $q->select('id')->from('users')->where('email', 'manager1@demo.com');
        })
        ->value('id');

    echo "Manager Employee ID from PanelContext: {$managerEmployeeId}\n";

    if ($managerEmployeeId) {
        $query = Ticket::query()
            ->with(['user.employee.profile', 'type'])
            ->whereHas('user.employee', function($e) use ($managerEmployeeId) {
                $e->where('manager_employee_id', $managerEmployeeId);
            });

        $matchingTickets = $query->get();
        echo "Tickets matching manager query: " . $matchingTickets->count() . "\n";

        foreach ($matchingTickets as $ticket) {
            echo "  - Ticket #{$ticket->id} from {$ticket->user?->name}\n";
        }
    }
}

echo "\n=== DEBUG COMPLETE ===\n";
