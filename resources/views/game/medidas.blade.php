<div class="ol-xl-12 col-lg-12 mb-3">
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#monetarias" role="tab" aria-controls="monetarias" aria-selected="true">Monetárias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#fiscais" role="tab" aria-controls="fiscais" aria-selected="false">Fiscais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#cambiais" role="tab" aria-controls="cambiais" aria-selected="false" >Cambiais</a>
                </li>
            </ul>
        </div>
        <div class="card-body" style="height: 300px">
            <div class="tab-content mt-3">
                <div class="tab-pane active" id="monetarias" role="tabpanel" aria-labelledby="monetarias-tab">
                    <!-- Recolhimento compulsório -->
                    <a href="" data-toggle="modal" data-target="#rec_compulsorio">
                        <div class="card" style="width: 10rem; align-items: center">
                            <img src="{{asset('img/medidas/deposito_compulsorio.jpg')}}" class="card-img-top" style="height: 100px; width: 100px" alt="...">
                            <div class="card-body">
                                <p class="card-text">Recolhimento compulsório</p>
                            </div>
                        </div>
                    </a>

                    <div class="modal fade" id="rec_compulsorio" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="#">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rec_compulsorioLabel">Insira um valor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group col-md-12">
                                            <input type="number" class="form-control" name="valor" value="{{old('valor')}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Efetuar medida</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="fiscais" role="tabpanel" aria-labelledby="fiscais-tab">
                    politicas fiscais
                </div>

                <div class="tab-pane" id="cambiais" role="tabpanel" aria-labelledby="cambiais-tab">
                    politicas cambiais
                </div>
            </div>
        </div>
    </div>
</div>

