@php
    $medidaRepository = new \App\Domains\Medida\MedidaRepository();
    $eventoRepository = new \App\Domains\Evento\EventoRepository();
@endphp

@extends('layouts.app')

@section('title', 'Criar Medida')

@section('conteudo')
    <form method="post" action="{{route('medida.editar')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$medida->id}}">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome da medida</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{$medida->nome}}">
            </div>
            <div class="form-group col-md-3">
                <label for="rodadas_para_excutar">Rodadas para executar</label>
                <input type="number" class="form-control" id="rodadas_para_excutar" name="rodadas_para_excutar" value="{{$medida->rodadas_para_excutar}}">
            </div>
            <div class="form-group col-md-3">
                <label for="diferenca">Diferença na variável</label>
                <input type="number" class="form-control" id="diferenca" name="diferenca" value="{{$medida->diferenca_financas}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="diferenca">Pop. Empresários</label>
                <input type="number" class="form-control" id="diferenca" name="popularidade_empresarios" value="{{$medida->diferenca_popularidade_empresarios}}">
            </div>
            <div class="form-group col-md-2">
                <label for="diferenca">Pop. Trabalhadores</label>
                <input type="number" class="form-control" id="diferenca" name="popularidade_trabalhadores" value="{{$medida->diferenca_popularidade_trabalhadores}}">
            </div>
            <div class="form-group col-md-2">
                <label for="diferenca">Pop. Estado</label>
                <input type="number" class="form-control" id="diferenca" name="popularidade_estado" value="{{$medida->diferenca_popularidade_estado}}">
            </div>
            <div class="form-group col-md-2">
                <label for="tipo">Tipo</label>
                <select id="tipo" name="tipo" class="form-control">
                    @foreach(array_keys($medidaRepository->getTiposDeMedida()) as $tipo)
                        <option value="{{$tipo}}" {{$medida->tipo == $tipo ? 'selected' : ''}}>{{$medidaRepository->getTiposDeMedida()[$tipo]}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="codigo_evento">Evento</label>
                <select id="codigo_evento" name="codigo_evento" class="form-control">
                    @foreach(array_keys($eventoRepository->allEventos()) as $evento)
                        <option value="{{$evento}}" {{ $medida->codigo_evento == $evento ? 'selected' : ''}}>{{$eventoRepository->allEventos()[$evento]}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="texto_noticia">Texto da Noticia</label>
                <textarea class="form-control" id="texto_noticia" name="texto_noticia" rows="3">{{$medida->texto_noticia}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Imagem da notícia</label>
            <input type="file" class="form-control-file" id="imagem_noticia" name="imagem_noticia">
        </div>
        <div class="form-group">
            <img src="{{\Illuminate\Support\Facades\Storage::url($medida->url_imagem)}}">
        </div>
        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
@endsection

