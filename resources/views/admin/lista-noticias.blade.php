<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table class="table table-hover table-sm" id="eventos">
        <thead>
        <tr>
            <th scope="col" style="width: 40%">Título</th>
            <th scope="col" style="width: 40%">Jornal</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($listNews as $news)
            <tr>
                <th scope="row">{{$news->title}}</th>
                <td>{{$news->newscast}}</td>
                <td><a href="{{route('delete-news', ['id' => $news->id])}}" type="button" class="btn btn-light">Excluir</a></td>
                <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#add_regra_{{$news->id}}">Adicionar Regra</button></td>
            </tr>
        @endforeach
        @foreach($listNews as $news)
            <div class="modal fade" id="add_regra_{{$news->id}}" tabindex="-1" role="dialog" aria-labelledby="add_regra_{{$news->id}}_label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="{{route('create-news-rule')}}">
                            @csrf
                            <input type="hidden" name="news_id" value="{{$news->id}}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add_regra_{{$news->id}}_label">Crie ou altere a regra</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="form-row col-md-12 pb-3" style="text-align: center">
                                        @php
                                        if(is_null($news->indicator_rule))
                                            $description = 'não exsitente';
                                        else
                                            $description = $news->indicator_rule->description();
                                        @endphp
                                        Regra Atual: {{$description}}
                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                Exibir notícia se:
                                            </div>
                                            <div class="form-group col-md-12">
                                                <select name="indicator" class="form-control form-control">
                                                    @foreach($indicators as $code => $indicator)
                                                        <option value="{{$code}}">{{$indicator}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                FOR
                                            </div>
                                            <div class="form-group col-md-5">
                                                <select name="condition" class="form-control form-control">
                                                    @foreach($ruleConditions as $condition)
                                                        <option value="{{$condition}}">{{$condition}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="number" class="form-control" min="0" name="value" value="{{old('value')}}" id="inputValor">
                                            </div>
                                            <div class="form-group col-md-1">
                                                %
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Criar Regra</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>
