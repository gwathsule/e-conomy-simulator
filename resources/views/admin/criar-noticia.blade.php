<div class="col-md-8" style="margin: 0 auto">
    <form method="POST" action="{{route('create-news')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputTitle">Título da Notícia</label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}" id="inputTitle" placeholder="Ex: Inflação aumenta 10%">
            </div>
            <div class="form-group col-md-6">
                <label for="inputJornal">Nome do Jornal</label>
                <input type="text" class="form-control" name="newscast" value="{{old('newscast')}}" id="inputJornal" placeholder="Ex: O Estadão">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputDescricao">Descrição</label>
                <textarea type="text" class="form-control" name="description" id="inputDescricao">{{old('description')}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputImagem">Imagem (Tamanho: similar a 350 x 350)</label>
                <input type="file" name="image" style="border: #d1d3e2 solid 1px" class="form-control-file" id="inputImagem">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Criar Notícia</button>
    </form>
</div>
