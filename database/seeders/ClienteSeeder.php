<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Método responsável por inserir registros 
     * no banco de dados de acordo com a estrutura
     * definida em ClienteFactory
     *
     * @return void
     */
    public function run()
    {
         //Cria 100 registro no banco de dados de clientes fictícios
         Cliente::factory(100)->create(); 
    }
}
