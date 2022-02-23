<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Método construtor responsável por
     * inserir o middleware auth:api de autenticação,
     * exceto nos métodos login e registro.
     * Também realiza a inserção do model para utilização 
     * nos demais metodos.
     * 
     * @return void
     */
    public function __construct(User $user) {               
        $this->middleware('auth:api', ['except' => ['login','registro']]);
        $this->user = $user;
    }

     /**
     * Método registro responsável por
     * inserir o um novo cadastro de usuário no 
     * banco de dados.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registro(Request $request)
    {
        $request->validate($this->user->rules(), $this->user->feedback());

        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),            
        ]);
    
        return response()->json($user, 201);
    }

    /**
     * Método login responsável por a autenticação 
     * do usuário com base nas informações enviadas e
     * assim retornar o token do usuário.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $credenciais = $request->all(['email', 'password']);

        $token = auth('api')->attempt($credenciais);

        if($token){
            return response()->json([
                'token_type' => 'Bearer',
                'token' => $token
            ]);
        }else{
            return response()->json(['erro' => 'Usuário ou senha inválido'], 403);
        }                        
    }

     /**
     * Método logout responsável por a encerrar a autenticação 
     * do usuário através da invalidação do seu token de acesso.
     *      
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['msg' => 'Logout realizado com sucesso!']);
    }

     /**
     * Método refresh responsável por atualizar o
     * token de acesso do usuário.
     *      
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {        
        $token = auth()->refresh();        
        return response()->json(['token' => $token]);
    }

     /**
     * Método me responsável retornar informações 
     * do usuário autenticado.
     *      
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

     /**
     * Método me usuarioDashboard retornar por
     * retornar a quantidade de usuários cadastrados
     * no sistema.
     *      
     * @return \Illuminate\Http\Response
     */
    public function usuarioDashboard(){
        $qtdUsuario = $this->user->count();
        if ($qtdUsuario === null) {
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }

        return  response()->json($qtdUsuario, 200);
    }
}
