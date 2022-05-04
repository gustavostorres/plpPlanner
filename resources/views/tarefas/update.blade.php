<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{Auth::user()->name}}, bem vindo a sua página de tarefas!
                </div>
            </div>
            <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('tarefas.update')}}">
                        @csrf
                        <label for="categoria_id">Categoria:</label><br>
                        <select name="categoria_id" id="categoria_id">
                            @foreach($categorias as $categoria)
                                <option @if($tarefa->categoria_id == $categoria->id)
                                            selected
                                        @endif
                                        value="{{$categoria->id}}">{{$categoria->nomeCategoria}}</option>
                            @endforeach
                        </select><br>
                        <label for="titulo">Titulo:</label><br>
                        <input value="{{$tarefa->titulo}}" type="text" id="titulo" name="titulo"><br>
                        <label for="nomeTarefa">Descrição:</label><br>
                        <input value="{{$tarefa->nomeTarefa}}" type="text" id="nomeTarefa" name="nomeTarefa"><br>
                        <label for="dataTarefa">Data:</label><br>
                        <input value="{{$tarefa->dataTarefa}}" type="date" id="dataTarefa" name="dataTarefa"><br>
                        <label for="turno">Turno:</label><br>
                        <select name="turno" id="turno">
                            <option @if($tarefa->turno == "matutino")
                                        selected
                                    @endif value="matutino">Matutino</option>
                            <option @if($tarefa->turno == "vespertino")
                                        selected
                                    @endif value="vespertino">Vespertino</option>
                            <option @if($tarefa->turno == "noturno")
                                        selected
                                    @endif value="noturno">Noturno</option>
                        </select><br>
                        <label for="statusTarefa">Status:</label><br>
                        <select name="statusTarefa" id="statusTarefa">
                            <option @if($tarefa->statusTarefa == "naoIniciado")
                                        selected
                                    @endif value="naoIniciado">Não iniciado</option>
                            <option @if($tarefa->statusTarefa == "emAndamento")
                                        selected
                                    @endif value="emAndamento">Em andamento</option>
                            <option @if($tarefa->statusTarefa == "cancelado")
                                        selected
                                    @endif value="cancelado">Cancelado</option>
                            <option @if($tarefa->statusTarefa == "finalizado")
                                        selected
                                    @endif value="finalizado">Finalizado</option>
                        </select><br>
                        <input type="hidden" id="tarefa_id" name="tarefa_id" value="{{$tarefa->id}}"><br>
                        <button class="btn btn-success" type="submit">Atualizar</button><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
