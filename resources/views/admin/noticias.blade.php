@extends('layouts.app')

@section('title', 'News')

@section('content')
    <div class="ol-xl-12 col-lg-12 mb-3">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#lista-noticias" role="tab" aria-controls="lista-noticias" aria-selected="true">Lista de notícias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#criar-noticia" role="tab" aria-controls="criar-noticia" aria-selected="false">Criar notícia</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="lista-noticias" role="tabpanel" aria-labelledby="lista-noticias-tab">
                        @include('admin.lista-noticias')
                    </div>
                    <div class="tab-pane" id="criar-noticia" role="tabpanel" aria-labelledby="criar-noticia-tab">
                        @include('admin.criar-noticia')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/noticiasPage.js')}}"></script>
@endsection
