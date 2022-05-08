<x-app-layout>
    <div class="py-12">
        <div class="col-md-6 mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('metas.salvar')}}">
                      @csrf
                      <div class="row justify-content-center">
                          <div class="col-md-6">
                              <label for="categoria_id">Categoria:</label><br>
                              <select class="form-control" name="categoria_id" id="categoria_id">
                                  @foreach($categorias as $categoria)
                                      <option value="{{$categoria->id}}">{{$categoria->nomeCategoria}}</option>
                                  @endforeach
                              </select><br>
                          </div>
                          <div class="col-md-6">
                              <label for="nomeMeta">Nome:</label><br>
                              <input class="form-control" type="text" id="nomeMeta" name="nomeMeta"><br>
                          </div>
                      </div>
                      <div class="row justify-content-center">
                          <div class="col-md-12">
                              <label for="descricao">Descrição:</label><br>
                              <textarea class="form-control" type="text" id="descricao" name="descricao"></textarea>
                          </div>
                      </div>
                      <div class="row justify-content-center">
                          <div class="col-md-6">
                              <label for="dataMeta">Data:</label><br>
                              <input class="form-control" type="date" id="dataMeta" name="dataMeta"><br><br>
                          </div>
                          <div class="col-md-6">
                              <label for="dataFinalMeta">Data Final:</label><br>
                              <input class= "form-control @error('dataFinalMeta') is-invalid @enderror" type="date" id="dataFinalMeta" name="dataFinalMeta"><br><br>
                              @error('dataFinalMeta')
                              <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 sm:text-left">
                                <a href="{{route('metas.index')}}" class="btn btn-danger" type="button" style="width: 150px">Voltar</a>
                            </div>
                            <div class="col-md-6 sm:text-right">
                                <button class="btn btn-success" type="submit" style="width: 150px">Criar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
