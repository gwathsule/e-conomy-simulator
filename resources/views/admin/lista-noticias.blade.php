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
                <td id="eventos_table_pib">{{$news->newscast}}</td>
                <td id="eventos_table_inflacao"><a href="{{route('delete-news', ['id' => $news->id])}}" type="button" class="btn btn-light">Excluir</a></td>
                <td id="eventos_table_desemprego"><button type="button" class="btn btn-light">Adicionar Regra</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
