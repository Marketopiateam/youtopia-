<?php

namespace Database\Seeders;

use App\Models\AllowanceType;
use App\Models\DeductionType;
use App\Models\Payslip;
use App\Models\PayslipItem;
use Illuminate\Database\Seeder;

class PayslipItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payslips = Payslip::all();
        $allowanceTypes = AllowanceType::all();
        $deductionTypes = DeductionType::all();

        if ($payslips->isEmpty() || $allowanceTypes->isEmpty() || $deductionTypes->isEmpty()) {
            $this->command->info('No payslips, allowance types or deduction types found, skipping payslip item seeding.');
            return;
        }

        foreach ($payslips as $payslip) {
            // Add some allowances
            PayslipItem::create([
                'payslip_id' => $payslip->id,
                'item_type' => 'earning',
                'type_id' => $allowanceTypes->random()->id,
                'amount' => rand(100, 1000),
                'description' => 'Random Allowance',
            ]);

            // Add some deductions
            PayslipItem::create([
                'payslip_id' => $payslip->id,
                'item_type' => 'deduction',
                'type_id' => $deductionTypes->random()->id,
                'amount' => rand(50, 500),
                'description' => 'Random Deduction',
            ]);
        }
    }
}
