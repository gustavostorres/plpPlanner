<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{Auth::user()->name}}, bem vindo a sua página de relatórios!
                </div>
                <div class="container" style="margin-top: 10px">
                    <form method="POST" action="{{route("relatorios.gerar")}}">
                        @csrf
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-1" style="padding-right: 0px;padding-left: 0px">
                                <label for="data">Data Inicial:</label><br>
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="dataInicial"
                                       class="form-control  @error('dataInicial') is-invalid @enderror"
                                       value="{{$dataInicial}}">
                                @error('dataInicial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="col-md-1" style="padding-right: 0px;padding-left: 0px">
                                <label for="data">Data Final:</label><br>
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="dataFinal"
                                       class="form-control  @error('dataFinal') is-invalid @enderror"
                                       value="{{$dataFinal}}">
                                @error('dataFinal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="col-md-1">
                                <label for="tipo">Relatorio:</label><br>
                            </div>
                            <div class="col-md-4" style="padding-left: 0px">
                                <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror">
                                    <option value="1" @if($tipo==1) selected @endif>Categorias de metas mais realizadas</option>
                                    <option value="2" @if($tipo==2) selected @endif>Categorias de tarefas mais realizadas</option>
                                    <option value="3" @if($tipo==3) selected @endif>Destacar turnos mais produtivos</option>
                                    <option value="4" @if($tipo==4) selected @endif>Quant. e Porcentagem de metas cumpridas</option>
                                    <option value="5" @if($tipo==5) selected @endif>Quant. e Porcentagem de tarefas executada</option>
                                    <option value="6" @if($tipo==6) selected @endif>Destacar semanas e meses mais produtivos</option>
                                </select>
                                @error('tipo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-1 justify-content-center">
                                <button type="submit" class="btn btn-primary">Gerar</button>
                            </div>
                        </div>
                    </form>
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
