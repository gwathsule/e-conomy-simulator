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

    <title>E-Conomy - Login</title>

</head>
<body style="background-image: url('{{asset('img/resources/fundo.png')}}');">

<div class="container">
    <div class="row justify-content-center mt-5 ">
        <img src="{{asset('img/resources/logo.png')}}" width="258">
    </div>
    <div class="row justify-content-center mt-5">
        <div class= "col-8 bg-caixas ">
            <h1 class="bg-botoes col-9 mx-auto mt-4 text-center p-2">BEM VINDO!</h1>

            <form class="text-center p-3" method="post" action="{{route('login')}}"> <!-- Inicio FORM -->
                @csrf
                <label for="LoginFormEmail"><p class="text-form01">LOGIN</p></label>
                <input type="email" name="email" id="LoginFormEmail" class="form-control mb-4 col-8 mx-auto text-center text-form02" placeholder="Entre com o e-mail cadastrado" value="{{ old('email') }}">

                <label for="LoginFormPassword"><p class="text-form01">SENHA</p></label>
                <input type="password" name="password" id="LoginFormPassword" class="form-control mb-4 col-8 mx-auto text-center text-form02" placeholder="********">

                <div class="d-flex justify-content-between col-8 mx-auto ">
                    <div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="LoginFormRemember">
                            <label class="custom-control-label" for="LoginFormRemember">Mantenha-me conectado</label>
                        </div>
                    </div>
                    {{--
                    <div>
                        <a  href="">Esqueceu a senha?</a>
                    </div>
                    --}}
                </div>

                <button class="btn btn-block bg-botoes col-6 mx-auto mt-4 mb-4 p-2 text-menu text-center " type="submit">LOGIN</button>

                <a href="{{route('register')}}">Crie uma conta!</a>
            </form><!-- Fim FORM -->
        </div>
    </div>
</div>

{{-- <footer class="page-footer font-small bg-white mt-5 fixob"> <!-- Inicio Footer -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href=""> E-Conomy Simulator</a>
    </div>
</footer> <!-- Fim Footer -->--}}

<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
{{--
@if(isset($errors) && count($errors) > 0)
    <div class="modal fade" id="errorsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Login inválido
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#errorsModal').modal('show');
    </script>'
@endif
--}}
</body>
</html>