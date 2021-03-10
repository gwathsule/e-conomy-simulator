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
                        <small>{{$medida->getNomeJornal()}}</small>
                    </div>
                    <div class="timeline-item-post">
                        <p>{{$medida->buildTextoNoticia($jogo)}}</p>
                        <img src="{{\Illuminate\Support\Facades\Storage::url($medida->url_imagem)}}" alt="" />
                    </div>
                </div>
                @endif
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