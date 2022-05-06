<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 bg-white border-b border-gray-200">
                    <div class="row p-6 bg-white border-b border-gray-200">
                        <div class="col-sm-10">
                            <h6> {{Auth::user()->name}}, bem vindo a sua página de metas!</h6>
                        </div>
                        <div class="col-sm-2" style="bottom: auto;top: auto">
                            <a href="{{route('metas.create')}}" class="btn btn-success">Criar nova meta</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($metas as $meta)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h5>
                            {{$meta->nomeMeta}}
                        </h5>
                        <a href="{{route('metas.edit', ['id' => $meta->id])}}" class="btn btn-primary">Editar meta</a>
                        <a href="{{route('metas.show', ['id' => $meta->id])}}" class="btn btn-primary">Mostrar detalhes</a>
                        <a href="{{route('metas.destroy', ['id' => $meta->id])}}" class="btn btn-danger">Apagar</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
