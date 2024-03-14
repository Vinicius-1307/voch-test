<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UnitsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fantasy_name' => $this->faker->unique()->name(),
            'company_name' => $this->faker->name(),
            'cnpj' => function () {
                return $this->generateCnpj();
            }
        ];
    }

    /**
     * Generate a random CNPJ.
     *
     * @return string
     */
    private function generateCnpj()
    {
        $cnpj = '';
        for ($i = 0; $i < 14; $i++) {
            $cnpj .= mt_rand(0, 9);
        }
        return $cnpj;
    }
}
