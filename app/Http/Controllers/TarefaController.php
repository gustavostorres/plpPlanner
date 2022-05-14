<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tarefa;
use Illuminate\Support\Facades\Auth;


class TarefaController extends Controller
{
	public function index()
    {
        $tarefas = Tarefa::where('user_id', Auth::user()->id)->get();
        $categoriasId = Tarefa::where('user_id', Auth::user()->id)->pluck('categoria_id');
        $categorias = Categoria::whereIn('id', $categoriasId)->get();

        return view('tarefas.index')->with(['categorias'=> $categorias, 'tarefas'=>$tarefas]);
    }

    public function create()
    {
    	$categorias = Categoria::all();
    	return view('tarefas.new')->with(['categorias'=>$categorias]);
    }

    public function salvar(Request $request)
    {
        $inicio = date_create_from_format('H:i', $request->horarioInicio);
        $fim = date_create_from_format('H:i', $request->horarioFim);
        $validatedTime = $request->validate([
            'nomeTarefa' => ['required'],
            'titulo' => ['required','string'],
            'data' => ['required','date','after_or_equal:today'],
            'horarioInicio' => ['required'],
            'horarioFim' => ['required','after:horarioInicio'],

        ]);
        if (date_diff($inicio, $fim)->i < 30 && date_diff($inicio, $fim)->h == 0) {
            return redirect()->back()->with([
                "horario" => "A diferença entre os horários tem que ser de pelo menos 30 minutos"
            ])->withInput();
        }

    	$tarefa = Tarefa::create(['nomeTarefa'=>$request->nomeTarefa, 'horarioInicio'=>$request->horarioInicio,
            'horarioFim'=>$request->horarioFim, 'data' =>$request->data, 'statusTarefa'=>'naoIniciado', 'categoria_id'=>$request->categoria_id,
            'titulo'=>$request->titulo, 'user_id'=>$request->user_id, 'lembrete'=>$request->lembrete]);

        if($request->lembrete == true){
            $aux = new \DateTime($request->data);
            $tarefa->dataLembrete = $aux->modify('-7 days');
        }

        $manha = new \DateTime('06:00:00');
        $tarde = new \DateTime('13:00:00');
        $noite = new \DateTime('19:00:00');

        if($request->horarioInicio >= $manha && $request->horarioFim < $tarde){
            $auxTurno = 'Manha';
            $tarefa->turno = $auxTurno;
        }else if($request->horarioInicio >= $tarde && $request->horarioFim < $noite){
            $auxTurno = 'Tarde';
            $tarefa->turno = $auxTurno;
        }else{
            $auxTurno = 'Noite';
            $tarefa->turno = $auxTurno;
        }

    	$tarefas = Tarefa::where('user_id', $tarefa->user_id)->get();
        $tarefa->save();
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
        $inicio = date_create_from_format('H:i:s', $request->horarioInicio);
        $fim = date_create_from_format('H:i:s', $request->horarioFim);

        $validatedTime = $request->validate([
            'nomeTarefa' => ['required'],
            'titulo' => ['required','string'],
            'data' => ['required','date','after_or_equal:today'],
            'horarioInicio' => ['required'],
            'horarioFim' => ['required','after:horarioInicio'],

        ]);
        if ((date_diff($inicio, $fim)->i < 30) && (date_diff($inicio, $fim)->h == 0)) {
            return redirect()->back()->with([
                "horario" => "A diferença entre os horários tem que ser de pelo menos 30 minutos"
            ])->withInput();
        }

    	$tarefa = Tarefa::find($request->tarefa_id);
    	$tarefa->nomeTarefa = $request->nomeTarefa;
        $tarefa->data = $request->data;
    	$tarefa->horarioInicio = $request->horarioInicio;
        $tarefa->horarioFim = $request->horarioFim;
    	$tarefa->titulo = $request->titulo;
    	$tarefa->statusTarefa = $request->statusTarefa;
    	$tarefa->categoria_id = $request->categoria_id;
        $tarefa->lembrete = $request->lembrete;

        if($request->lembrete == true){
            $aux = new \DateTime($request->data);
            $tarefa->dataLembrete = $aux->modify('+7 days');
        }else{
            $tarefa->dataLembrete = null;
        }

        if($request->horarioInicio >= '08:00' && $request->horarioFim <= '12:59'){
            $auxTurno = 'Manha';
            $tarefa->turno = $auxTurno;
        }else if($request->horarioInicio >= '13:00' && $request->horarioFim <= '18:59'){
            $auxTurno = 'Tarde';
            $tarefa->turno = $auxTurno;
        }else if($request->horarioInicio >= '19:00' && $request->horarioFim <= '07:59'){
            $auxTurno = 'Noite';
            $tarefa->turno = $auxTurno;
        }

        $tarefa->update();
        return redirect(route('tarefas.index'));
    }

    public function tarefasDia($dia){
        $tarefas = Tarefa::where('user_id', Auth::user()->id)->whereDay('data',' =', $dia)->get();
        $categorias = [];
        // Resgate de apenas as categorias existentes nas tarefas do usuário
        foreach ($tarefas as $tarefa){
            if(!in_array($tarefa->categoria, $categorias, true)){
                array_push($categorias,$tarefa->categoria);
            }
        }

        return view('tarefas.tarefasDia')->with(['categorias'=> $categorias, 'tarefas'=>$tarefas]);
    }

}
