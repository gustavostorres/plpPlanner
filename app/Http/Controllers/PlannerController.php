<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class PlannerController extends Controller
{
    public function alterarMes($mes,$ano,$sinal){
        $data = new DateTime('01-'.$mes.'-'.$ano);
        if($sinal == 1){
            $data->modify('+1 month');
        }else{
            $data->modify('-1 month');
        }
        $data_incio = mktime(0, 0, 0, $data->format('m') , 1 , $data->format('Y'));

        return view('dashboard')->with(["mes"=>$data->format('F'),"ano"=>$data->format('Y'),"dias"=>$data->format('t'),"inicioSemana"=>date('w',$data_incio)]);
    }

    public function gerarPlanner(){

        $data = new DateTime();
        $data_incio = mktime(0, 0, 0, $data->format('m') , 1 , $data->format('Y'));

        return view('dashboard')->with(["mes"=>$data->format('F'),"ano"=>$data->format('Y'),"dias"=>$data->format('t'),"inicioSemana"=>date('w',$data_incio)]);
    }
}
