<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                        </select>
                        <label for="lembrete">Lembrete?</label>
                        <input @if($tarefa->lembrete) checked @endif type="checkbox" name="lembrete" id="lembrete"><br>
                        <label for="titulo">Titulo:</label><br>
                        <input value="{{$tarefa->titulo}}" type="text" id="titulo" name="titulo"><br>
                        <label for="nomeTarefa">Descrição:</label><br>
                        <input value="{{$tarefa->nomeTarefa}}" type="text" id="nomeTarefa" name="nomeTarefa"><br>
                        <label for="data">Data:</label><br>
                        <input value="{{$tarefa->data}}" type="date" name="data"><br>
                        <label for="horarioInicio">HorarioInicio:</label><br>
                        <input value="{{$tarefa->horarioInicio}}" type="time" name="horarioInicio"><br>
                        <label for="horarioFim">HorarioFim:</label><br>
                        <input value="{{$tarefa->horarioFim}}" type="time" name="horarioFim"><br>
                        <label for="statusTarefa">Status:</label><br>
                        <select name="statusTarefa" id="statusTarefa">
                            <option @if($tarefa->statusTarefa == "naoIniciado")
                                        selected
                                    @endif value="naoIniciado">Não iniciado</option>
                            <option @if($tarefa->statusTarefa == "executada")
                                        selected
                                    @endif value="executada">Executada</option>
                            <option @if($tarefa->statusTarefa == "parcialmenteExecutada")
                                        selected
                                    @endif value="parcialmenteExecutada">Parcialmente Executada</option>
                            <option @if($tarefa->statusTarefa == "adiada")
                                        selected
                                    @endif value="adiada">Adiada</option>
                        </select><br>
                        <input type="hidden" id="tarefa_id" name="tarefa_id" value="{{$tarefa->id}}"><br>
                        <a href="{{route('tarefas.index')}}" class="btn btn-primary" type="button">Voltar</a>
                        <button class="btn btn-success" type="submit">Atualizar</button><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
