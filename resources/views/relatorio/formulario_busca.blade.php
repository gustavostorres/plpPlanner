<form method="POST" action="{{route("relatorios.gerar")}}">
    @csrf
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-1" style="padding-right: 0px;padding-left: 0px">
            <label for="data">Data Inicial:</label><br>
        </div>
        <div class="col-md-2">
            <input type="date" name="dataInicial"
                   class="form-control  @error('dataInicial') is-invalid @enderror"
                   @if(isset($dataInicial))value="{{$dataInicial}}"@else value="{{old("dataInicial")}}" @endif>
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
                   @if(isset($dataFinal))value="{{$dataFinal}}"@else value="{{old("dataFinal")}}" @endif>
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
                <option value="" disabled selected hidden>Selecione um Relatório</option>
                <option value="1" @if(isset($tipo) && $tipo==1) selected  @endif>Categorias de metas mais realizadas</option>
                <option value="2" @if(isset($tipo) && $tipo==2) selected  @endif>Categorias de tarefas mais realizadas</option>
                <option value="3" @if(isset($tipo) && $tipo==3) selected  @endif>Destacar turnos mais produtivos</option>
                <option value="4" @if(isset($tipo) && $tipo==4) selected  @endif>Quant. e Porcentagem de metas cumpridas</option>
                <option value="5" @if(isset($tipo) && $tipo==5) selected  @endif>Quant. e Porcentagem de tarefas executada</option>
                <option value="6" @if(isset($tipo) && $tipo==6) selected  @endif>Destacar semanas e meses mais produtivos</option>
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
