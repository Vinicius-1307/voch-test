<?php

namespace Database\Factories;

use App\Models\Employees;
use App\Models\Positions;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeePositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position_id' => Positions::pluck('id')->random(),
            'performance_note' => $this->faker->numberBetween(0, 10),
        ];
    }
}
