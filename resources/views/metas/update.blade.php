<x-app-layout>
    <div class="py-12">
        <div class="col-md-6 mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('metas.update')}}">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label for="nomeMeta">Nome:</label><br>
                                <input class="form-control @error('nomeMeta') is-invalid @enderror" type="text" id="nomeMeta" name="nomeMeta" value="{{$meta->nomeMeta}}">
                                @error('nomeMeta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror<br>
                            </div>
                            <div class="col-md-6">
                                <label for="categoria_id">Categoria:</label><br>
                                <select class="form-control" name="categoria_id" id="categoria_id">
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}"
                                                @if($meta->categoria_id == $categoria->id)
                                                    selected
                                            @endif
                                        >{{$categoria->nomeCategoria}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <label for="descricao">Descrição:</label><br>
                                <textarea class="form-control  @error('descricao') is-invalid @enderror" type="text" id="descricao" name="descricao"> {{$meta->descricao}}</textarea>
                                @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror<br>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label for="dataMeta">Data:</label><br>
                                <input class="form-control  @error('dataMeta') is-invalid @enderror "type="date" id="dataMeta" name="dataMeta" value="{{$meta->dataMeta}}">
                                @error('dataMeta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="dataFinalMeta">Data Final:</label><br>
                                <input class= "form-control @error('dataFinalMeta') is-invalid @enderror" type="date" id="dataFinalMeta" name="dataFinalMeta" value="{{$meta->dataFinalMeta}}">
                                @error('dataFinalMeta')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content">
                            <div class="col-md-6">
                                <label for="statusMeta">Status:</label><br>
                                <select name="statusMeta" id="statusMeta">
                                    <option value="indefinido"
                                            @if($meta->statusMeta == "indefinido")
                                                selected
                                        @endif
                                    >Indefinido</option>
                                    <option value="semSucesso"
                                            @if($meta->statusMeta == "semSucesso")
                                                selected
                                        @endif
                                    >Sem Sucesso</option>
                                    <option value="parcialmenteAtingida"
                                            @if($meta->statusMeta == "parcialmenteAtingida")
                                                selected
                                        @endif
                                    >Parcialmente Atingida</option>
                                    <option value="comSucesso"
                                            @if($meta->statusMeta == "comSucesso")
                                                selected
                                        @endif
                                    >Com Sucesso</option>
                                </select><br><br>
                            </div>
                        </div>
                        <input type="hidden" id="meta_id" name="meta_id" value="{{$meta->id}}">
                        <div class="row justify-content-center">
                            <div class="col-md-6 sm:text-left">
                                <a href="{{route('metas.index')}}" class="btn btn-danger" type="button" style="width: 150px">Voltar</a>
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
