<?php

namespace Database\Factories;

use App\Models\EmployeePosition;
use App\Models\Units;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $unitId = Units::pluck('id')->random();

        return [
            'unit_id' => $unitId,
            'name' => $this->faker->name(),
            'cpf' =>  function () {
                return $this->generateCpf();
            },
            'email' => $this->faker->email()
        ];
    }

    /**
     * Generate a random CPF.
     *
     * @return string
     */
    private function generateCpf()
    {
        $cpf = '';
        for ($i = 0; $i < 11; $i++) {
            $cpf .= mt_rand(0, 9);
        }
        return $cpf;
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function ($employee) {
            EmployeePosition::factory()->create(['employee_id' => $employee->id]);
        });
    }
}
