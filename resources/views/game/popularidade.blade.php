<div class="card card-white grid-margin">
    <div class="card-heading clearfix">
        <h4 class="card-title">Popularidade</h4>
    </div>
    <div class="card-body popularidade">
        <div class="team">
            <table>
                <tr>
                    <td><span class="titulo">Empresarios:</span></td>
                    <td><span class="porcentagem">{{$ultimaRodada['popularidade_empresarios']}}%</span></td>
                </tr>
                <tr>
                    <td><span class="titulo">Trabalhadores:</span></td>
                    <td><span class="porcentagem">{{$ultimaRodada['popularidade_trabalhadores']}}%</span></td>
                </tr>
                <tr>
                    <td><span class="titulo">Estado:</span></td>
                    <td><span class="porcentagem">{{$ultimaRodada['popularidade_estado']}}%</span></td>
                </tr>
            </table>
        </div>
    </div>
</div>