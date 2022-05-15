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
        $validatedTime = $request->validate([
            'dataInicial' => ['required', 'date'],
            'dataFinal' => ['required', 'date', 'after_or_equal:dataInicial'],
            'tipo' => ['required'],
        ]);
        if ($request->tipo == 1 || $request->tipo == 4) {
            return $this->categoriaMetasRealizadas($request);
        } elseif ($request->tipo == 2 || $request->tipo == 5) {
            return $this->categoriaTarefasRealizadas($request);
        } else if ($request->tipo == 3) {
            return $this->turnoProdutivo($request);
        } elseif ($request->tipo == 6) {
            return $this->periodoMaisProdutivo($request);
        }

    }

    function aksort(&$array, $valrev = false, $keyrev = false)
    {
        if ($valrev) {
            arsort($array);
        } else {
            asort($array);
        }
        $vals = array_count_values($array);
        $i = 0;
        foreach ($vals as $val => $num) {
            $first = array_splice($array, 0, $i);
            $tmp = array_splice($array, 0, $num);
            if ($keyrev) {
                krsort($tmp);
            } else {
                ksort($tmp);
            }
            $array = array_merge($first, $tmp, $array);
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

        $categorias = Arr::sort($categorias, function ($categoria) {
            return $categoria->quantidade;
        });

        if ($request->tipo == 1) {
            return view('relatorio.categoriaMetaRealizada')->with(['categorias' => $categorias, 'metas' => $metas->get(), 'dataInicial' => $request->dataInicial, 'dataFinal' => $request->dataFinal, 'tipo' => $request->tipo]);
        }
        return view('relatorio.quantMetaCumprida')->with(['categorias' => $categorias, 'metas' => $metas->get(), 'dataInicial' => $request->dataInicial, 'dataFinal' => $request->dataFinal, 'tipo' => $request->tipo]);
    }

    public function categoriaTarefasRealizadas(Request $request)
    {
        $tarefas = Tarefa::where("user_id", Auth::user()->id)->where("statusTarefa", "executada")->whereDate('data', '>=', $request->dataInicial)->whereDate('data', '<=', $request->dataFinal);
        $categorias = Categoria::wherein("id", $tarefas->pluck("categoria_id"))->get();
        $quantGeral = Tarefa::all()->count();
        foreach ($categorias as $categoria) {
            $categoria->quantidade = Tarefa::where("user_id", Auth::user()->id)->where("statusTarefa", "executada")->whereDate('data', '>=', $request->dataInicial)->whereDate('data', '<=', $request->dataFinal)->where("categoria_id", $categoria->id)->get()->count();
            $categoria->porcentagem = round((($categoria->quantidade / $quantGeral) * 100), 2);
        }
        $categorias = Arr::sort($categorias, function ($categoria) {
            return $categoria->quantidade;
        });
        if ($request->tipo == 2) {
            return view('relatorio.categoriaTarefaRealizada')->with(['categorias' => $categorias, 'tarefas' => $tarefas->get(), 'dataInicial' => $request->dataInicial, 'dataFinal' => $request->dataFinal, 'tipo' => $request->tipo]);
        }
        return view('relatorio.quantTarefaCumprida')->with(['categorias' => $categorias, 'tarefas' => $tarefas->get(), 'dataInicial' => $request->dataInicial, 'dataFinal' => $request->dataFinal, 'tipo' => $request->tipo]);
    }

    public function turnoProdutivo(Request $request)
    {
        $tarefas = Tarefa::where("user_id", Auth::user()->id)->where("statusTarefa", "executada")->whereDate('data', '>=', $request->dataInicial)->whereDate('data', '<=', $request->dataFinal);
        $turnos = $tarefas->select('turno')->distinct()->get();

        foreach ($turnos as $turno) {
            $turno->quantidade = Tarefa::where("user_id", Auth::user()->id)->where("statusTarefa", "executada")->whereDate('data', '>=', $request->dataInicial)->whereDate('data', '<=', $request->dataFinal)->where('turno', $turno->turno)->get()->count();
        }

        $turnos = Arr::sort($turnos, function ($turno) {
            return $turno->quantidade;
        });
        return view('relatorio.turnoProdutivo')->with(['turnos' => $turnos, 'tarefas' => $tarefas->get(), 'dataInicial' => $request->dataInicial, 'dataFinal' => $request->dataFinal, 'tipo' => $request->tipo]);
    }

    public function gerarAnos(Request $request)
    {
        $inicio = new \DateTime($request->dataInicial);
        $fim = new \DateTime($request->dataFinal);
        $anos = [];
        while ($inicio->format('Y') <= $fim->format('Y')) {
            $aux = new \stdClass();
            $aux->ano = $inicio->format('Y');
            array_push($anos, $aux);
            $inicio->modify('+1 year');
        }
        return $anos;
    }

    public function gerarMeses(Request $request, $anosTemp)
    {
        $inicio = new \DateTime($request->dataInicial);
        $fim = new \DateTime($request->dataFinal);
        $hoje = new \DateTime();

        foreach ($anosTemp as $anoTemp) {
            $meses = [];
            while (($inicio->format('m') <= 12 && $anoTemp->ano == $inicio->format('Y')) &&
                ($inicio->format('Y-m') <= $fim->format('Y-m'))) {
                $aux = new \stdClass();
                $aux->mes = $inicio->format('m');
                $aux->semanas = [];
                array_push($meses, $aux);
                $inicio->modify('+1 month');
            }
            $anoTemp->meses = $meses;
        }
    }

    public function gerarSemanas(Request $request,$data)
    {
        foreach ($data->meses as $mes) {
            $dataInicio = new DateTime('01-' . $mes->mes . '-' . $data->ano);
            $mesAux = $dataInicio->format('m');
            $contSemana = 1;

            while ($mesAux == $dataInicio->format('m')) {
                $cont = 0;
                for ($i = $dataInicio->format('w'); $i <= 6 && $mesAux == $dataInicio->format('m'); $i++) {
                    $cont+=Tarefa::where("user_id", Auth::user()->id)->where("statusTarefa", "executada")->where('data', $dataInicio)->get()->count();
                    $dataInicio->modify('+1 day');
                }
                $aux = new \stdClass();
                $aux->semana = $contSemana;
                $aux->quantidade = $cont;
                if($cont>0){
                    array_push($mes->semanas,$aux);
                }
                $contSemana++;
            }
        }
    }

    public function periodoMaisProdutivo(Request $request)
    {
        $tarefas = Tarefa::where("user_id", Auth::user()->id)->where("statusTarefa", "executada")->whereDate('data', '>=', $request->dataInicial)->whereDate('data', '<=', $request->dataFinal);
        $anos = $this->gerarAnos($request);
        $this->gerarMeses($request, $anos);
        foreach ($anos as $ano) {
            $this->gerarSemanas($request,$ano);
        }
    }

}
