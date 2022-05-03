<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Criar uma nova tarefa
        </h2>
    </x-slot>

    @php
        $categorias = App\Models\Categoria::all();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('tarefas.salvar')}}">
                      @csrf
                      <label for="categoria_id">Categoria:</label><br>
                      <select name="categoria_id" id="categoria_id">
                          @foreach($categorias as $categoria)
                          <option value="{{$categoria->id}}">{{$categoria->nomeCategoria}}</option>
                          @endforeach
                      </select><br>
                      <label for="titulo">Titulo:</label><br>
                      <input type="text" id="titulo" name="titulo"><br>
                      <label for="nomeTarefa">Descrição:</label><br>
                      <input type="text" id="nomeTarefa" name="nomeTarefa"><br>
                      <label for="dataTarefa">Data:</label><br>
                      <input type="date" id="dataTarefa" name="dataTarefa"><br>
                      <label for="turno">Turno:</label><br>
                      <select name="turno" id="turno">
                          <option value="matutino">Matutino</option>
                          <option value="vespertino">Vespertino</option>
                          <option value="noturno">Noturno</option>
                      </select><br>
                      <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}"><br>
                      <x-button class="btn" type="submit">Enviar</x-button><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>