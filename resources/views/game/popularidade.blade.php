@php
function corPorcentagem(int $cor)
{
    if($cor < 10) return 'red';
    if($cor < 30) return 'yellow';
    if($cor > 70) return 'green';
    if($cor > 90) return 'blue';
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
                    <td><span style="color: {{corPorcentagem($ultimaRodada['popularidade_empresarios'])}}" class="porcentagem">{{$ultimaRodada['popularidade_empresarios']}}%</span></td>
                </tr>
                <tr>
                    <td><span class="titulo">Trabalhadores:</span></td>
                    <td><span style="color: {{corPorcentagem($ultimaRodada['popularidade_trabalhadores'])}}" class="porcentagem">{{$ultimaRodada['popularidade_trabalhadores']}}%</span></td>
                </tr>
                <tr>
                    <td><span class="titulo">Estado:</span></td>
                    <td><span style="color: {{corPorcentagem($ultimaRodada['popularidade_estado'])}}" class="porcentagem">{{$ultimaRodada['popularidade_estado']}}%</span></td>
                </tr>
            </table>
        </div>
    </div>
</div>