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
            <div class="form-group col-md-12">
                <label for="nome">Nome da medida</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="rodadas_para_excutar">Rodadas para executar</label>
                <input type="number" class="form-control" id="rodadas_para_excutar" name="rodadas_para_excutar" value="{{old('rodadas_para_excutar')}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="diferenca">Diferença na variável chave (depende do evento)</label>
                <input type="number" class="form-control" id="diferenca" name="diferenca" value="{{old('diferenca')}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="texto_noticia">Texto da Noticia</label>
                <textarea class="form-control" id="texto_noticia" name="texto_noticia" rows="3">{{old('texto_noticia')}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="tipo">Tipo</label>
                <select id="tipo" name="tipo" class="form-control">
                    @foreach(array_keys($medidaRepository->getTiposDeMedida()) as $tipo)
                        <option value="{{$tipo}}" {{old('tipo') == $tipo ? 'selected' : ''}}>{{$medidaRepository->getTiposDeMedida()[$tipo]}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="codigo_evento">Evento</label>
                <select id="codigo_evento" name="codigo_evento" class="form-control">
                    @foreach(array_keys($eventoRepository->allEventos()) as $evento)
                        <option value="{{$evento}}" {{old('codigo_evento') == $evento ? 'selected' : ''}}>{{$eventoRepository->allEventos()[$evento]}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Imagem da notícia</label>
            <input type="file" class="form-control-file" id="imagem_noticia" name="imagem_noticia" value="{{old('imagem_noticia')}}">
        </div>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
@endsection

