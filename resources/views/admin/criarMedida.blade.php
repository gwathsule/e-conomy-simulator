@php
    $medidaRepository = new \App\Domains\Medida\MedidaRepository();
    $eventoRepository = new \App\Domains\Evento\EventoRepository();
@endphp

@extends('layouts.app')

@section('title', 'Criar Medida')

@section('conteudo')
    <form method="post" action="{{route('medida.nova')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome da medida</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}">
            </div>
            <div class="form-group col-md-3">
                <label for="rodadas_para_excutar">Rodadas para executar</label>
                <input type="number" class="form-control" id="rodadas_para_excutar" name="rodadas_para_excutar" value="{{old('rodadas_para_excutar')}}">
            </div>
            <div class="form-group col-md-3">
                <label for="diferenca">Diferença na variável</label>
                <input type="number" class="form-control" id="diferenca" name="diferenca" value="{{old('diferenca')}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="diferenca">Pop. Empresários</label>
                <input type="number" class="form-control" id="diferenca" name="popularidade_empresarios" value="{{old('popularidade_empresarios')}}">
            </div>
            <div class="form-group col-md-2">
                <label for="diferenca">Pop. Trabalhadores</label>
                <input type="number" class="form-control" id="diferenca" name="popularidade_trabalhadores" value="{{old('popularidade_trabalhadores')}}">
            </div>
            <div class="form-group col-md-2">
                <label for="diferenca">Pop. Estado</label>
                <input type="number" class="form-control" id="diferenca" name="popularidade_estado" value="{{old('popularidade_estado')}}">
            </div>
            <div class="form-group col-md-2">
                <label for="tipo">Tipo da Notícia</label>
                <select id="tipo" name="tipo" class="form-control">
                    @foreach(array_keys($medidaRepository->getTiposDeNoticias()) as $tipo)
                        <option value="{{$tipo}}" {{old('tipo') == $tipo ? 'selected' : ''}}>{{$medidaRepository->getTiposDeNoticias()[$tipo]}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="codigo_evento">Evento</label>
                <select id="codigo_evento" name="codigo_evento" class="form-control">
                    @foreach(array_keys($eventoRepository->allEventos()) as $evento)
                        <option value="{{$evento}}" {{old('codigo_evento') == $evento ? 'selected' : ''}}>{{$eventoRepository->allEventos()[$evento]}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nome">Titulo da Notícia</label>
                <input type="text" class="form-control" id="titulo_noticia" name="titulo_noticia" value="{{old('titulo_noticia')}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="texto_noticia">Texto da Noticia</label>
                <textarea class="form-control" id="texto_noticia" name="texto_noticia" rows="3">{{old('texto_noticia')}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Imagem da notícia</label>
            <input type="file" class="form-control-file" id="imagem_noticia" name="imagem_noticia" value="{{old('imagem_noticia')}}">
        </div>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
@endsection

