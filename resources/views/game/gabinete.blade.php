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
</div>
