<div style="width: 200px">

    <a target="_blank" href="{{ url('/subscriptions/') }}/{{ $row->id }}/edit"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-orange material-shadow">
        <i style="margin-top: 4px;" class="fa fa-edit"></i>
    </a>

    <a onclick="destroy('/subscriptions/{{ $row->id }}')" href="#"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-red material-shadow">
        <i style="margin-top: 4px;" class="fa fa-solid fa-trash"></i>
    </a>

    <a onclick="addNote('{{ $row->id }}')" href="#"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-teal material-shadow">
        <i style="margin-top: 4px;" class="fa fas fa-comment-o"></i>
    </a>
</div>



{{-- pop up add new customer --}}
<div class="modal" id="subscriptionNote{{ $row->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@trans('add notes')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" class="form" action="/subscriptions/add-note/{{ $row->id }}">
                <div class="modal-body">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">@trans('add notes')</label>
                            <textarea name="notes" class="form-control" cols="30" rows="10"></textarea>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@trans('submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    formAjax();
</script>
