<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('service')</label>
            <select class="form-select  mb-3 " v-model="filter.service_id" >
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
            <select class="form-select  mb-3 " v-model="filter.service_id" >
                <option value="">@trans('all')</option>
                <option value="new">@trans('new')</option> 
                <option value="renew">@trans('renew')</option> 
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
        <br>
        <button class="btn btn-primary">@trans('search')</button>
        <button class="btn btn-primary">@trans('clear')</button>
    </div>    
 

</div>
