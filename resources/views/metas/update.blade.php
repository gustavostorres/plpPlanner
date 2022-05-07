<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('metas.update')}}">
                        @csrf
                        <input type="hidden" id="meta_id" name="meta_id" value="{{$meta->id}}">
                        <label for="categoria_id">Categoria:</label><br>
                        <select name="categoria_id" id="categoria_id">
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}"
                                    @if($meta->categoria_id == $categoria->id)
                                        selected
                                    @endif
                                >{{$categoria->nomeCategoria}}</option>
                            @endforeach
                        </select><br>
                        <label for="nomeMeta">Nome:</label><br>
                        <input type="text" id="nomeMeta" name="nomeMeta" value="{{$meta->nomeMeta}}"><br>
                        <label for="descricao">Descrição:</label><br>
                        <input type="text" id="descricao" name="descricao" value="{{$meta->descricao}}"><br>
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
                        </select><br>
                        <label for="dataMeta">Data:</label><br>
                        <input type="date" id="dataMeta" name="dataMeta" value="{{$meta->dataMeta}}"><br><br>
                        <label for="dataFinalMeta">Data Final:</label><br>
                        <input class= "@error('dataFinalMeta') is-invalid @enderror" type="date" id="dataFinalMeta" name="dataFinalMeta" value="{{$meta->dataFinalMeta}}"><br><br>
                        @error('dataFinalMeta')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <a href="{{url()->previous()}}" class="btn btn-primary" type="button">Voltar</a>
                        <button class="btn btn-success" type="submit">Enviar</button>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
