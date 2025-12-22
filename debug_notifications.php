
<?php

// Script to diagnose notification issues
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Ticket;
use App\Notifications\TicketSubmittedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

echo "=== NOTIFICATION DIAGNOSIS ===\n\n";

// 1. Check if notifications table exists
echo "1. CHECKING NOTIFICATIONS TABLE:\n";
try {
    $notifications = DB::table('notifications')->get();
    echo "Notifications table exists with " . $notifications->count() . " records\n";

    if ($notifications->count() > 0) {
        echo "Sample notification:\n";
        $sample = $notifications->first();
        echo "  - ID: " . ($sample->id ?? 'NULL') . "\n";
        echo "  - Type: " . ($sample->type ?? 'NULL') . "\n";
        echo "  - Notifiable Type: " . ($sample->notifiable_type ?? 'NULL') . "\n";
        echo "  - Notifiable ID: " . ($sample->notifiable_id ?? 'NULL') . "\n";
        echo "  - Data: " . ($sample->data ?? 'NULL') . "\n";
        echo "  - Read At: " . ($sample->read_at ?? 'NULL') . "\n";
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

// 2. Check users and their default panels
echo "\n2. USERS AND DEFAULT PANELS:\n";
$users = User::with('employee')->get();

foreach (['manager', 'admin', 'employee'] as $panel) {
    $panelUsers = $users->filter(function($user) use ($panel) {
        return $user->default_panel === $panel;
    });

    echo "$panel users: " . $panelUsers->count() . "\n";

    foreach ($panelUsers->take(2) as $user) {
        echo "  - {$user->name} ({$user->email}) - Panel: {$user->default_panel}\n";
    }
}

// 3. Test sending notifications manually
echo "\n3. TESTING NOTIFICATION SENDING:\n";

// Get a manager user
$managerUser = User::where('default_panel', 'manager')->first();
if ($managerUser) {
    echo "Testing notification to manager: {$managerUser->name} ({$managerUser->email})\n";

    // Create a test ticket
    $testTicket = Ticket::first();
    if ($testTicket) {
        echo "Using ticket #{$testTicket->id} for test\n";

        try {
            // Test notification sending
            $notification = new TicketSubmittedNotification($testTicket);
            $managerUser->notify($notification);
            echo "  - Notification sent successfully!\n";

            // Check if notification was stored
            $storedNotifications = DB::table('notifications')
                ->where('notifiable_type', User::class)
                ->where('notifiable_id', $managerUser->id)
                ->get();

            echo "  - Stored notifications for this user: " . $storedNotifications->count() . "\n";

        } catch (Exception $e) {
            echo "  - ERROR sending notification: " . $e->getMessage() . "\n";
        }
    } else {
        echo "  - No tickets found for testing\n";
    }
} else {
    echo "  - No manager users found\n";
}

// 4. Check if notifications are being retrieved correctly
echo "\n4. TESTING NOTIFICATION RETRIEVAL:\n";

$managerUser = User::where('default_panel', 'manager')->first();
if ($managerUser) {
    try {
        $notifications = $managerUser->notifications;
        echo "Notifications retrieved: " . $notifications->count() . "\n";

        foreach ($notifications->take(3) as $notification) {
            echo "  - ID: {$notification->id}\n";
            echo "    Type: " . get_class($notification) . "\n";
            echo "    Data: " . json_encode($notification->data) . "\n";
            echo "    Read: " . ($notification->read_at ? 'Yes' : 'No') . "\n";
        }
    } catch (Exception $e) {
        echo "ERROR retrieving notifications: " . $e->getMessage() . "\n";
    }
}

// 5. Test routes
echo "\n5. TESTING NOTIFICATION ROUTES:\n";
$managerUser = User::where('default_panel', 'manager')->first();
if ($managerUser) {
    $testTicket = Ticket::first();
    if ($testTicket) {
        try {
            $route = route('filament.manager.resources.tickets.view', ['record' => $testTicket->id]);
            echo "Manager route: $route\n";

            $route = route('filament.admin.resources.tickets.view', ['record' => $testTicket->id]);
            echo "Admin route: $route\n";

        } catch (Exception $e) {
            echo "ERROR generating routes: " . $e->getMessage() . "\n";
        }
    }
}

// 6. Check queue configuration
echo "\n6. CHECKING QUEUE CONFIGURATION:\n";
try {
    $queueDriver = config('queue.default');
    echo "Queue driver: $queueDriver\n";

    $queueConnections = config('queue.connections');
    echo "Available queue connections: " . implode(', ', array_keys($queueConnections)) . "\n";

} catch (Exception $e) {
    echo "ERROR checking queue config: " . $e->getMessage() . "\n";
}

echo "\n=== DIAGNOSIS COMPLETE ===\n";

