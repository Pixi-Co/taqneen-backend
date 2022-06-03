<div style="width: 200px">

    @can(find_or_create_p('subscription.edit'))
    @if ($row->is_expire != 1)
    <a target="_blank" href="{{ url('/subscriptions/') }}/{{ $row->id }}/edit"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-orange material-shadow">
        <i style="margin-top: 4px;" class="fa fa-edit"></i>
    </a>
    @endif
    @endcan
     
    <a target="_blank" href="{{ url('/subscriptions/') }}/{{ $row->id }}/edit"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-indigo material-shadow">
        <i style="margin-top: 4px;" class="fa fa-eye"></i>
    </a> 

    @can(find_or_create_p('subscription.view'))
    <a target="_blank" href="{{ url('/subscriptions/') }}/{{ $row->id }}"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-dark-gray material-shadow">
        <i style="margin-top: 4px;" class="fa fa-print"></i>
    </a>
    @endcan
 
    <a onclick="destroy('/subscriptions/{{ $row->id }}')" href="#"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-red material-shadow">
        <i style="margin-top: 4px;" class="fa fa-solid fa-trash"></i>
    </a> 

    @can(find_or_create_p('subscription.note'))
    <a onclick="addNote('{{ $row->id }}')" href="#"
        style="width: 25px!important;height: 25px!important;border-radius: 5em!important;padding: 4px!important"
        class="btn w3-white w3-text-teal material-shadow">
        <i style="margin-top: 4px;" class="fa fas fa-comment-o"></i>
    </a>
    @endcan
 
    @can(find_or_create_p('subscription.renew'))
    <a onclick="$('#subscriptionRenew{{ $row->id }}').modal('show')" href="#"
        style="width: auto!important;height: 25px!important;border-radius: 5px!important;padding: 4px!important"
        class="btn w3-deep-orange material-shadow">
        <i class="fa fa-refresh"></i> @trans('renew')
    </a>
    @endcan 
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

                        <div class="form-group">
                            <label class="my-2" for="inputName">@trans('pay date')</label>
                            {!! Form::datetimeLocal('pay_date', date('Y-m-d\TH:i', strtotime(optional($payment)->paid_on)), ['class' => 'form-control']) !!}
                        </div>

                        <div class="">
                            <label for="">@trans('payment method')</label>
                            {!! Form::select('method', $payment_methods, optional($row->payment)->method, ['class' => 'form-select']) !!}
                        </div>

                        <div class="">
                            <label for="">@trans('payment status')</label>
                            {!! Form::select('shipping_custom_field_2', $payment_status, $row->shipping_custom_field_2, ['class' => 'form-select']) !!}
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

        $('.modal-backdrop').remove();
    });
</script>
