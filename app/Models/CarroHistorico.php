<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarroHistorico extends Model
{
    use HasFactory;
    //Define o nome da tabela
    protected $table = 'carro_historicos';

    //Campos 
    protected $fillable = [        
        'carro_id',
        'usuario_id',
        'acao'
    ];  

    /**
     * Método carro responsável por definir 
     * a cardinalidade do relacionamento de carro com CarroHistorico,
     * sendo que um carroHistorico pode ter apenas carro.
     * 
     * @return array
     */
    public function carro(){
        return $this->hasOne('App\Models\Carro', 'id', 'carro_id');
    }
    
    /**
     * Método usuario responsável por definir 
     * a cardinalidade do relacionamento de usuario com CarroHistorico,
     * sendo que um carro CarroHistorico ter apenas um registros de usuario.
     * 
     * @return array
     */
    public function usuario(){
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }
}
