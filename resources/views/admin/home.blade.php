@php
    $medidaRepository = new \App\Domains\Medida\MedidaRepository();
    $eventoRepository = new \App\Domains\Evento\EventoRepository();
@endphp

@extends('layouts.app')

@section('title', 'Medidas')

@section('content')
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
            <td><a href="{{route('medida.editar',  ['id' => $medida->id])}}">Editar</a></td>
            <td><a href="{{route('medida.deletar',  ['id' => $medida->id])}}">Excluir</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
