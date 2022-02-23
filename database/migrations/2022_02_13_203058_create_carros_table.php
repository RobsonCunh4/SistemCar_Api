<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrosTable extends Migration
{
    /**
     * Método responsável por criar a estrutura da 
     * tabela carros no banco de dados.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->id();            
            $table->string('placa', 10)->unique();
            $table->string('modelo', 100);
            $table->string('marca', 100);
            $table->integer('lugares');
            $table->integer('km');
            $table->timestamps();
        });
    }

    /**
     * Método responsável por reverter o processo de migração
     * deletando a tabela carros.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carros');
    }
}
