<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Meta;
use App\Models\Tarefa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{

    public function index(){
        $metas = Meta::where('user_id',Auth::user()->id)->get();
        $categoriasId = Meta::where('user_id', Auth::user()->id)->pluck('categoria_id');
        $categorias = Categoria::whereIn('id', $categoriasId)->get();
        
        return view('metas.index')->with(['metas'=> $metas, 'categorias'=> $categorias]);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('metas.new')->with(['categorias'=>$categorias]);
    }

    public function salvar(Request $request)
    {
        $validatedDate = $request->validate([
            'dataMeta' => ['required', 'date', 'after_or_equal:today'],
            'dataFinalMeta' => ['required', 'date', 'after_or_equal:dataMeta'],
            'nomeMeta' => ['required', 'string'],
            'descricao' => ['required'],

        ]);

        $meta = Meta::create(['statusMeta'=> 'indefinido', 'quantidadeTarefa'=>1,
            'dataMeta'=>$request->dataMeta, 'dataFinalMeta'=>$request->dataFinalMeta, 'nomeMeta'=>$request->nomeMeta,
            'descricao'=>$request->descricao, 'categoria_id'=>$request->categoria_id,
            'user_id'=>Auth::user()->id]);
        $meta->save();
        return redirect(route('metas.index'));
    }

    public function edit($id)
    {
        $categorias = Categoria::all();
        $meta = Meta::find($id);
        return view('metas.update')->with(['categorias'=>$categorias, 'meta'=>$meta]);
    }

    public function update(Request $request)
    {
        $validatedDate = $request->validate([
            'dataMeta' => ['required', 'date', 'after_or_equal:today'],
            'dataFinalMeta' => ['required', 'date', 'after_or_equal:dataMeta'],
            'nomeMeta' => ['required', 'string'],
            'descricao' => ['required'],

        ]);

        $meta = Meta::find($request->meta_id);
        $meta->nomeMeta = $request->nomeMeta;
        $meta->categoria_id = $request->categoria_id;
        $meta->descricao = $request->descricao;
        $meta->dataMeta = $request->dataMeta;
        $meta->dataFinalMeta = $request->dataFinalMeta;
        $meta->statusMeta = $request->statusMeta;
        $meta->update();
        return redirect(route('metas.index'));
    }

    public function show($id)
    {
        $meta = Meta::find($id);
        return view('metas.show')->with(['meta'=>$meta]);
    }

    public function destroy($id)
    {
        $meta = Meta::find($id);
        $meta->delete();
        return redirect(route('metas.index'));
    }

    public function registrarTarefa(Request $request){
        $meta = Meta::find($request->id);
        $meta->tarefas()->sync($request->tarefa_id);
        $meta->save();
        return redirect(route('metas.index'));
    }

    public function cadastrar($id){
        $meta = Meta::find($id);
        $tarefas = Tarefa::where('user_id', Auth::user()->id)->get();
        return view('metas.registraTarefa')->with(['tarefas'=>$tarefas, 'meta'=>$meta]);
    }

    public function metasDia($dia){
        $metas = Meta::where('user_id', Auth::user()->id)->whereDay('dataFinalMeta',' =', $dia)->get();
        $categorias = [];
        // Resgate de apenas as categorias existentes nas tarefas do usuário
        foreach ($metas as $meta){
            if(!in_array($meta->categoria->nomeCategoria, $categorias, true)){
                array_push($categorias,$meta->categoria->nomeCategoria);
            }
        }

        return view('metas.metasDia')->with(['categorias'=> $categorias, 'metas'=>$metas]);
    }

}
