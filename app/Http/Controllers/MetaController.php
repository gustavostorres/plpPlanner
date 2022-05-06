<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{

    public function index(){
        $metas = Meta::where('user_id',Auth::user()->id)->get();

        return view('metas.index')->with(['metas'=> $metas]);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('metas.new')->with(['categorias'=>$categorias]);
    }

    public function salvar(Request $request)
    {
        $meta = Meta::create(['statusMeta'=> 'indefinido', 'quantidadeTarefa'=>1,
            'dataMeta'=>$request->dataMeta, 'nomeMeta'=>$request->nomeMeta,
            'descricao'=>$request->descricao, 'categoria_id'=>$request->categoria_id,
            'user_id'=>Auth::user()->id]);
        $meta->save();
        //$tarefas->metas()->sync([]);
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
        $meta = Meta::find($request->meta_id);
        $meta->nomeMeta = $request->nomeMeta;
        $meta->categoria_id = $request->categoria_id;
        $meta->descricao = $request->descricao;
        $meta->dataMeta = $request->dataMeta;
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

}
