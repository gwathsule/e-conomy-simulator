<div class="card-heading clearfix">
    <h4 class="card-title">Medidas</h4>
</div>
<div class="card-body medidas">
    <a href="{{route('nova-rodada',  ['jogoId' => $jogo->id, 'medidaId' => '-1'])}}"
       data-toggle="tooltip" data-html="true" title="Não faz nada :D">
        <li style="list-style: none">
            <img class="chevron_medidas" src="{{asset('img/resources/double-chevron.svg')}}"> Não Fazer Nada
        </li>
    </a>
    @foreach(\App\Domains\Medida\Medida::all() as $medida)
        <a href="{{route('nova-rodada',  ['jogoId' => $jogo->id, 'medidaId' => $medida->id])}}"
           data-toggle="tooltip" data-html="true" title="{{$medida->resumo}}">
            <li style="list-style: none">
                <img class="chevron_medidas" src="{{asset('img/resources/double-chevron.svg')}}"> {{$medida->nome}}
            </li>
        </a>
    @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
    $(function() {
        $('a[data-toggle="tooltip"]').tooltip({
            animated: 'fade',
            placement: 'right',
        });
    });
</script>