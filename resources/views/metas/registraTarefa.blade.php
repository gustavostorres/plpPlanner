<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('metas.registrar.tarefa')}}">
                        @csrf
                        <label for="nomeMeta">Meta: {{$meta->nomeMeta}}</label><br>
                        <input type="hidden" id="id" name="id" value="{{$meta->id}}">
                        <label for="tarefas">Tarefas:</label><br>
                        <div class="col-md-12 mt-2">
                            @foreach ($tarefas as $tarefa)
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="tarefa_id[]" value="{{ $tarefa->id }}"
                                                   aria-label="Checkbox for following text input"
                                                   @if($meta->tarefas->find($tarefa->id)) checked @endif>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" value="{{$tarefa->titulo}}">
                                </div>
                            @endforeach
                        </div>
                        <a href="{{url()->previous()}}" class="btn btn-primary" type="button">Voltar</a>
                        <button class="btn btn-success" type="submit">Enviar</button>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
