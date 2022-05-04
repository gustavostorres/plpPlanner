<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{Auth::user()->name}}, bem vindo a sua página de tarefas!
                </div>
            </div>
            <br>
            @foreach($categorias as $categoria)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h5>
                            {{$categoria->nomeCategoria}}
                        </h5>
                        @foreach($tarefas as $tarefa)
                            @if($categoria->id == $tarefa->categoria_id)
                                <li>
                                    {{$tarefa->titulo}}, {{$tarefa->turno}}, {{$tarefa->statusTarefa}}
                                </li>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
