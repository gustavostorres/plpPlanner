<x-app-layout>
    <div class="container-fluid" style="margin-top: 25px">
        <header>
            <div class="row justify-content-end">
                <h4 class="display-4 mb-4 text-center">{{$mes}}, {{$ano}}</h4>
                <a type="button"
                   href="{{route('alterarMes', ['mes' => $mes,'ano'=>$ano,'sinal'=>0])}}"><img class="" src="{{asset('img/setaEsquerda.png')}}" style="width:50px" alt=""></a>
                <a type="button"
                   href="{{route('alterarMes', ['mes' => $mes,'ano'=>$ano,'sinal'=>1])}}"><img class="" src="{{asset('img/setaDireita.png')}}" style="width:50px" alt=""></a>
            </div>
            <div class="row d-none d-sm-flex p-1 bg-dark text-white">
                <h5 class="col-sm p-1 text-center">Domingo</h5>
                <h5 class="col-sm p-1 text-center">Segunda</h5>
                <h5 class="col-sm p-1 text-center">Terça</h5>
                <h5 class="col-sm p-1 text-center">Quarta</h5>
                <h5 class="col-sm p-1 text-center">Quinta</h5>
                <h5 class="col-sm p-1 text-center">Sexta</h5>
                <h5 class="col-sm p-1 text-center">Sábado</h5>
            </div>
        </header>

        <div class="row border border-left-0 border-bottom-0">
            @for ($i = 0; $i <$inicioSemana; $i++)
                <div class="day col-sm p-2 text-truncate">
                </div>
            @endfor
            @for ($i = 1; $i <= $dias; $i++)
                @php
                $dia = date("d");
                @endphp
                @if($dia == $i)
                <div class="day col-sm p-2 border text-truncate" style="background-color: #A8A8A8;">
                    <h5 class="row align-items-center">
                        <span class="date col-1">{{$i}}</span>
                        <small class="col d-sm-none text-center text-muted">{{$i}}</small>
                        <span class="col-1"></span>
                    </h5>
                @else
                <div class="day col-sm p-2 border text-truncate">
                    <h5 class="row align-items-center">
                        <span class="date col-1">{{$i}}</span>
                        <small class="col d-sm-none text-center text-muted">{{$i}}</small>
                        <span class="col-1"></span>
                    </h5>
                @endif
                    @php
                    $data = new DateTime($i.'-'.$mes.'-'.$ano);
                    $data = $data->format('Y-m-d');
                    @endphp
                    @if(in_array($data, $tarefasFiltradas->toArray(), true))
                        <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white" title="Tarefas" href="{{route('tarefas.tarefasDia', ['dia' => $i])}}">Tarefas do dia {{$i}}</a>
                    @endif
                    @if(in_array($data, $metaLembrete->toArray(), true))
                        <a style="background-color: coral" class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small text-white" title="Tarefas" href="{{route('metas.metasDia', ['dia' => $i])}}">Metas para o dia {{$i}}</a>
                    @endif
                    @if(in_array($data, $tarefasLembrete->toArray(), true))
                        <a type="button" style="background-color: #fa608b" class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small text-white" title="Lembretes" data-toggle="modal" data-target="#Lembretes{{$i}}">Lembretes</a>
                        <div class="modal fade" id="Lembretes{{$i}}" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalLongoExemplo">Lembretes do dia {{$i}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                        $dataaux = new DateTime($i.'-'.$mes.'-'.$ano);
                                        $tarefas = App\Models\Tarefa::where('user_id', Auth::user()->id)->where('lembrete', true)->whereDay('dataLembrete', $i)
                                        ->whereMonth('dataLembrete', $dataaux->format('m'))->whereYear('dataLembrete', $dataaux->format('Y'))->get();
                                        @endphp
                                        @foreach($tarefas as $tarefa)
                                        <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white" title="Tarefas" href="{{route('tarefas.show', ['id' => $tarefa->id])}}">{{$tarefa->titulo}}</a>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if(($i+$inicioSemana)%7==0)
                    <div class="w-100"></div>
                @endif
            @endfor
            @for ($i = (($dias+$inicioSemana)%7); $i <7; $i++)
                <div class="day col-sm p-2 text-truncate">
                </div>
            @endfor
        </div>
    </div>
</x-app-layout>
<style type="text/css">
    @media (max-width: 575px) {
        .display-4 {
            font-size: 1.5rem;
        }

        .day h5 {
            background-color: #f8f9fa;
            padding: 3px 5px 5px;
            margin: -8px -8px 8px -8px;
        }

        .date {
            padding-left: 4px;
        }
    }

    @media (min-width: 576px) {
        .day {
            height: 11.000vw;
        }
    }
</style>
