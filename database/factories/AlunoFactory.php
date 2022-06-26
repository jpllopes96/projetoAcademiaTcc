<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }
    public function definition()
    {
        return [     
            'cpf' => $this->faker->unique()->cpf(),
            'sexo' => array_rand(array_flip(['m', 'f'])),
            'data_nascimento' => date('Y-m-d', strtotime(date('Y-m-d') . '- ' . rand(13, 70) . ' years')),
        ];
    }
}
