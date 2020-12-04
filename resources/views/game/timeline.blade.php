<div class="profile-timeline">
    <ul class="list-unstyled">
        <li class="timeline-item">
            <div class="card card-white grid-margin">
                @foreach($jogo->rodadas->reverse() as $rodada)
                @php
                    $medida = \App\Domains\Medida\Medida::query()->find($rodada->medida_id)
                @endphp
                @if(! is_null($medida))
                <div class="card-body">
                    <div class="timeline-item-header">
                        <img src="{{$medida->getAvatarNoticia()}}" alt="" />
                        <p>{{$medida->titulo_noticia}}</p>
                        <small>{{$medida->getNomeJornal()}}</small>
                    </div>
                    <div class="timeline-item-post">
                        <p>{{$medida->texto_noticia}}</p>
                        <img src="{{\Illuminate\Support\Facades\Storage::url($medida->url_imagem)}}" alt="" />
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </li>
    </ul>
</div>