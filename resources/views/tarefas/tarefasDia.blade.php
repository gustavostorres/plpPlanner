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
                        @foreach($tarefas as $tarefa)
                            @if($categoria->nomeCategoria == $tarefa->categoria->nomeCategoria)
                                <ul>
                                <li><b>Nome:</b> {{$tarefa->titulo}}
                                <ul>
                                    <div style="float: right">
                                        <a href="{{route('tarefas.edit', ['id' => $tarefa->id])}}" class="btn btn-primary">Editar tarefa</a>
                                        <a href="{{route('tarefas.show', ['id' => $tarefa->id])}}" class="btn btn-primary">Mostrar detalhes</a>
                                        <a href="{{route('tarefas.destroy', ['id' => $tarefa->id])}}" class="btn btn-danger">Apagar</a>
                                    </div>
                                    <li><b>Descrição:</b> {{$tarefa->nomeTarefa}}.</li>
                                    <li><b>Status:</b> {{$tarefa->statusTarefa}}</li>
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
