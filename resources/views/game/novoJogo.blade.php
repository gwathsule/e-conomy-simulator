<div class="col-xl-6 col-lg-6 mb-3" style="margin: auto">
    <div class="card">
        <div class="card-header">
            Cadastrar novo jogo
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('new-game')}}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPais">Nome da País</label>
                        <input type="text" class="form-control" name="pais" value="{{old('pais')}}" id="inputPais" placeholder="Arrume um bem criativo">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputMoeda">Nome da moeda</label>
                        <input type="text" class="form-control" name="moeda" value="{{old('moeda')}}" id="inputMoeda" placeholder="Informar o plural (ex.: reais)">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputMinistro">Nome do ministro da economia</label>
                        <input type="text" class="form-control" name="ministro" value="{{old('ministro')}}" id="inputMinistro" placeholder="Esse aqui é você">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPresidente">Nome do presidente</label>
                        <input type="text" class="form-control" name="presidente" value="{{old('presidente')}}" id="inputPresidente" placeholder="Seu patrão (vai receber a culpa por suas ca**das)">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputDescricao">Descrição do jogo</label>
                        <input type="text" class="form-control" name="descricao" value="{{old('descricao')}}" id="inputDescricao" placeholder="Ex.: Privatizando até a mãe">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputRodadas">Duração (rodadas)</label>
                        <input type="number" class="form-control" name="rodadas" value="{{old('rodadas')}}" id="inputRodadas" placeholder="Limitada a no mínimo 10">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Jogo</button>
            </form>
        </div>
    </div>
</div>
