<div class="card-heading clearfix">
    <h4 class="card-title">{{$jogo->ministro}}</h4>
</div>
<div class="card-body user-profile-card mb-3">
    <div class="row">
        <div class="col-xl-12" >
            <img src="{{$jogo->getImagemPersonagem()}}" class="user-profile-image" alt="" />
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12" >
            <a href="{{route('relatorios-anuais')}}" target="_blank" class="btn btn-primary btn-sm btn-block">
                Relatórios Anuais
            </a>
            <a href="{{route('relatorios-mensais')}}" target="_blank" class="btn btn-primary btn-sm btn-block">
                Relatórios Mensais
            </a>
            <a href="{{route('novo-jogo')}}" class="btn btn-primary btn-sm btn-block">
                Novo Jogo
            </a>
            <a href="{{url('logout')}}" class="btn btn-secondary btn-sm btn-block">
                Logout
            </a>
        </div>
    </div>
</div>
