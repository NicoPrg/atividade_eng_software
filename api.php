<?php

use App\Models\Funcionario;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//criar funcionário
Route::post('/funcionario', function (Request $request) {
    $funcionario = new Funcionario();
    $funcionario->nome = $request->input('nome');
    $funcionario->departamento_id = $request->input('departamento_id');
    $funcionario->save();

    return response()->json($funcionario);
});

//lista de funcionários
Route::get('/funcionariosrec' , function () {
    $funcionario = Funcionario::all();
    return response()->json($funcionario);
});

//busca por id de funcionário
Route::get('/funcionariosrec/{id}' , function ($id) {
    $funcionario = Funcionario::find($id);
    return response()->json($funcionario);
});

//alterar funcionário
Route::patch('/funcionario/{id}', function (Request $request, $id) {
    $funcionario = Funcionario::find($id);
    if($request->input('nome') !== null){
        $funcionario->nome = $request->input('nome');
    }
    if($request->input('departamento_id') !== null){
        $funcionario->departamento_id = $request->input('departamento_id');
    }
    $funcionario->save();
});

//deletar funcionário
Route::delete('/funcionario/{id}' , function ($id) {
    $funcionario = Funcionario::find($id);
    $funcionario->delete();
    return response()->json($funcionario);
});

//=========================================================================================

//criar departamento
Route::post('/departamento/{nome}', function ($nome) {
    $departamento = new Departamento();
    $departamento->nome = $nome;
    $departamento->save();
    return response()->json($departamento);
});


//lista de departamentos
Route::get('/departamentosrec' , function () {
    $departamento = Departamento::all();
    return response()->json($departamento);
});

//busca por id de departamento
Route::get('/departamentosrec/{id}' , function ($id) {
    $departamento = Departamento::find($id);
    return response()->json($departamento);
});

//alterar departamento
Route::patch('/departamento/{id}', function (Request $request, $id) {
    $departamento = Departamento::find($id);
    if($request->input('nome') !== null){
    $departamento->nome = $request->input('nome');
    $departamento->save();
}});


//deletar departamento
Route::delete('/departamento/{id}' , function ($id) {
    $departamento = Departamento::find($id);
    $departamento->delete();
    return response()->json($departamento);
});

//=========================================================================================


//listar funcionarios com seus departamentos
Route::get('/lista_funcionarios/departamentos' , function () {
    $funcionario = Funcionario::with('departamento')->get();
    return response()->json($funcionario);
   });

//listar departamentos com seus funfionários
Route::get('/lista_departamentos/funcionarios' , function () {
    $departamento = Departamento::with('funcionario')->get();
    return response()->json($departamento);
   });

//departamento de um funcionário
Route::get('/departamento/funcionario/{id}', function ($id) {
    $funcionario = Funcionario::find($id);
    $departamento = $funcionario->departamento;
    return response()->json($departamento);
   });

//funcionários de um departamento
Route::get('/funcionario/departamento/{id}', function ($id) {
    $funcionarios = Funcionario::with('departamento')->where('departamento_id', $id)->get();
    return response()->json($funcionarios);
});