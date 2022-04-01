<div class="row">
    
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('date')</label>
            <input type="text"  class="form-control dateranger transaction_date"  >
        </div>
    </div> 
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('users')</label>
            <input type="text"  class="form-control dateranger expire_date"  >
        </div>
    </div>  
    <div class="col-md-4">
        <div class="form-group">
            <label for="">@trans('status')</label>
            <input type="text"  class="form-control dateranger payment_date"  >
        </div>
    </div>
    
    <div class="col-md-4 pb-5">
        <br>
        <button class="btn btn-primary" onclick="filter()" >@trans('search')</button>
        <button class="btn btn-primary" onclick="clearSearch()">@trans('clear')</button>
    </div>    
 

</div>
