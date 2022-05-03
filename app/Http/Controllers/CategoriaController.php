<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tarefa;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index($id)
    {
        $categorias = Categoria::where('user_id', $id)->get();
        return view('categorias.index')->with(['categorias'=>$categorias]);

    }

    public function show($id, $user_id)
    {
        $categoria = Categoria::find($id);
        $tarefas = Tarefa::where('user_id', $user_id)->where('categoria_id', $id)->get();
        return view ('view_categorias_tarefas.index')->with(['categoria'=>$categoria, 'tarefas'=>$tarefas]);
    }

}
