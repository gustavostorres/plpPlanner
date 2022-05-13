<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($tarefa->categoria->nomeCategoria == 'Saúde')
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$tarefa->categoria->cor}};">
                    @elseif($tarefa->categoria->nomeCategoria == 'Esportes') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$tarefa->categoria->cor}};">
                    @elseif($tarefa->categoria->nomeCategoria == 'Lazer') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$tarefa->categoria->cor}};">
                    @elseif($tarefa->categoria->nomeCategoria == 'Estudo') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$tarefa->categoria->cor}};">
                    @elseif($tarefa->categoria->nomeCategoria == 'Trabalho') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$tarefa->categoria->cor}};"> 
                    @elseif($tarefa->categoria->nomeCategoria == 'Ligações importantes') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$tarefa->categoria->cor}};">
                    @elseif($tarefa->categoria->nomeCategoria == 'Reuniões') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$tarefa->categoria->cor}};"> 
                    @else <div class="p-6 border-b border-gray-200" style="background-color: {{$tarefa->categoria->cor}};"> 
                    @endif
                    <label for="categoria">Categoria: {{$tarefa->categoria->nomeCategoria}} </label><br>
                    <label for="titulo">Titulo: {{$tarefa->titulo}} </label><br>
                    <label for="nomeTarefa">Descrição: {{$tarefa->nomeTarefa}} </label><br>
                    <label for="dataTarefa">Data: {{$tarefa->data}} </label><br>
                    <label for="turno">Horário: entre {{$tarefa->horarioInicio}} e {{$tarefa->horarioFim}} </label><br>
                    <label for="statusTarefa">Status: {{$tarefa->statusTarefa}} </label><br>
                    <a href="{{url()->previous()}}" class="btn btn-primary" type="button">Voltar</a><br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
