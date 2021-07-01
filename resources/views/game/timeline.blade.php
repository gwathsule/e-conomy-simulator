<style>
    .timeline {
        height:984px;
        overflow-y: scroll;
    }

    .post{
        min-height: auto;
        border-bottom: 2px solid #989898;
    }

    .news-popup-estatal{
        border: 20px solid #ff5d5d;
    }
    .news-button-estatal{
        background-color: #ff5d5d !important;
        width: 100%;
    }
    .news-popup-liberal{
        border: 20px solid #3ac5ff;
    }
    .news-button-liberal{
        background-color: #3ac5ff !important;
        width: 100%;
    }
    .news-popup-title{
        font-size: 15px;
        text-transform: uppercase;
    }
    .news-popup-content{
        text-align: justify;
    }
    .news-popup-content:first-letter{
        text-transform: uppercase;
    }
</style>

@foreach($jogo->rodadas->reverse() as $rodada)
    @php
        $medida = \App\Domains\Medida\Medida::query()->find($rodada->medida_id)
    @endphp
    @if(! is_null($medida) && $jogo->status != \App\Domains\Jogo\Jogo::STATUS_VENCIDO && $jogo->status != \App\Domains\Jogo\Jogo::STATUS_PERDIDO)
        <div class="card-body post">
            <div class="timeline-item-header">
                <img src="{{$medida->getAvatarNoticia()}}" alt="" />
                <p>{{$medida->buildTituloNoticia($jogo)}}</p>
                <small>{{$medida->getNomeJornal()}} | Mês {{$rodada->rodada}}</small>
            </div>
            <div class="timeline-item-post">
                <p>{{$medida->buildTextoNoticia($jogo)}}</p>
                <img src="{{$medida->getImagem($jogo)}}" alt="" />
            </div>
        </div>
    @endif
    @foreach($rodada->noticias as $noticia)
        <div class="card-body post">
            <div class="timeline-item-header">
                <img src="{{$noticia["avatar_jornal"]}}" alt="" />
                <p>{{$noticia["titulo"]}}</p>
                <small>{{$noticia["nome_jornal"]}} | Mês {{$rodada->rodada}}</small>
            </div>
            <div class="timeline-item-post">
                <p>{{$noticia["texto"]}}</p>
                <img src="{{$noticia["imagem"]}}" alt="" />
            </div>
        </div>
    @endforeach
@endforeach

@section('js_adicionais')
    <script>
        @if(count($ultimaRodada->noticias) > 0)
        Swal.fire({
            title: '{{$ultimaRodada->noticias[0]["titulo"]}}',
            html: '{!! $ultimaRodada->noticias[0]["texto"] !!}',
            imageUrl: '{{$ultimaRodada->noticias[0]["imagem"]}}',
            imageWidth: 400,
            imageHeight: 200,
            customClass: {
                popup: 'news-popup-{{$ultimaRodada->noticias[0]['tipo'] == 'estatal' ? 'estatal' : 'liberal'}}',
                header: 'news-popup-header',
                title: 'news-popup-title',
                content: 'news-popup-content',
                confirmButton: 'news-button-{{$ultimaRodada->noticias[0]['tipo'] == 'estatal' ? 'estatal' : 'liberal'}}',
            }
        })
        @if(count($ultimaRodada->noticias) > 1)
        @for($i=1; $i < count($ultimaRodada->noticias); $i++)
            .then(() => {
                Swal.fire({
                    title: '{{$ultimaRodada->noticias[$i]["titulo"]}}',
                    html: '{!!$ultimaRodada->noticias[$i]["texto"]!!}',
                    imageUrl: '{{$ultimaRodada->noticias[$i]["imagem"]}}',
                    imageWidth: 400,
                    imageHeight: 200,
                    customClass: {
                        popup: 'news-popup-{{$ultimaRodada->noticias[$i]['tipo'] ? 'estatal' : 'liberal'}}',
                        header: 'news-popup-header',
                        title: 'news-popup-title',
                        content: 'news-popup-content',
                        confirmButton: 'news-button-{{$ultimaRodada->noticias[$i]['tipo'] ? 'estatal' : 'liberal'}}',
                    }
                })
                @endfor
                @for($i=1; $i< count($ultimaRodada->noticias); $i++)
            });
        @endfor
        @endif
        @endif
    </script>
@endsection
