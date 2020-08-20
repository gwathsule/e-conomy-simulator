<style>
    .my-custom-scrollbar {
        position: relative;
        height: 200px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
        display: block;
        height: 100%;
    }
</style>

<div class="col-xl-6 col-lg-5 mb-3">
    <div class="card">
        <div class="card-header">
            Eventos
        </div>
        <div class="card-body" style="height: 400px">
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-hover table-sm" id="eventos">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">PIB</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jogo->momentos as $momento)
                        <tr>
                            <th scope="row">{{$momento->rodada}}</th>
                            <td id="eventos_table_pib">{{$momento->pib}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
