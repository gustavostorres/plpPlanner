<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Tarefa;
use Illuminate\Support\Facades\Auth;


class TarefaController extends Controller
{
	public function index()
    {
        $tarefas = Tarefa::where('user_id', Auth::user()->id)->get();
        $categorias = [];
        // Resgate de apenas as categorias existentes nas tarefas do usuário
        foreach ($tarefas as $tarefa){
            if(!in_array($tarefa->categoria->nomeCategoria, $categorias, true)){
                array_push($categorias,$tarefa->categoria->nomeCategoria);
            }
        }

        return view('tarefas.index')->with(['categorias'=> $categorias, 'tarefas'=>$tarefas]);
    }

    public function create()
    {
    	$categorias = Categoria::all();
    	return view('tarefas.new')->with(['categorias'=>$categorias]);
    }

    public function salvar(Request $request)
    {
        /*$validatedTime = $request->validate([
            'horarioFim' => ['required', 'time', 'after:horarioInicio']
        ]);*/


    	$tarefa = Tarefa::create(['nomeTarefa'=>$request->nomeTarefa, 'horarioInicio'=>$request->horarioInicio,
            'horarioFim'=>$request->horarioFim, 'data' =>$request->data, 'statusTarefa'=>'naoIniciado', 'categoria_id'=>$request->categoria_id,
            'titulo'=>$request->titulo, 'user_id'=>$request->user_id]);
    	$tarefas = Tarefa::where('user_id', $tarefa->user_id)->get();
        $tarefa->save();
    	//$tarefas->metas()->sync([]);
    	return redirect(route('tarefas.index'));
    }

    public function show($id)
    {
    	$tarefa = Tarefa::find($id);
    	return view('tarefas.show')->with(['tarefa'=>$tarefa]);
    }

    public function destroy($id)
    {
    	$tarefa = Tarefa::find($id);
    	$tarefa->delete();
    	return redirect(route('tarefas.index'));
    }

    public function edit($id)
    {
        $categorias = Categoria::all();
    	$tarefa = Tarefa::find($id);
    	return view('tarefas.update')->with(['categorias'=>$categorias, 'tarefa'=>$tarefa]);
    }

    public function update(Request $request)
    {
        /*$validatedTime = $request->validate([
            'horarioFim' => ['required', 'time', 'after:horarioInicio']
        ]);*/

    	$tarefa = Tarefa::find($request->tarefa_id);
    	$tarefa->nomeTarefa = $request->nomeTarefa;
        $tarefa->data = $request->data;
    	$tarefa->horarioInicio = $request->horarioInicio;
        $tarefa->horarioFim = $request->horarioFim;
    	$tarefa->titulo = $request->titulo;
    	$tarefa->statusTarefa = $request->statusTarefa;
    	$tarefa->categoria_id = $request->categoria_id;
    	$tarefa->update();
        return redirect(route('tarefas.index'));
    }

}
