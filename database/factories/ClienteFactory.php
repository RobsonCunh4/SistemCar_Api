<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Método responsável por definir a estrutura
     * de inserção de clientes fictícios no sistema.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => ($this->faker->unique()->numberBetween(10000, 99999) . '0' . $this->faker->unique()->numberBetween(10000, 99999)),
            'telefone' => $this->faker->unique()->phoneNumber()   
        ];
    }
}
