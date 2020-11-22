@extends('layouts.app')

@section('title', 'Administrador')

@section('content')
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome da medida</label>
                <input type="text" class="form-control" id="nome">
            </div>
            <div class="form-group col-md-6">
                <label for="rodadas_para_excutar">Rodadas para executar</label>
                <input type="number" class="form-control" id="rodadas_para_excutar">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Check me out
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
@endsection
