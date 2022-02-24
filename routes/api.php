<?php

/*
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header('Access-Control-Allow-Origin:  *');
    header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//grupo de  rotas relacionadas ao usuario
//Definindo prefixo (prefix('auth'))
Route::prefix('auth')->group(function(){
    Route::post('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);    
    Route::post('login', [AuthController::class, 'login']);
    Route::post('registro', [AuthController::class, 'registro']);
    Route::get('usuario_dashboard', [AuthController::class, 'usuarioDashboard']);
});

//Rotas relacionadas ao cliente
Route::apiResource('cliente', ClienteController::class);
Route::get('cliente_dashboard', [ClienteController::class, 'clienteDashboard']);

//Rotas relacionadas ao carro
Route::apiResource('carro', CarroController::class); 
Route::get('carro_dashboard', [CarroController::class, 'carroDashboard']);
Route::get('carro_historico/{carro}', [CarroController::class, 'carro_historico']);




