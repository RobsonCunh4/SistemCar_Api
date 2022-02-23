<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    //Tabela
    protected $table = 'clientes';

    //Campos
    protected $fillable = [
        'nome',
        'cpf',
        'telefone'
    ];
 
    /**
     * Método rules responsável por definir as regras
     * de validação sobre o cadastro de clientes.
     *
     * @return array
     */
    public function rules(){
        return [
            'nome' => 'required',
            'cpf' => 'required|unique:clientes,cpf,'.$this->id,
            'telefone' => 'required'
        ];
    }

    /**
     * Método feedback responsável por definir as 
     * as mensagens de validação customizadas 
     * sobre o as regras de validação definidas no método rules().
     *
     * @return array
     */
    public function feedback(){
        return [
            'required' => 'campo :attribute obrigatório.'
        ];
    }
}
