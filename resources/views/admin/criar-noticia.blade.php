<div class="col-md-8" style="margin: 0 auto">
    <form method="POST" action="{{route('new-game')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputTitle">Título da Notícia</label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}" id="inputTitle" placeholder="Ex: Inflação aumenta 10%">
            </div>
            <div class="form-group col-md-6">
                <label for="inputJornal">Nome do Jornal</label>
                <input type="text" class="form-control" name="newspaper" value="{{old('newspaper')}}" id="inputJornal" placeholder="Ex: O Estadão">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputMinistro">Descrição</label>
                <textarea type="text" class="form-control" name="ministro" id="inputMinistro"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="exampleFormControlFile1">Imagem (Tamanho: similar a 350 x 350)</label>
                <input type="file" style="border: #d1d3e2 solid 1px" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </div>
        <div class="form-row">
            Se: <select></select>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Jogo</button>
    </form>
</div>
