@php
function corPorcentagem(float $cor)
{
    if($cor < 0.1) return 'red';
    if($cor < 0.3) return 'yellow';
    if($cor > 0.7) return 'green';
    if($cor > 0.9) return 'blue';
    return 'black';
}
@endphp

<div class="card card-white grid-margin">
    <div class="card-heading clearfix">
        <h4 class="card-title">Popularidade</h4>
    </div>
    <div class="card-body popularidade">
        <div class="team">
            <table>
                <tr>
                    <td><span class="titulo">Empresarios:</span></td>
                    <td><span style="color: {{corPorcentagem($ultimaRodada['popularidade_empresarios'])}}" class="porcentagem">{{$ultimaRodada['popularidade_empresarios'] * 100}}%</span></td>
                </tr>
                <tr>
                    <td><span class="titulo">Trabalhadores:</span></td>
                    <td><span style="color: {{corPorcentagem($ultimaRodada['popularidade_trabalhadores'])}}" class="porcentagem">{{$ultimaRodada['popularidade_trabalhadores'] * 100}}%</span></td>
                </tr>
                <tr>
                    <td><span class="titulo">Estado:</span></td>
                    <td><span style="color: {{corPorcentagem($ultimaRodada['popularidade_estado'])}}" class="porcentagem">{{$ultimaRodada['popularidade_estado'] * 100}}%</span></td>
                </tr>
            </table>
        </div>
    </div>
</div>