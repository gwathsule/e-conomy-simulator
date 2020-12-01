@php
    $medidaRepository = new \App\Domains\Medida\MedidaRepository();
    $eventoRepository = new \App\Domains\Evento\EventoRepository();
@endphp

@extends('layouts.app')

@section('title', 'Medidas')

@section('conteudo')
    <div class="col-lg-7 col-xl-6">
        <div class="form-row mb-4">
            <a href="{{route('medida.nova')}}">
                <button class="btn btn-primary btn-lg btn-block text-menu text-center">NOVA MEDIDA</button>
            </a>
            <a href="{{url('logout')}}">
                <button class="btn btn-primary btn-lg btn-block text-menu text-center">Sair</button>
            </a>
        </div>
    </div>
    <div class="col-lg-12 col-xl-12">
        <table class="table">
            <caption>Lista de Medidas</caption>
            <thead>
            <tr>
                <th scope="col">Evento</th>
                <th scope="col">Nome</th>
                <th scope="col">Time</th>
                <th scope="col">Imagem</th>
                <th scope="col">Tipo</th>
                <th scope="col">Texto</th>
                <th scope="col">Value</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listaMedidas as $medida)
            <tr>
                <th scope="row">{{$medida->codigo_evento}}</th>
                <td>{{$medida->nome}}</td>
                <td>{{$medida->rodadas_para_excutar}}</td>
                <td>...</td>
                <td>{{$medida->tipo}}</td>
                <td>{{$medida->texto_noticia}}</td>
                <td>{{$medida->diferenca}}</td>
                <td><a href="{{route('medida.editarPage',  ['id' => $medida->id])}}">Editar</a></td>
                <td><a href="{{route('medida.deletar',  ['id' => $medida->id])}}">Excluir</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
