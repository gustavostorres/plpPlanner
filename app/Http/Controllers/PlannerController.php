<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;
use App\Models\Tarefa;
use Illuminate\Support\Facades\Auth;

use DateTime;

class PlannerController extends Controller
{
    public function alterarMes($mes,$ano,$sinal){
        $data = new DateTime('01-'.$mes.'-'.$ano);
        $dataLembrete = new DateTime();
        $dataFinalMeta = new DateTime();
        $tarefasLembrete = Tarefa::where('user_id', Auth::user()->id)->whereYear('dataLembrete', '=', $dataLembrete->format('Y'))->whereMonth('dataLembrete', '=', $dataLembrete->format('m'))->pluck('dataLembrete');
        $metaLembrete = Meta::where('user_id', Auth::user()->id)->whereYear('dataFinalMeta', '=', $dataLembrete->format('Y'))->whereMonth('dataFinalMeta', '=', $dataLembrete->format('m'))->pluck('dataFinalMeta');
        if($sinal == 1){
            $data->modify('+1 month');
        }else{
            $data->modify('-1 month');
        }
        $data_incio = mktime(0, 0, 0, $data->format('m') , 1 , $data->format('Y'));
        $tarefasFiltradas = Tarefa::where('user_id', Auth::user()->id)->whereYear('data', '=', $data->format('Y'))->whereMonth('data', '=', $data->format('m'))->pluck('data');

        return view('dashboard')->with(["mes"=>$data->format('F'),"ano"=>$data->format('Y'),"dias"=>$data->format('t'),"inicioSemana"=>date('w',$data_incio),"tarefasFiltradas"=>$tarefasFiltradas, "tarefasLembrete"=>$tarefasLembrete, "metaLembrete"=>$metaLembrete]);
    }

    public function gerarPlanner(){
        $data = new DateTime();
        $dataLembrete = new DateTime();
        $dataFinalMeta = new DateTime();
        $data_incio = mktime(0, 0, 0, $data->format('m') , 1 , $data->format('Y'));
        $tarefasFiltradas = Tarefa::where('user_id', Auth::user()->id)->whereYear('data', '=', $data->format('Y'))->whereMonth('data', '=', $data->format('m'))->pluck('data');
        $tarefasLembrete = Tarefa::where('user_id', Auth::user()->id)->whereYear('dataLembrete', '=', $dataLembrete->format('Y'))->whereMonth('dataLembrete', '=', $dataLembrete->format('m'))->pluck('dataLembrete');
        $metaLembrete = Meta::where('user_id', Auth::user()->id)->whereYear('dataFinalMeta', '=', $dataLembrete->format('Y'))->whereMonth('dataFinalMeta', '=', $dataLembrete->format('m'))->pluck('dataFinalMeta');

        return view('dashboard')->with(["mes"=>$data->format('F'),"ano"=>$data->format('Y'),"dias"=>$data->format('t'),"inicioSemana"=>date('w',$data_incio),
            "tarefasFiltradas"=>$tarefasFiltradas, "tarefasLembrete"=>$tarefasLembrete, "metaLembrete"=>$metaLembrete]);
    }

}
