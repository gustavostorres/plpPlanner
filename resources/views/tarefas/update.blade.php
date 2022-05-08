<x-app-layout>
    <div class="py-12">
        <div class="col-md-6 mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('tarefas.update')}}">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label for="titulo">Titulo:</label><br>
                                <input value="{{$tarefa->titulo}}" type="text" id="titulo" name="titulo"
                                       class="form-control @error('titulo') is-invalid @enderror" value="{{old('titulo')}}">
                                @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="categoria_id">Categoria:</label><br>
                                <select name="categoria_id" id="categoria_id" class="form-control ">
                                    @foreach($categorias as $categoria)
                                        <option @if($tarefa->categoria_id == $categoria->id)
                                                    selected
                                        @endif
                                        <option {{ old('categoria_id') == $categoria->id ? "selected" : "" }} value="{{$categoria->id}}">{{$categoria->nomeCategoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <label for="nomeTarefa">Descrição:</label><br>
                                <textarea  type="text" id="nomeTarefa" name="nomeTarefa"
                                          class="form-control @error('nomeTarefa') is-invalid @enderror">{{$tarefa->nomeTarefa}}</textarea>
                                @error('nomeTarefa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label for="data">Data:</label><br>
                                <input value="{{$tarefa->data}}" type="date" name="data"
                                       class="form-control  @error('data') is-invalid @enderror" value="{{old('data')}}">
                                @error('data')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="horarioInicio">Horario Inicio:</label><br>
                                <input value="{{$tarefa->horarioInicio}}" type="time" name="horarioInicio"
                                       class="form-control  @error('horarioInicio') is-invalid @enderror" value="{{old('horarioInicio')}}">
                                @error('horarioInicio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="horarioFim">Horario Fim:</label><br>
                                <input value="{{$tarefa->horarioFim}}" type="time" name="horarioFim"
                                       class="form-control @error('horarioFim') is-invalid @enderror" value="{{old('horarioFim')}}">
                                @error('horarioFim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @if(session('horario'))
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-sm-12 text-center">
                                    <div class="alert alert-danger" role="alert">
                                        <p>{{session('horario')}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                            <div class="row justify-content-center">
                                <div class="col-sm-12 ">
                                    <label for="statusTarefa">Status:</label><br>
                                    <select name="statusTarefa" id="statusTarefa">
                                        <option @if($tarefa->statusTarefa == "naoIniciado")
                                                    selected
                                                @endif value="naoIniciado">Não iniciado</option>
                                        <option @if($tarefa->statusTarefa == "executada")
                                                    selected
                                                @endif value="executada">Executada</option>
                                        <option @if($tarefa->statusTarefa == "parcialmenteExecutada")
                                                    selected
                                                @endif value="parcialmenteExecutada">Parcialmente Executada</option>
                                        <option @if($tarefa->statusTarefa == "adiada")
                                                    selected
                                                @endif value="adiada">Adiada</option>
                                    </select><br>
                                </div>
                            </div>
                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}"><br>
                        <input type="hidden" id="tarefa_id" name="tarefa_id" value="{{$tarefa->id}}"><br>
                        <div class="row justify-content-center">
                            <div class="col-md-6 sm:text-left">
                                <a href="{{route('tarefas.index')}}" class="btn btn-danger" type="button" style="width: 150px">Voltar</a>
                            </div>
                            <div class="col-md-6 sm:text-right">
                                <button class="btn btn-success" type="submit" style="width: 150px">Atualizar</button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
