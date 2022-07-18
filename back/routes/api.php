<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramationController;
use App\Http\Controllers\CondominiumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FormaPagamentoController;
use App\Http\Controllers\ProgramationProductController;


Route::get('withoutAuth', function () {
    return response()->json('Usuário não autenticado.');
})->name('withoutAuth');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/autenticar', [AuthController::class, 'autenticar']);
Route::apiResource('formapagamento', FormaPagamentoController::class);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('produtos', ProductController::class);
    Route::apiResource('cliente', ClientController::class);
    Route::apiResource('programacao', ProgramationController::class);
    Route::patch('programacao/atender/{id}', [ProgramationController::class, 'atender']);
    Route::patch('programacao/naoAtender/{id}', [ProgramationController::class, 'naoAtender']);

    Route::apiResource('condominios', CondominiumController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('programacaoproduto', ProgramationProductController::class);
    Route::post('/programacaoprodutodelete', [ProgramationProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
