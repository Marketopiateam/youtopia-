<?php

namespace Database\Factories;

use App\Models\EmployeeBankAccount;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeBankAccountFactory extends Factory
{
    protected $model = EmployeeBankAccount::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'bank_name' => $this->faker->company . ' Bank',
            'account_number' => $this->faker->bankAccountNumber,
            'iban' => $this->faker->boolean(60) ? $this->faker->bothify('IBAN##########') : null,
            'swift_code' => $this->faker->boolean(40) ? $this->faker->bothify('SWIFT####') : null,
            'is_primary' => $this->faker->boolean(30),
        ];
    }
}
