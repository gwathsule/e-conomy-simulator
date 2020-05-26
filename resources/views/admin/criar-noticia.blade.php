<div class="col-md-8" style="margin: 0 auto">
    <form method="POST" action="{{route('new-game')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputPais">Título da Notícia</label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}" id="inputPais" placeholder="Arrume um bem criativo">
            </div>
            <div class="form-group col-md-6">
                <label for="inputMoeda">Nome do Jornal</label>
                <input type="text" class="form-control" name="moeda" value="{{old('moeda')}}" id="inputMoeda" placeholder="Informar o plural (ex.: reais)">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputMinistro">Descrição</label>
                <textarea type="text" class="form-control" name="ministro" id="inputMinistro" placeholder="Esse aqui é você">
                    value="{{old('ministro')}}"
                </textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputMinistro">Imagem</label>
                <textarea type="text" class="form-control" name="ministro" id="inputMinistro" placeholder="Esse aqui é você">
                    value="{{old('ministro')}}"
                </textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Jogo</button>
    </form>
</div>
