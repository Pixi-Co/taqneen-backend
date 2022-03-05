@extends("layouts.app")


@section("content")
<div class="w3-padding">
    <h3 class="text-capitalize" >
        @trans('rate report')
    </h3>

    <div class="w3-block w3-white w3-round sb-shadow w3-padding">
        <div class="row">

            <div class="col-md-3 col-xs-4">
                <label for="">@trans('rates Objects')</label>
                <select name="" class="form-control" id="rate_id">
                    <option value="">@trans('all')</option>
                    @foreach (Modules\Subscription\Entities\Rate::active()->get() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 col-xs-4">
                <label for="">@trans('users')</label>
                <select name="" class="form-control" id="user_id"> 
                    @foreach (App\User::forDropdown(null) as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 col-xs-4">
                <label for="">@trans('rate')</label>
                <div class="w3-block" id="rater" ></div>
            </div>
            
            <div class="col-md-3 col-xs-4 hidden">
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
                <button class="btn btn-default" onclick="clearSearch()" >@trans("clear")</button>
            </div>

        </div>
    </div>
    <br>

    <div class="w3-block">
        <div class="table-responsive w3-light-gray">
            <table data-title="@trans('rates')" class="table table-bordred table-striped" id="rateTable" >
                <thead>
                    <th>@trans("rate object")</th>
                    <th>@trans("ip")</th>
                    <th>@trans("user")</th>
                    <th>@trans("rate")</th>
                    <th>@trans("comment")</th>  
                    <th>@trans("created at")</th>  
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
<script src="{{ asset('js/rate.js') }}"></script>
<script>
    var rater = new Ratebar(document.getElementById('rater'));

    //Roles table
    var rateTable = {};
    rateTable = $('#rateTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/sub/report/rate',
        @include("layouts.partials.datatable_plugin")
        "columns": [
            {
                "data": "rate_id"
            },
            {
                "data": "ip"
            },
            {
                "data": "user_id"
            }, 
            {
                "data": "rate"
            }, 
            {
                "data": "comment"
            }, 
            {
                "data": "created_at"
            }, 
        ]
    });  
 
    function clearSearch() {
        rater.rate(0); 
        $('#rate_id').val('');
        filter();
    }

    function filter() {
        var data = {
            start_date: $('.start_date').val(),
            end_date: $('.end_date').val(),
            rate_id: $('#rate_id').val(),
            user_id: $('#user_id').val(),
            rate: rater.value,
        };

        rateTable.ajax.url('{{ url('/sub/report/rate') }}' + "?" + $.param(data));
        rateTable.ajax.reload();
    }
</script>
@endsection
