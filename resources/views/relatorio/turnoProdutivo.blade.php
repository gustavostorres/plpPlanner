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
                    @foreach(array_reverse($turnos) as $turno)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="{{$turno->turno}}">
                        @if($turno->turno == 'Manha')
                            <div class="p-6 border-b border-gray-200" style="background-color: #89CFF0;">
                        @elseif($turno->turno == 'Tarde')
                            <div class="p-6 border-b border-gray-200" style="background-color: #fdee00;">
                        @else
                            <div class="p-6 border-b border-gray-200" style="background-color: #002D62; color: white;">
                        @endif
                        <h5>{{$turno->turno}} com Quantidade: {{$turno->quantidade}}</h5>
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
