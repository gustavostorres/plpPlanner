<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Meta;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Arr;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorio.index');
    }

    public function gerar(Request $request)
    {
        //$dataInicial = new DateTime($request->dataInicial);
        //$dataFinal = new DateTime($request->dataFinal);
        //Categorias de metas mais realizadas
        $validatedTime = $request->validate([
            'dataInicial' => ['required','date'],
            'dataFinal' => ['required','date','after_or_equal:dataInicial'],
            'tipo' => ['required'],
        ]);
        if ($request->tipo == 1 || $request->tipo == 4) {
            return $this->categoriaMetasRealizadas($request);
        } elseif ($request->tipo == 2 || $request->tipo == 5) {
            return $this->categoriaTarefasRealizadas($request);
        }

    }

    function aksort(&$array,$valrev=false,$keyrev=false) {
        if ($valrev) { arsort($array); } else { asort($array); }
        $vals = array_count_values($array);
        $i = 0;
        foreach ($vals AS $val=>$num) {
            $first = array_splice($array,0,$i);
            $tmp = array_splice($array,0,$num);
            if ($keyrev) { krsort($tmp); } else { ksort($tmp); }
            $array = array_merge($first,$tmp,$array);
            unset($tmp);
            $i = $num;
        }
    }

    public function categoriaMetasRealizadas(Request $request)
    {
        $metas = Meta::where("user_id", Auth::user()->id)->where("statusMeta", "comSucesso")->whereDate('dataMeta', '>=', $request->dataInicial)->whereDate('dataMeta', '<=', $request->dataFinal);
        $categorias = Categoria::wherein("id", $metas->pluck("categoria_id"))->get();
        $quantGeral = Meta::all()->count();
        foreach ($categorias as $categoria) {
            $categoria->quantidade = Meta::where("user_id", Auth::user()->id)->where("statusMeta", "comSucesso")->whereDate('dataMeta', '>=', $request->dataInicial)->whereDate('dataMeta', '<=', $request->dataFinal)->where("categoria_id", $categoria->id)->get()->count();
            $categoria->porcentagem = ($categoria->quantidade / $quantGeral) * 100;
        }

        $categorias = Arr::sort($categorias, function($categoria)
        {
            return $categoria->quantidade;
        });

        if ($request->tipo == 1) {
            return view('relatorio.categoriaMetaRealizada')->with(['categorias' => $categorias, 'metas' => $metas->get(),'dataInicial'=>$request->dataInicial,'dataFinal'=>$request->dataFinal]);
        }
        return view('relatorio.quantMetaCumprida')->with(['categorias' => $categorias, 'metas' => $metas->get(),'dataInicial'=>$request->dataInicial,'dataFinal'=>$request->dataFinal]);
    }

    public function categoriaTarefasRealizadas(Request $request)
    {
        $tarefas = Tarefa::where("user_id", Auth::user()->id)->where("statusTarefa", "executada")->whereDate('data', '>=', $request->dataInicial)->whereDate('data', '<=', $request->dataFinal);
        $categorias = Categoria::wherein("id", $tarefas->pluck("categoria_id"))->get();
        $quantGeral = Tarefa::all()->count();
        foreach ($categorias as $categoria) {
            $categoria->quantidade = Tarefa::where("user_id", Auth::user()->id)->where("statusTarefa", "executada")->whereDate('data', '>=', $request->dataInicial)->whereDate('data', '<=', $request->dataFinal)->where("categoria_id", $categoria->id)->get()->count();
            $categoria->porcentagem = round((($categoria->quantidade / $quantGeral) * 100),2);
        }
        $categorias = Arr::sort($categorias, function($categoria)
        {
            return $categoria->quantidade;
        });
        if ($request->tipo == 2) {
            return view('relatorio.categoriaTarefaRealizada')->with(['categorias' => $categorias, 'tarefas' => $tarefas->get(),'dataInicial'=>$request->dataInicial,'dataFinal'=>$request->dataFinal]);
        }
        return view('relatorio.quantTarefaCumprida')->with(['categorias' => $categorias, 'tarefas' => $tarefas->get(),'dataInicial'=>$request->dataInicial,'dataFinal'=>$request->dataFinal]);
    }
}
