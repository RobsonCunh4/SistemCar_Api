<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Método responsável por inserir registros 
     * no banco de dados de acordo com a estrutura
     * definida em UserFactory
     *
     * @return void
     */
    public function run()
    {
        //Cria usuário admin
        User::factory()->create([
            'name' => 'Admin',        
            'email' => 'admin@admin.com',
            'password' => bcrypt('HaduuukeN2022')
        ]); 
    }
}
