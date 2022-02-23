<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
     /**
     * Método construtor responsável por
     * inserir o middleware auth:api de autenticação,     
     * Também realiza a inserção do model para utilização 
     * nos demais metodos.
     * 
     * @return void
     */
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
        $this->middleware('auth:api');
    }    

    /**
     * Método index responsável por
     * retornar a listagem dos clientes 
     * cadastrados no sistema.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clienteRepository = new ClienteRepository($this->cliente);

        if ($request->has('filtro')) {
            $clienteRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $clienteRepository->selectAtributos($request->atributos);
        }        
     
        return  response()->json($clienteRepository->getResultado(), 200);
    }
    

     /**
     * Método store responsável por inserir
     * um novo registro de cliente no sistema.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->cliente->rules(), $this->cliente->feedback());

        $cliente = $this->cliente->create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone            
        ]);        

        return response()->json($cliente, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->cliente->find($id);
        if ($cliente === null) {
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }

        return  response()->json($cliente, 200);
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
        $cliente = $this->cliente->find($id);
        if ($cliente === null) {
            return response()->json(['erro' => 'Recurso não encontrado!'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            foreach ($cliente->rules() as $input => $regra) {

                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $cliente->feedback());
        } else {
            $request->validate($cliente->rules(), $cliente->feedback());
        }
               
        $cliente->fill($request->all());        
        $cliente->save();

        return response()->json($cliente, 200);
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
        $cliente = $this->cliente->find($id);
        if ($cliente === null) {
            return response()->json(['erro' => 'Recurso não encontrado!'], 404);
        }        

        $cliente->delete();
        return  response()->json(['msg' => 'Cliente removido!'], 200);
    }

     /**
     * Método carroDashboard responsável por listar 
     * a quantidade de registros de clientes
     * cadastrados no sistema.
     *
     * @return \Illuminate\Http\Response
     */
    public function clienteDashboard(){
        $qtdCliente = $this->cliente->count();
        if ($qtdCliente === null) {
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }

        return  response()->json($qtdCliente, 200);
    }
}
