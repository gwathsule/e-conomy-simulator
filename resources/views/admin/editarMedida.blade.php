@php
    $medidaRepository = new \App\Domains\Medida\MedidaRepository();
    $eventoRepository = new \App\Domains\Evento\EventoRepository();
@endphp

@extends('layouts.app')

@section('title', 'Editar Medida')

@section('content')
    <form>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nome">Nome da medida</label>
                <input type="text" class="form-control" id="nome" value="{{$medida->nome}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="rodadas_para_excutar">Rodadas para executar</label>
                <input type="number" class="form-control" id="rodadas_para_excutar" value="{{$medida->rodadas_para_excutar}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="diferenca">Diferença na variável chave (depende do evento)</label>
                <input type="number" class="form-control" id="diferenca" value="{{$medida->diferenca}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="texto_noticia">Texto da Noticia</label>
                <textarea class="form-control" id="texto_noticia" rows="3">{{$medida->texto_noticia}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="tipo">Tipo</label>
                <select id="tipo" class="form-control">
                    @foreach(array_keys($medidaRepository->getTiposDeMedida()) as $tipo)
                        <option value="{{$tipo}}" {{$tipo == $medida->texto_noticia ? 'selected' : ''}}>{{$medidaRepository->getTiposDeMedida()[$tipo]}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="codigo_evento">Evento</label>
                <select id="codigo_evento" class="form-control">
                    @foreach(array_keys($eventoRepository->allEventos()) as $evento)
                        <option value="{{$evento}}" {{$evento == $medida->codigo_evento ? 'selected' : ''}}>{{$eventoRepository->allEventos()[$evento]}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Imagem da notícia</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
@endsection

