<x-app-layout>
    <div class="container-fluid" style="margin-top: 25px">
        <header>
            <div class="row justify-content-center">
                <a type="button" style="margin-top: 10px;margin-right: 25px"
                   href="{{route('alterarMes', ['mes' => $mes,'ano'=>$ano,'sinal'=>0])}}"><img class="" src="{{asset('img/setaEsquerda.png')}}" style="width:50px" alt=""></a>
                <h4 class="display-4 mb-4 text-center">{{$mes}} de {{$ano}}</h4>
                <a type="button" style="margin-top: 10px;margin-left: 25px"
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

        <div class="row border border-right-0 border-bottom-0">
            @for ($i = 0; $i <$inicioSemana; $i++)
                <div class="day col-sm p-2 text-truncate">
                </div>
            @endfor
            @for ($i = 1; $i <= $dias; $i++)
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate">
                    <h5 class="row align-items-center">
                        <span class="date col-1">{{$i}}</span>
                        <small class="col d-sm-none text-center text-muted">{{$i}}</small>
                        <span class="col-1"></span>
                    </h5>
                    <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white"
                       title="Tarefas" href="{{route('tarefas.index')}}">Tarefas</a>
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
            height: 6.380vw;
        }
    }
</style>
