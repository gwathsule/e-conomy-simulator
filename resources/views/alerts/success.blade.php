@php $response = session()->get('response'); @endphp
@if($response != null && $response['type'] == \App\Http\Controllers\Controller::TYPE_SUCCESS_RETURN)
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{$response['message']}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#successModal').modal('show');
    </script>'
@endif
