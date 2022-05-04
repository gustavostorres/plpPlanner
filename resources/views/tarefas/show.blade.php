<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <label for="categoria">Categoria: {{$tarefa->categoria->nomeCategoria}} </label><br>
                    <label for="titulo">Titulo: {{$tarefa->titulo}} </label><br>
                    <label for="nomeTarefa">Descrição: {{$tarefa->nomeTarefa}} </label><br>
                    <label for="dataTarefa">Data: {{$tarefa->dataTarefa}} </label><br>
                    <label for="turno">Turno: {{$tarefa->turno}} </label><br>
                    <label for="statusTarefa">Status: {{$tarefa->statusTarefa}} </label><br>
                    <a href="{{url()->previous()}}" class="btn btn-primary" type="button">Voltar</a><br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
