<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Método responsável por criar a estrutura da 
     * tabela clientes no banco de dados.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 15)->unique();
            $table->string('nome', 30);
            $table->string('telefone', 30);
            $table->timestamps();
        });
    }

    /**
     * Método responsável por reverter o processo de migração
     * deletando a tabela clientes.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
