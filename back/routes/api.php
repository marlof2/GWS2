<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramationController;
use App\Http\Controllers\CondominiumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\FormaPagamentoController;
use App\Http\Controllers\ProgramationDocumentsController;
use App\Http\Controllers\ProgramationProductController;
use League\CommonMark\Node\Block\Document;

Route::get('withoutAuth', function () {
    return response()->json('Usuário não autenticado.');
})->name('withoutAuth');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/autenticar', [AuthController::class, 'autenticar']);
Route::apiResource('formapagamento', FormaPagamentoController::class);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('produtos', ProductController::class);
    Route::apiResource('cliente', ClientController::class);
    Route::apiResource('condominios', CondominiumController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('documents', DocumentsController::class);
    // programacao
    Route::apiResource('programacao', ProgramationController::class);
    Route::patch('programacao/atender/{id}', [ProgramationController::class, 'atender']);
    Route::patch('programacao/naoAtender/{id}', [ProgramationController::class, 'naoAtender']);
    // programacaodocument
    Route::apiResource('programacaodocument', ProgramationDocumentsController::class);
    // programacaoproduto
    Route::apiResource('programacaoproduto', ProgramationProductController::class);
    Route::post('/programacaoprodutodelete', [ProgramationProductController::class, 'destroy']);
});
