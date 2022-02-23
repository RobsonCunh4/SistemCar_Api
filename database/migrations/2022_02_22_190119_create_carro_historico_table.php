<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarroHistoricoTable extends Migration
{
    /**
     * Método responsável por criar a estrutura da 
     * tabela carro_historicos no banco de dados.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carro_historicos', function (Blueprint $table) {            
            $table->id();   
            $table->unsignedBigInteger('carro_id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('acao', 200);
            $table->timestamps();                       
            
            $table->foreign('carro_id')->references('id')->on('carros')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users');            
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
        Schema::dropIfExists('carro_historicos');
    }
}
