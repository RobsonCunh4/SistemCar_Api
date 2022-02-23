<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\CarroHistorico;
use App\Repositories\CarroRepository;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    /**
     * Método construtor responsável por
     * inserir o middleware auth:api de autenticação,
     * Também realiza a inserção dos models para utilização 
     * nos demais metodos.
     * 
     * @return void
     */
    public function __construct(Carro $carro, CarroHistorico $carroHistorico)
    {
        $this->middleware('auth:api');        
        $this->carro = $carro;
        $this->carroHistorico = $carroHistorico;
    }    

    /**
     * Método index responsável por
     * retornar a listagem dos carros 
     * cadastrados no sistema.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carroRepository = new CarroRepository($this->carro);

        if ($request->has('filtro')) {
            $carroRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $carroRepository->selectAtributos($request->atributos);
        }    

        return  response()->json($carroRepository->getResultado(), 200);
    }  

     /**
     * Método store responsável por inserir
     * um novo registro de carro no sistema.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->carro->rules(), $this->carro->feedback());

        $carro = $this->carro->create([        
            'placa' => $request->placa,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'lugares' => $request->lugares,
            'km' => $request->km
        ]);

        $this->carroHistorico->create([                    
            'carro_id' => $carro->id,
            'usuario_id' => auth()->user()->id, 
            'acao' => 'Realizado o cadastro no sistema!'
        ]);

        return response()->json($carro, 201);
    }

     /**
     * Método show responsável por retornar
     * informações de um registro específico 
     * através do seu (id - identificador).
     * 
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carro = $this->carro->find($id);

        if ($carro === null) {
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }

        $this->carroHistorico->create([                    
            'carro_id' => $id,
            'usuario_id' => auth()->user()->id, 
            'acao' => 'Realizado visualização do cadastro no sistema!'
        ]);

        return  response()->json($carro, 200);
    }
   
    /**
     * Método update responsável por atualizar 
     * as informações de um registro específico 
     * através do seu (id - identificador) e
     * informações enviadas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carro = $this->carro->find($id);
        if ($carro === null) {
            return response()->json(['erro' => 'Recurso não encontrado!'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            foreach ($carro->rules() as $input => $regra) {

                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $carro->feedback());
        } else {
            $request->validate($carro->rules(), $carro->feedback());
        }

    
        $carro->fill($request->all());
        $carro->save();

        $this->carroHistorico->create([                    
            'carro_id' => $id,
            'usuario_id' => auth()->user()->id, 
            'acao' => 'Realizado a atualização do cadastro no sistema!'
        ]);

        return response()->json($carro, 200);
    }  

    /**
     * Método destroy responsável por remover 
     * um registro específico 
     * através do seu (id - identificador) 
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carro = $this->carro->find($id);
        if ($carro === null) {
            return response()->json(['erro' => 'Recurso não encontrado!'], 404);
        }

        $carro->delete();
        return  response()->json(['msg' => 'Carro removido!'], 200);
    }

    /**
     * Método carro_historico responsável por listar 
     * os registros relacionados a um carro. 
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function carro_historico($id){  
        $historico = $this->carroHistorico
                        ->with(['carro','usuario'])
                        ->where('carro_id', $id)
                        ->get();       
    
        return response()->json($historico, 200);
    }

     /**
     * Método carroDashboard responsável por listar 
     * a quantidade de registros de carros
     * cadastrados no sistema.
     *
     * @return \Illuminate\Http\Response
     */
    public function carroDashboard(){
        $qtdCarro = $this->carro->count();
        if ($qtdCarro === null) {
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }

        return  response()->json($qtdCarro, 200);
    }
}
