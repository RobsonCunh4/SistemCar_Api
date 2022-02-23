<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    //Campos 
    protected $fillable = [        
        'placa',
        'modelo',
        'marca',
        'lugares',
        'km'
    ];

     /**
     * Método rules responsável por definir as regras
     * de validação sobre o cadastro de carro.
     *
     * @return array
     */
    public function rules()
    {
        return [                      
            'placa' => 'required|unique:carros,placa,'.$this->id,            
            'modelo' => 'required',          
            'marca' => 'required',  
            'lugares' => 'required',          
            'km' => 'required'          
        ];
    }

     /**
     * Método feedback responsável por definir as 
     * as mensagens de validação customizadas 
     * sobre o as regras de validação definidas no método rules().
     *
     * @return array
     */
    public function feedback()
    {
        return [
            'require' => 'O campo :attribute é obrigatório',
            'placa.unique' => 'A placa do carro já existe'
        ];
    }

     /**
     * Método carroHistoricos responsável por definir 
     * a cardinalidade do relacionamento de carro com CarroHistorico,
     * sendo que um carro pode ter vários de registros de carroHistorico.
     * 
     * @return array
     */
    public function carroHistoricos(){
        return $this->hasMany('App\Models\CarroHistorico');
    }

     /**
     * Método carroUsuario responsável por definir 
     * a cardinalidade do relacionamento de carro com Usuario,
     * sendo que um carro pode ter apenas um registro de usuário relacionado.
     * 
     * @return array
     */
    public function carroUsuario(){
        return $this->hasOne('App\Models\User');
    }
}
