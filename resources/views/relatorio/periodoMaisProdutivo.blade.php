<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{Auth::user()->name}}, bem vindo a sua página de relatórios!
                </div>
                <div class="container" style="margin-top: 10px">
                    @include('relatorio.formulario_busca')
                    <hr>
                    @foreach($anos as $ano)
                        @php
                            $aux = 0;
                        @endphp
                        @foreach($ano->meses as $mes)
                            @php
                                if($mes->semanas != null){
                                    $aux = 1;
                                }
                            @endphp
                        @endforeach
                        @if($aux > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 border-b border-gray-200" style="background-color: #89CFF0;">

                                <h4><b>Ano de {{$ano->ano}}<b><h4>
                            @foreach($ano->meses as $mes)
                                <div style="margin-left: 15px; margin-top: 15px;">
                                    @if($mes->semanas != null)
                                    <h5>Mês {{$mes->mes}}<h5>
                                    @endif

                                    @foreach($mes->semanas as $semana)
                                        <div style="margin-left: 15px;">
                                            <h6><li>Há {{$semana->quantidade}} tarefas concluidas na semana {{$semana->semana}}</li><h6>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            </div>
                        </div><br>
                        @endif
                    @endforeach
                </div>
            </div>
            <br>
        </div>
    </div>
</x-app-layout>
