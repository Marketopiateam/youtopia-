<?php

// Script to fix Filament resources navigation configuration

$resources = [
    'JobPosts/JobPostResource.php' => [
        'navigationGroup' => 'Recruitment',
        'navigationLabel' => 'Job Posts',
        'navigationIcon' => 'Heroicon::OutlinedBriefcase',
        'navigationSort' => 1,
    ],
    'JobApplications/JobApplicationResource.php' => [
        'navigationGroup' => 'Recruitment',
        'navigationLabel' => 'Job Applications',
        'navigationIcon' => 'Heroicon::OutlinedDocumentText',
        'navigationSort' => 2,
    ],
    'LeaveRequests/LeaveRequestResource.php' => [
        'navigationGroup' => 'Attendance & Leave',
        'navigationLabel' => 'Leave Requests',
        'navigationIcon' => 'Heroicon::OutlinedCalendarDays',
        'navigationSort' => 1,
    ],
    'PayrollCycles/PayrollCycleResource.php' => [
        'navigationGroup' => 'Payroll',
        'navigationLabel' => 'Payroll Cycles',
        'navigationIcon' => 'Heroicon::OutlinedCurrencyDollar',
        'navigationSort' => 1,
    ],
    'Payslips/PayslipResource.php' => [
        'navigationGroup' => 'Payroll',
        'navigationLabel' => 'Employee Payslips',
        'navigationIcon' => 'Heroicon::OutlinedDocument',
        'navigationSort' => 2,
    ],
    'OkrObjectives/OkrObjectiveResource.php' => [
        'navigationGroup' => 'Performance',
        'navigationLabel' => 'OKR Objectives',
        'navigationIcon' => 'Heroicon::OutlinedChartBar',
        'navigationSort' => 1,
    ],
    'PerformanceReviews/PerformanceReviewResource.php' => [
        'navigationGroup' => 'Performance',
        'navigationLabel' => 'Performance Reviews',
        'navigationIcon' => 'Heroicon::OutlinedStar',
        'navigationSort' => 2,
    ],
    'Meetings/MeetingResource.php' => [
        'navigationGroup' => 'Meetings',
        'navigationLabel' => 'Meetings',
        'navigationIcon' => 'Heroicon::OutlinedVideoCamera',
        'navigationSort' => 1,
    ],
    'ApprovalWorkflows/ApprovalWorkflowResource.php' => [
        'navigationGroup' => 'Workflows',
        'navigationLabel' => 'Approval Workflows',
        'navigationIcon' => 'Heroicon::OutlinedCog6Tooth',
        'navigationSort' => 1,
    ],
    'WorklifePosts/WorklifePostResource.php' => [
        'navigationGroup' => 'Worklife',
        'navigationLabel' => 'Posts',
        'navigationIcon' => 'Heroicon::OutlinedChatBubbleLeftRight',
        'navigationSort' => 1,
    ],
    'Surveys/SurveyResource.php' => [
        'navigationGroup' => 'Worklife',
        'navigationLabel' => 'Surveys',
        'navigationIcon' => 'Heroicon::OutlinedClipboardDocumentList',
        'navigationSort' => 2,
    ],
    'Conversations/ConversationResource.php' => [
        'navigationGroup' => 'Worklife',
        'navigationLabel' => 'Chat',
        'navigationIcon' => 'Heroicon::OutlinedChatBubbleLeft',
        'navigationSort' => 3,
    ],
    'Announcements/AnnouncementResource.php' => [
        'navigationGroup' => 'Communication',
        'navigationLabel' => 'Announcements',
        'navigationIcon' => 'Heroicon::OutlinedMegaphone',
        'navigationSort' => 1,
    ],
];

foreach ($resources as $resourcePath => $config) {
    $fullPath = "app/Filament/Resources/{$resourcePath}";

    if (file_exists($fullPath)) {
        $content = file_get_contents($fullPath);

        // Add navigation properties after the model declaration
        $pattern = '/(protected static \?string \$model = .*?;)/';
        $replacement = '$1

    protected static ?string $navigationGroup = \'' . $config['navigationGroup'] . '\';

    protected static ?string $navigationLabel = \'' . $config['navigationLabel'] . '\';

    protected static string|BackedEnum|null $navigationIcon = ' . $config['navigationIcon'] . ';

    protected static ?int $navigationSort = ' . $config['navigationSort'] . ';';

        $content = preg_replace($pattern, $replacement, $content);

        file_put_contents($fullPath, $content);
        echo "Updated: {$resourcePath}\n";
    } else {
        echo "File not found: {$fullPath}\n";
    }
}

echo "Navigation configuration completed!\n";
