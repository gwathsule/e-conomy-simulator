<div class="card card-white grid-margin">
    <div class="card-heading clearfix">
        <h4 class="card-title">Instruções</h4>
    </div>
    <div class="card-body">
        @foreach(\App\Domains\Medida\Medida::all() as $medida)
            <a href="{{route('nova-rodada',  ['jogoId' => $jogo->id, 'medidaId' => $medida->id])}}"><li style="list-style: none">{{$medida->nome}}</li></a>
        @endforeach
    </div>
</div>