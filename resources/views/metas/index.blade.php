<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row p-6 bg-white border-b border-gray-200">
                    <div class="col-sm-10">
                        <h6> {{Auth::user()->name}}, bem vindo a sua página de metas!</h6>
                    </div>
                    <div class="col-sm-2" style="bottom: auto;top: auto">
                        <a href="{{route('metas.create')}}" class="btn btn-success">Criar nova meta</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4" style="float: left;">
                    <select id="" class="form-control" onchange="exibirMetas(this)">
                        <option value="all" selected>Todas as metas (categoria)</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->nomeCategoria}}">{{$categoria->nomeCategoria}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4" style="float: left;">
                    <select id="" class="form-control" onchange="exibirMetas2(this)">
                        <option value="all" selected>Todas as metas (status)</option>
                        <option value="comSucesso">Sucesso</option>
                        <option value="semSucesso">Sem Sucesso</option>
                        <option value="parcialmenteAtingida">Parcialmente Atingida</option>
                        <option value="indefinido">Indefinida</option>
                    </select>
                </div>
            </div>
            <br>
            @foreach($categorias as $categoria)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg meta" id="{{$categoria->nomeCategoria}}">
                    @if($categoria->nomeCategoria == 'Saúde')
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$categoria->cor}};">
                    @elseif($categoria->nomeCategoria == 'Esportes')
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$categoria->cor}};">
                    @elseif($categoria->nomeCategoria == 'Lazer')
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$categoria->cor}};">
                    @elseif($categoria->nomeCategoria == 'Estudo')
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$categoria->cor}};">
                    @elseif($categoria->nomeCategoria == 'Trabalho')
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$categoria->cor}};">
                    @elseif($categoria->nomeCategoria == 'Ligações importantes')
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$categoria->cor}};">
                    @elseif($categoria->nomeCategoria == 'Reuniões')
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$categoria->cor}};">
                    @else <div class="p-6 border-b border-gray-200" style="background-color: {{$categoria->cor}};">
                    @endif
                        <h5>
                            {{$categoria->nomeCategoria}}
                        </h5>
                        @foreach($metas as $meta)
                            @if($categoria->nomeCategoria == $meta->categoria->nomeCategoria)
                            <ul class="status" id="{{$meta->statusMeta}}">
                                <li><b>Nome:</b> {{$meta->nomeMeta}}
                                <ul>
                                    <div style="float: right">
                                        <a href="{{route('metas.edit', ['id' => $meta->id])}}" class="btn btn-primary">Editar meta</a>
                                        <a href="{{route('metas.show', ['id' => $meta->id])}}" class="btn btn-primary">Ver detalhes</a>
                                        <a href="{{route('metas.cadastrar.tarefa', ['id' => $meta->id])}}" class="btn btn-primary">Cadastrar Tarefa</a>
                                        <a href="{{route('metas.destroy', ['id' => $meta->id])}}" class="btn btn-danger">Apagar</a>
                                    </div>
                                    <li><b>Acontece entre:</b> {{$meta->dataMeta}} e {{$meta->dataFinalMeta}}</li>
                                    <li><b>Status:</b> {{$meta->statusMeta}}</li>
                                </ul>
                                </li>
                            </ul>
                            @endif
                        @endforeach
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>

</x-app-layout>

<script>
    function exibirMetas(select) {
        var metas = document.getElementsByClassName("meta");
        for (var i = 0; i < metas.length; i++) {
            if (select.value == metas[i].getAttribute("id") || select.value == "all") {
                metas[i].style.display = "";
            } else {
                metas[i].style.display = "none";
            }
        }
    }

    function exibirMetas2(select) {
        var metas = document.getElementsByClassName("status");
        for (var i = 0; i < metas.length; i++) {
            if (select.value == metas[i].getAttribute("id") || select.value == "all") {
                metas[i].style.display = "";
            } else {
                metas[i].style.display = "none";
            }
        }
    }
</script>
