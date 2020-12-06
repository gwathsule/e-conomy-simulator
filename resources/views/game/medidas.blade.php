<div class="card card-white grid-margin">
    <div class="card-heading clearfix">
        <h4 class="card-title">Medidas</h4>
    </div>
    <div class="card-body medidas">
        @foreach(\App\Domains\Medida\Medida::all() as $medida)
            <a href="{{route('nova-rodada',  ['jogoId' => $jogo->id, 'medidaId' => $medida->id])}}">
                <li style="list-style: none">
                    <img class="chevron_medidas" src="{{asset('img/resources/double-chevron.svg')}}"> {{$medida->nome}}
                </li>
            </a>
        @endforeach
    </div>
</div>