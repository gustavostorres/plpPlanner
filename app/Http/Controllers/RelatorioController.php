<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Meta;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

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
        if ($request->tipo == 1) {
            return $this->categoriaMetasRealizadas($request);
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
        return view('relatorio.categoriaMetaRealizada')->with(['categorias' => $categorias, 'metas' => $metas->get()]);
    }


}
