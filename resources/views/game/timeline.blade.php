<div class="profile-timeline">
    <ul class="list-unstyled">
        <li class="timeline-item">
            <div class="card card-white grid-margin timeline">
                @foreach($jogo->rodadas->reverse() as $rodada)
                    @php
                        $medida = \App\Domains\Medida\Medida::query()->find($rodada->medida_id)
                    @endphp
                    @if(! is_null($medida))
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
            </div>
        </li>
    </ul>
</div>

<style>
    .timeline {
        height:984px;
        overflow-y: scroll;
    }

    .post{
        min-height: auto;
        border-bottom: 2px solid #989898;
    }
</style>