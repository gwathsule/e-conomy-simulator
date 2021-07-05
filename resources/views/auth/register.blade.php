@extends('layouts.app')
@section('title') Registro @endsection
@section('css_adicionais')
    <style>
        .container-economy{
            margin-top: 5%;
        }
    </style>
@endsection
@section('conteudo')
    <div class="modal-header justify-content-center">
        <h2 class="text-center"><br>Registrar</h2>
    </div>
    <div class="modal-body">
        <form class="form col-md-12 center-block" method="post" action="{{route('register')}}" >
            @csrf
            <div class="form-row mb-4 justify-content-center">
                <div class="col-6">
                    <label for="name"><p class="text-form01 mb-0">NOME</p></label>
                    <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control text-form02" placeholder="Pode ser um nome fíctício">
                </div>
                <div class="col-6">
                    <label for="email"><p class="text-form01 mb-0">EMAIL</p></label>
                    <input type="text" name="email" value="{{old('email')}}" id="email" class="form-control text-form02" placeholder="Pode ser fictício, não há verificação">
                </div>
            </div>

            <div class="form-row mb-4 justify-content-center">
                <div class="col-6">
                    <label for="password"><p class="text-form01 mb-0">SENHA</p></label>
                    <input type="password" name="password" value="{{old('password')}}" id="password" class="form-control text-form02" placeholder="Pode ser uma fácil (a conta será deletada em breve)">
                </div>
                <div class="col-6">
                    <label for="password_confirmation"><p class="text-form01 mb-0">REPETIR SENHA</p></label>
                    <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" id="password_confirmation" class="form-control text-form02" placeholder="Repita a senha!">
                </div>
            </div>
            <div class="form-row mb-6 justify-content-center">
                <button class="btn btn-primary btn-lg btn-block text-menu text-center col-6" type="submit">PRONTO!</button>
            </div>

            <div class="modal-footer">
                <span class="pull-right"><a href="{{route('login')}}">Já possui uma conta? Faça o login!</a></span>
            </div>
        </form>
    </div>
@endsection