<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{

     /**
     * Método construtor responsável por inserir as 
     * informações do model ao realizar uma nova instânciar.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Método atributosRelacionados responsável por permitir
     * que seja utilzado filtros sobre atributos relacionados.     
     */
    public function atributosRelacionados($atributos)
    {
        $this->model = $this->model->with($atributos);
    }

     /**
     * Método filtro responsável por executar a filtragem 
     * com base nas informações recebidas.     
     */
    public function filtro($filtros)
    {
        $filtros = explode(';', $filtros);

        foreach ($filtros as $key => $condicao) {

            $c = explode(':', $condicao);
            $this->model = $this->model->where($c[0], $c[1], $c[2]);
        }
    }

     /**
     * Método selectAtributos responsável por 
     * selecionar os filtros 
     */
    public function selectAtributos($atributos)
    {
        $this->model = $this->model->selectRaw($atributos);
    }

    /**
     * Método getResultado responsável por executar
     * a consulta no banco de dados.
     */
    public function getResultado(){
        return $this->model->get();
    }
}
