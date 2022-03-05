@extends("layouts.app")


@section("content")
<div class="w3-padding">
    <h3 class="text-capitalize" >
        @trans('trainer percents report')
    </h3>

    <div class="w3-block w3-white w3-round sb-shadow w3-padding">
        <div class="row">

            <div class="col-md-3 col-xs-4">
                <label for="">@trans('trainers')</label>
                <select name="" class="form-control" id="trainer_id">
                    <option value="">@trans('all')</option>
                    @foreach (Modules\Subscription\Entities\Trainer::active() as $item)
                        <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 col-xs-4 hidden">
                <label for="">@trans('sessions')</label>
                <select name="" class="form-control" id="class_type_id">
                    <option value="">@trans('all')</option>
                    @foreach (Modules\Subscription\Entities\ClassType::active() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-3 col-xs-4">
                <div class="form-group ">
                    <br>
                    <div class="input-">
                        <input type="hidden" name="start_date" class="start_date">
                        <input type="hidden" name="end_date" class="end_date">
                      <button type="button" class="btn btn-primary" id="profit_loss_date_filter">
                        <span>
                          <i class="fa fa-calendar"></i> {{ __('messages.filter_by_date') }}
                        </span>
                        <i class="fa fa-caret-down"></i>
                      </button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <br>
                <button class="btn w3-green" onclick="filter()" >@trans("search")</button>
            </div>

        </div>
    </div>
    <br>

    <div class="w3-block">
        <div class="table-responsive w3-light-gray">
            <table data-title="@trans('trainers')" class="table table-bordred table-striped" id="trainerTable" >
                <thead> 
                    <th>@trans("full_name")</th> 
                    <th>@trans("member_count")</th>
                    <th>@trans("session_count")</th>
                    <th>@trans("session_names")</th>
                    <th>@trans("class_type")</th>
                    <th>@trans("salary")</th>
                    <th>@trans("profit_percent")</th>
                    <th>@trans("subscription_count")</th>
                    <th>@trans("subscription_percent")</th>
                    <th>@trans("created_at")</th> 
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="modal fade qrcode-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Qrcode Viewer</h4>
        </div>
        <div class="modal-body-custom">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">@trans('Close')</button> 
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

@endsection

@section("javascript")
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
<script> 
    //Roles table
    var attandanceTable = {};
    attandanceTable = $('#trainerTable').DataTable({
        processing: true,
        serverSide: true, 
        ajax: '/sub/report/trainer-percents',
        @include("layouts.partials.datatable_plugin")    
        "columns": [ 
            {
                "data": "first_name"
            },  
            {
                "data": "member_count"
            }, 
            {
                "data": "session_count"
            }, 
            {
                "data": "session_names"
            }, 
            {
                "data": "class_type_ids"
            }, 
            {
                "data": "salary"
            }, 
            {
                "data": "profit_percent"
            }, 
            {
                "data": "subscription_count"
            }, 
            {
                "data": "subscription_percent"
            }, 
            {
                "data": "created_at"
            }, 
        ],
        "drawCallback": function( settings ) {
            loadQrcode();
        }
    });  

    function viewQrcode(text) {
        $('.modal-body-custom').html("<div class='qrcode' data-text='"+text+"' style='margin: auto;width: 400px' data-width='400' data-height='400' ></div>");
        loadQrcode();
        $('.qrcode-modal').modal('show');
    }


    function filter() {
        var data = {
            start_date: $('.start_date').val(),
            end_date: $('.end_date').val(),
            session_id: $('#session_id').val(),
            trainer_id: $('#trainer_id').val(),
        };

        attandanceTable.ajax.url('{{ url('/sub/report/trainer') }}' + "?" + $.param(data));
        attandanceTable.ajax.reload();
    }
</script>
@endsection
