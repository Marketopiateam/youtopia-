<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // RolesSeeder::class,
            // DepartmentSeeder::class,
            // UserSeeder::class,
            // EmployeeSeeder::class,
            // DocumentTypeSeeder::class,
            // TicketTypeSeeder::class,
            // TicketSeeder::class,
            // ActivityLogSeeder::class,
            // AllowanceTypeSeeder::class,
            // AnnouncementSeeder::class,
            // ApprovalWorkflowSeeder::class,
            // ApprovalStepSeeder::class,
            // ApprovalRequestSeeder::class,
            // ApprovalActionSeeder::class,
            // AttendanceDeviceSeeder::class,
            // CompanyGoalSeeder::class,
            // ConversationSeeder::class,
            // ConversationParticipantSeeder::class,
            // DeductionTypeSeeder::class,
            // DepartmentGoalSeeder::class,
            // EmployeeBankAccountSeeder::class,
            // EmployeeContractSeeder::class,
            // EmployeeDepartmentSeeder::class,
            // EmployeeDocumentSeeder::class,
            // EmployeeProfileSeeder::class,

            // EmployeeSocialAccountSeeder::class,
            // OkrCycleSeeder::class,
            // OkrObjectiveSeeder::class,
            // GoalLinkSeeder::class,
            // JobPostSeeder::class,
            // JobApplicationSeeder::class,
            // InterviewSeeder::class,
            // LeaveTypeSeeder::class,
            // LeaveRequestSeeder::class,
            // MeetingSeeder::class,
            MeetingActionItemSeeder::class,
            MeetingAgendaItemSeeder::class,
            MeetingAttendeeSeeder::class,
            MeetingMinuteSeeder::class,
            MessageSeeder::class,
            OfferLetterSeeder::class,
            OkrKeyResultSeeder::class,
            OkrCheckinSeeder::class,
            OnboardingTaskSeeder::class,
            PayrollCycleSeeder::class,
            PayslipSeeder::class,
            PayslipItemSeeder::class,
            PeerFeedbackSeeder::class,
            PerformanceReviewTemplateSeeder::class,
            PerformanceReviewSeeder::class,
            SurveySeeder::class,
            WorklifePostSeeder::class,
        ]);
    }
}
