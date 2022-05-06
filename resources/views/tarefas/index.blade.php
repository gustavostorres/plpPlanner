<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{Auth::user()->name}}, bem vindo a sua página de tarefas!
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{route('tarefas.create')}}" class="btn btn-success">Criar nova tarefa</a>
                </div>
            </div>
            <br>
            @foreach($categorias as $categoria)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h5>
                            {{$categoria}}
                        </h5>
                        @foreach($tarefas as $tarefa)
                            @if($categoria == $tarefa->categoria->nomeCategoria)
                                <li>
                                    {{$tarefa->titulo}}, no turno {{$tarefa->turno}}. Status: {{$tarefa->statusTarefa}}
                                    <a href="{{route('tarefas.edit', ['id' => $tarefa->id])}}" class="btn btn-primary">Editar tarefa</a>
                                    <a href="{{route('tarefas.show', ['id' => $tarefa->id])}}" class="btn btn-primary">Mostrar detalhes</a>
                                </li>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
