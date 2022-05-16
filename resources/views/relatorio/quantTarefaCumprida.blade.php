<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{Auth::user()->name}}, bem vindo a sua página de relatórios!
                </div>
                <div class="container" style="margin-top: 10px">
                    @include('relatorio.formulario_busca')
                    <hr>

                    @foreach(array_reverse($categorias) as $categoria)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg meta" id="{{$categoria->nomeCategoria}}">
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
                            @else
                                <div class="p-6 border-b border-gray-200" style="background-color: {{$categoria->cor}};">
                            @endif
                            <h5>{{$categoria->nomeCategoria}} - Quantidade: {{$categoria->quantidade}} - Porcentagem: {{$categoria->porcentagem}}%</h5>
                            @foreach($tarefas as $tarefa)
                                @if($categoria->nomeCategoria == $tarefa->categoria->nomeCategoria)
                                    <ul class="status" id="{{$tarefa->statusTarefa}}">
                                        <li><b>Nome tarefa:</b> {{$tarefa->nomeTarefa}}</li>
                                   </ul>
                                   @endif
                            @endforeach
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
            <br>
        </div>
    </div>
</x-app-layout>
