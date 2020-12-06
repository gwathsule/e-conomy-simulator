<div class="col-lg-5 col-xl-3">
    <div class="card card-white grid-margin gabinete">
        <div class="card-body user-profile-card mb-3">
            <img src="{{$jogo->getImagemPersonagem()}}" class="user-profile-image rounded-circle" alt="" />
            <p class="text-center h6 mt-2 nome_ministro">{{$jogo->ministro}}</p>
            <table style="align-content: center">
                <tr>
                    <td><a href="{{url('logout')}}"><button class="btn btn-theme btn-sm btn_gabinete" >Logout</button></a></td>
                    <td><a href="{{route('novo-jogo')}}"><button class="btn btn-theme btn-sm btn_gabinete">Novo Jogo</button></a></td>
                </tr>
            </table>
        </div>

        <div class="card-body">
            <div class="card-heading clearfix">
                <h4 class="card-title">Último Mês</h4>
            </div>
            <div class="table-responsive">
                <p>
                    <strong>PIB</strong> <br>
                    <small>$$ {{number_format($ultimaRodada['pib'], 2, ',', '.')}}</small>
                </p>
                <p>
                    <strong>Investimentos</strong> <br>
                    <small>$$ {{number_format($ultimaRodada['investimentos'], 2, ',', '.')}}</small>
                </p>
                <p>
                    <strong>Gastos governamentais</strong> <br>
                    <small>$$ {{number_format($ultimaRodada['gastos_governamentais'], 2, ',', '.')}}</small>
                </p>
                <p>
                    <strong>Transferencias</strong> <br>
                    <small>$$ {{number_format($ultimaRodada['transferencias'], 2, ',', '.')}}</small>
                </p>
                <p>
                    <strong>Imposto de renda</strong> <br>
                    <small>{{$ultimaRodada['imposto_renda'] * 100}}%</small>
                </p>
                <p>
                    <strong>Impostos</strong> <br>
                    <small>$$ {{number_format($ultimaRodada['impostos'], 2, ',', '.')}}</small>
                </p>
                <p>
                    <strong>Consumo.</strong> <br>
                    <small>$$ {{number_format($ultimaRodada['consumo'], 2, ',', '.')}}</small>
                </p>
                <p>
                    <strong>Renda Disponivel</strong> <br>
                    <small>$$ {{number_format($ultimaRodada['renda_disponivel'], 2, ',', '.')}}</small>
                </p>
                <p>
                    <strong>Def/Superavit.</strong> <br>
                    <small>$$ {{number_format($ultimaRodada['deficit_ou_superavit'], 2, ',', '.')}}</small>
                </p>
                <p>
                    <strong>INV.</strong> <br>
                    <small>$$ {{number_format($ultimaRodada['investimentos'], 2, ',', '.')}}</small>
                </p>
            </div>
        </div>
        <hr />
        <div class="card-body">
            <div class="card-heading clearfix">
                <h4 class="card-title">Res. Anuais</h4>
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
                    <p>
                        <strong>Gastos Governamentais</strong> <br>
                        <small>$$ {{number_format($ano['gastos_governamentais'], '2', ',', '.')}}</small>
                    </p>
                    <p>
                        <strong>Investimentos</strong> <br>
                        <small>$$ {{number_format($ano['investimentos'], '2', ',', '.')}}</small>
                    </p>
                    <p>
                        <strong>Impostos</strong> <br>
                        <small>$$ {{number_format($ano['impostos'], '2', ',', '.')}}</small>
                    </p>
                    <p>
                        <strong>Transferencias</strong> <br>
                        <small>$$ {{number_format($ano['transferencias'], '2', ',', '.')}}</small>
                    </p>
                    <p>
                        <strong>Consumo</strong> <br>
                        <small>$$ {{number_format($ano['consumo'], '2', ',', '.')}}</small>
                    </p>
                    <p>
                        <strong>PIB</strong> <br>
                        <small>$$ {{number_format($ano['pib'], '2', ',', '.')}}</small>
                    </p>
                </div>
                @php($i++)
            @endforeach
        </div>
    </div>
</div>
