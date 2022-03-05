@extends("layouts.app")


@section("content")
<div class="w3-padding">
    <h3 class="text-capitalize" >
        @trans('attendance report')
    </h3>

    <div class="w3-block w3-white w3-round sb-shadow w3-padding">
        <div class="row">

            <div class="col-md-3 col-xs-4">
                <label for="">@trans('members')</label>
                <select name="" class="form-control" id="member_id">
                    <option value="">@trans('all')</option>
                    @foreach (Modules\Subscription\Entities\Member::active() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 col-xs-4">
                <label for="">@trans('sessions')</label>
                <select name="" class="form-control" id="session_id">
                    <option value="">@trans('all')</option>
                    @foreach (Modules\Subscription\Entities\Session::active() as $item)
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
            <table data-title="@trans('attendances')" class="table table-bordred table-striped" id="attandanceTable" >
                <thead>
                    <th>@trans("member")</th>
                    <th>@trans("session")</th>
                    <th>@trans("date")</th>
                    <th>@trans("time")</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

@section("javascript")
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
<script>

    //Roles table
    var attandanceTable = {};
    attandanceTable = $('#attandanceTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/sub/report/attendance',
        @include("layouts.partials.datatable_plugin")
        "columns": [
            {
                "data": "member_id"
            },
            {
                "data": "session_id"
            }, 
            {
                "data": "date"
            }, 
            {
                "data": "created_at"
            }, 
        ]
    });  


    function filter() {
        var data = {
            start_date: $('.start_date').val(),
            end_date: $('.end_date').val(),
            session_id: $('#session_id').val(),
            member_id: $('#member_id').val(),
        };

        attandanceTable.ajax.url('{{ url('/sub/report/attendance') }}' + "?" + $.param(data));
        attandanceTable.ajax.reload();
    }
</script>
@endsection
