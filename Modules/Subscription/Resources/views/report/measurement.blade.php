@extends("layouts.app")


@section("content")
<div class="w3-padding">
    <h3 class="text-capitalize" >
        @trans('measurement report')
    </h3>

    <div class="w3-block w3-white w3-round sb-shadow w3-padding">
        <div class="row">

            <div class="col-md-3 col-xs-4">
                <label for="">@trans('measurements')</label>
                <select name="" class="form-control" id="measurement_id">
                    <option value="">@trans('all')</option>
                    @foreach (Modules\Subscription\Entities\Measurement::active() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 col-xs-4">
                <label for="">@trans('members')</label>
                <select name="" class="form-control" id="member_id">
                    <option value="">@trans('all')</option>
                    @foreach (Modules\Subscription\Entities\Member::active() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
    
    <div id="chart_m_1" class="w3-round w3-padding w3-white" style="height: 250px"></div>
                            

    <div class="w3-block">
        <div class="table-responsive w3-light-gray">
            <table data-title="@trans('measurements')" class="table table-bordred table-striped" id="measurementTable" >
                <thead>
                    <th>@trans("member")</th> 
                    <th>@trans("measurement")</th> 
                    <th>@trans("date")</th> 
                    <th>@trans("result")</th> 
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
<script src="{{ url('/') }}/js/lib/chart-apex.js"></script>
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
<script> 
    //Roles table
    var measurementTable = {};
    measurementTable = $('#measurementTable').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: '/sub/report/measurement',
        @include("layouts.partials.datatable_plugin")
        "columns": [ 
            {
                "data": "member_id"
            }, 
            {
                "data": "measurement_id"
            }, 
            {
                "data": "date"
            }, 
            {
                "data": "result"
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
            member_id: $('#member_id').val(),
            measurement_id: $('#measurement_id').val(),
        };

        measurementTable.ajax.url('{{ url('/sub/report/measurement') }}' + "?" + $.param(data));
        measurementTable.ajax.reload();
    }
</script>

@include("subscription::user.profile_chart_js", ["id" => 1, "resource" => $resource, "title" => __('all measurements of members')])
@endsection
