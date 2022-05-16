<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('service')</label>
            <select class="form-select  mb-3 service_id"  >
                <option value="">@trans('all')</option>
                @foreach ($services as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('subscription type')</label>
            <select class="form-select  mb-3 subscription_type"  >
                <option value="">@trans('all')</option>
                <option value="new">@trans('new')</option> 
                <option value="renew">@trans('renew')</option> 
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('sales_commission')</label>
            {!! Form::select("user_id", $users, null, ["class" => "form-select user_id"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('payment status')</label>
            <select class="form-select  mb-3 payment_status"  >
                <option value="">@trans('all')</option>
                <option value="paid">@trans('paid')</option> 
                <option value="not_paid">@trans('not_paid')</option> 
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('subscription date')</label>
            <input type="text"  class="form-control dateranger transaction_date"  >
        </div>
    </div> 
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('expire date')</label>
            <input type="text"  class="form-control dateranger expire_date"  >
        </div>
    </div>  
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('payment date')</label>
            <input type="text"  class="form-control dateranger payment_date"  >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('register date')</label>
            <input type="text"  class="form-control dateranger register_date"  >
        </div>
    </div> 
    <div class="col-md-4">
        <br>
        <button class="btn btn-primary" onclick="filter()" >@trans('search')</button>
        <button class="btn btn-primary" onclick="clearSearch()">@trans('clear')</button>
    </div>    
 

</div>
