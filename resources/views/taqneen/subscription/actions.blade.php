<div style="width: 200px">

    <a target="_blank" href="{{ url('/subscriptions/') }}/{{ $row->id }}/edit"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-orange material-shadow">
        <i style="margin-top: 4px;" class="fa fa-edit"></i>
    </a>

    <!--
    <a onclick="destroy('/subscriptions/{{ $row->id }}')" href="#"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-red material-shadow">
        <i style="margin-top: 4px;" class="fa fa-solid fa-trash"></i>
    </a>
-->

    <a onclick="addNote('{{ $row->id }}')" href="#"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-teal material-shadow">
        <i style="margin-top: 4px;" class="fa fas fa-comment-o"></i>
    </a>

    @if ($row->is_renew != 1)
    <a onclick="$('#subscriptionRenew{{ $row->id }}').modal('show')" href="#"
        style="width: auto!important;height: 25px!important;border-radius: 5px!important;padding: 4px!important"
        class="btn w3-deep-orange material-shadow">
        <i class="fa fa-refresh"></i> @trans('renew')
    </a>
    @endif
</div>



{{-- add new notes --}}
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

{{-- renew subscription --}}
<div class="modal" id="subscriptionRenew{{ $row->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@trans('renew subscriptions')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" class="form" action="/subscriptions/renew/{{ $row->id }}">
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <div class="">
                            <label for="">@trans('payment method')</label>
                            {!! Form::select('method', $payment_methods, optional($row->payment)->method, ['class' => 'form-select']) !!}
                        </div>

                        <div class="form-group">
                            <label class="my-2" for="inputName">@trans('photo of transform')</label>
                            {!! Form::file('custom_field_3', ['class' => 'form-control']) !!}
                            @if ($row->transform_photo_url)
                                <img src="{{ $row->transform_photo_url }}" width="100px" alt="">
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="my-2" for="inputName">@trans('number of transform')</label>
                            {!! Form::text('custom_field_4', $row->custom_field_4, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@trans('renew')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    formAjax(true, function(){
        subscriptionTable.ajax.reload();
    });
</script>
