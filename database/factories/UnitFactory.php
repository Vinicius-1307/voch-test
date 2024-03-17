<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
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
        for ($i = 0; $i < 12; $i++) {
            $cnpj .= mt_rand(0, 9);
        }
        $cnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . mt_rand(0, 9) . mt_rand(0, 9);
        return $cnpj;
    }
}
