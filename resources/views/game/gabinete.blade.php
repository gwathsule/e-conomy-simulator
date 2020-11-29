<div class="col-lg-5 col-xl-3">
    <div class="card card-white grid-margin">
        <div class="card-heading clearfix">
            <h4 class="card-title">Gabinete</h4>
        </div>
        <div class="card-body user-profile-card mb-3">
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="user-profile-image rounded-circle" alt="" />
            <h4 class="text-center h6 mt-2">{{$jogo->ministro}}</h4>
            <a href="{{url('logout')}}"><button class="btn btn-theme btn-sm">Logout</button></a>
            <a href="{{route('novo-jogo')}}"><button class="btn btn-theme btn-sm">Novo Mandato</button></a>
        </div>
        <hr />
        <div class="card-body">
            <div class="table-responsive">
                <p><strong>PIB</strong>: <small>R$ 1.000.000,00</small></p>
                <p><strong>INV.</strong>: <small>R$ 1.000.000,00</small></p>
            </div>
        </div>
    </div>
</div>
