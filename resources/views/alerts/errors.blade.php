@php $response = session()->get('response'); @endphp
@if($response != null && $response['type'] == \App\Http\Controllers\Controller::TYPE_ERROR_RETURN)
    <div class="modal fade" id="errorsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="padding-top: 300px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$response['message']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if($response['error_code'] === \App\Support\Exceptions\ValidationException::CODE)
                <div class="modal-body">
                    <ul>
                        @foreach($response['errors'] as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#errorsModal').modal('show');
    </script>'
@endif


