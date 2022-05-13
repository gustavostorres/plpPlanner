<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{Auth::user()->name}}, bem vindo a sua página de metas!
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{route('metas.create')}}" class="btn btn-success">Criar nova meta</a>
                </div>
            </div>
            <br>
            @foreach($categorias as $categoria)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
            @endforeach
        </div>
    </div>

</x-app-layout>
