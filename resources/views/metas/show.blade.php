<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($meta->categoria->nomeCategoria == 'Saúde')
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$meta->categoria->cor}};">
                    @elseif($meta->categoria->nomeCategoria == 'Esportes') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$meta->categoria->cor}};">
                    @elseif($meta->categoria->nomeCategoria == 'Lazer') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$meta->categoria->cor}};">
                    @elseif($meta->categoria->nomeCategoria == 'Estudo') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$meta->categoria->cor}};">
                    @elseif($meta->categoria->nomeCategoria == 'Trabalho') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$meta->categoria->cor}};"> 
                    @elseif($meta->categoria->nomeCategoria == 'Ligações importantes') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$meta->categoria->cor}};">
                    @elseif($meta->categoria->nomeCategoria == 'Reuniões') 
                    <div class="p-6 border-b border-gray-200" style="background-color: {{$meta->categoria->cor}};"> 
                    @else <div class="p-6 border-b border-gray-200" style="background-color: {{$meta->categoria->cor}};"> 
                    @endif
                    <label for="categoria">Categoria: {{$meta->categoria->nomeCategoria}} </label><br>
                    <label for="nome">Nome: {{$meta->nomeMeta}} </label><br>
                    <label for="nomeTarefa">Descrição: {{$meta->descricao}} </label><br>
                    <label for="dataMeta">Data: {{$meta->dataMeta}} </label><br>
                    <label for="statusMeta">Status: {{$meta->statusMeta}} </label><br>
                    <a href="{{url()->previous()}}" class="btn btn-primary" type="button">Voltar</a><br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
