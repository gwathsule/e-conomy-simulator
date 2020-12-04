<div class="col-lg-5 col-xl-3">
    <div class="card card-white grid-margin">
        <div class="card-heading clearfix">
            <h4 class="card-title">Gabinete</h4>
        </div>
        <div class="card-body user-profile-card mb-3">
            <img src="{{$jogo->getImagemPersonagem()}}" class="user-profile-image rounded-circle" alt="" />
            <h4 class="text-center h6 mt-2">{{$jogo->ministro}}</h4>
            <a href="{{url('logout')}}"><button class="btn btn-theme btn-sm">Logout</button></a>
            <a href="{{route('novo-jogo')}}"><button class="btn btn-theme btn-sm">Novo Mandato</button></a>
        </div>
        <hr />

        <div class="card-body">
            <div class="card-heading clearfix">
                <h4 class="card-title">Último Mês</h4>
            </div>
            <div class="table-responsive">
                <p><strong>PIB</strong>: <small>R$ {{$ultimaRodada['pib']}}</small></p>
                <p><strong>Investimentos</strong>: <small>R$ {{$ultimaRodada['investimentos']}}</small></p>
                <p><strong>Gastos governamentais</strong>: <small>R$ {{$ultimaRodada['gastos_governamentais']}}</small></p>
                <p><strong>Transferencias</strong>: <small>R$ {{$ultimaRodada['transferencias']}}</small></p>
                <p><strong>Impostos</strong>: <small>R$ {{$ultimaRodada['impostos']}}</small></p>
                <p><strong>Consumo.</strong>: <small>R$ {{$ultimaRodada['consumo']}}</small></p>
                <p><strong>Renda Disponivel</strong>: <small>R$ {{$ultimaRodada['renda_disponivel']}}</small></p>
                <p><strong>Def/Superavit.</strong>: <small>R$ {{$ultimaRodada['deficit_ou_superavit']}}</small></p>
                <p><strong>INV.</strong>: <small>R$ {{$ultimaRodada['investimentos']}}</small></p>
            </div>
        </div>

        <div class="card-body">
            <div class="card-heading clearfix">
                <h4 class="card-title">Resultados Agregados</h4>
            </div>
            @php($i = 0)
            @foreach($jogo->getResultadosAgregados() as $ano)
                <div class="card-heading clearfix">
                    @if($i == 0)
                        <h5 class="card-title">Mandato anterior</h5>
                    @else
                        <h5 class="card-title">{{$i}}° ano de mandato</h5>
                    @endif
                </div>
                <div class="table-responsive">
                    <p><strong>Gastos Governamentais</strong>: <small>R$ {{$ano['gastos_governamentais']}}</small></p>
                    <p><strong>Investimentos</strong>: <small>R$ {{$ano['investimentos']}}</small></p>
                    <p><strong>Impostos</strong>: <small>R$ {{$ano['impostos']}}</small></p>
                    <p><strong>Transferencias</strong>: <small>R$ {{$ano['transferencias']}}</small></p>
                    <p><strong>Consumo</strong>: <small>R$ {{$ano['consumo']}}</small></p>
                    <p><strong>PIB</strong>: <small>R$ {{$ano['pib']}}</small></p>
                </div>
                @php($i++)
            @endforeach
        </div>
    </div>
</div>
