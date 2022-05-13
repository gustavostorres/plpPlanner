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
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h5>
                            {{$categoria}}
                        </h5>
                        @foreach($metas as $meta)
                            @if($categoria == $meta->categoria->nomeCategoria)
                                <li>
                                    {{$meta->nomeMeta}}, com o status: Status: {{$meta->statusMeta}}
                                    <a href="{{route('metas.edit', ['id' => $meta->id])}}" class="btn btn-primary">Editar meta</a>
                                    <a href="{{route('metas.show', ['id' => $meta->id])}}" class="btn btn-primary">Mostrar detalhes</a>
                                    <a href="{{route('metas.destroy', ['id' => $meta->id])}}" class="btn btn-danger">Apagar</a>
                                </li>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
