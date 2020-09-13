<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Estilo Customizado -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilo.css')}}">
    <link rel="icon" type="imagem/png" href="{{asset('img/resources/icon-principal.png')}}" />
    <title>E-Conomy - Novo Jogo</title>

</head>
<body style="background-image: url('{{asset('img/resources/fundo.png')}}');">

<span class="text-center fixot img-responsive"><img src="{{asset('img/resources/fundo-02.png')}}"></span>

<header class="bg-light"> <!-- Inicio cabecalho -->
    <nav class="navbar navbar-expand-sm" style="height: 104px;">
        <div class="container">
            <a href="{{route('user.home')}}" class="navbar-brand">
                <img src="{{asset('img/resources/logo.png')}}" width="206" style="margin-top: 110px;" >
            </a>
            <button class="btn btn-block bg-botoes col-2 ml-auto p-2 text-menu" type="submit">SAIR</button>
        </div>
    </nav>
</header> <!-- Fim cabecalho -->


<div class="container"> <!-- Inicio CONTEUDO -->

    <div class="row justify-content-center mt-5"><!-- Titulo NOVO JOGO -->
        <div class= "col-8 mt-5">
            <h1 class="bg-titulo col-9 mx-auto mt-5 text-center p-2">PERFIL DO JOGO ATUAL</h1>
        </div>
    </div>

    <div class="form-row mb-4 justify-content-center">
        <div class="col-3">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem($jogo->personagem)}}" alt="Personagem F um">
            </div>
        </div>
        <div class="col-3">
            <div class="form-row mb-4">
                <label for="moeda"><p class="text-form01 mb-0">{{$jogo->genero == 'M' ? 'Ministro' : 'Ministra' }} da economia</p></label>
                <b class="form-control text-form02">{{$jogo->ministro}}</b>
            </div>
            <div class="form-row mb-4">
                <label for="moeda"><p class="text-form01 mb-0">País</p></label>
                <b class="form-control text-form02">{{$jogo->pais}}</b>
            </div>
            <div class="form-row mb-4">
                <label for="moeda"><p class="text-form01 mb-0">Presidente</p></label>
                <b class="form-control text-form02">{{$jogo->presidente}}</b>
            </div>
        </div>
    </div>

    <div class="form-row mb-4 justify-content-center">
        <div class="col-3">
            <div class="form-row mb-4">
                <label for="moeda"><p class="text-form01 mb-0">Economia</p></label>
                <b class="form-control text-form02">{{$jogo->descricao}}</b>
            </div>
        </div>
        <div class="col-3">
            <div class="form-row mb-4">
                <label for="moeda"><p class="text-form01 mb-0">Moeda</p></label>
                <b class="form-control text-form02">{{$jogo->moeda}}</b>
            </div>
        </div>
    </div>

    <div class="form-row mb-4 justify-content-center">
        <div class="col-3">
            <div class="form-row mb-4">
                <label for="moeda"><p class="text-form01 mb-0">Email cadastrado</p></label>
                <b class="form-control text-form02">{{$user->email}}</b>
            </div>
        </div>
        <div class="col-3">
            <div class="form-row mb-4">
                <label for="moeda"><p class="text-form01 mb-0">Senha</p></label>
                <b class="form-control text-form02">Segredo de estado</b>
            </div>
        </div>
    </div>
    <button class="btn btn-block bg-botoes col-4 mx-auto mt-4 mb-4 p-2 text-menu text-center" type="submit">Altear informações</button>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
