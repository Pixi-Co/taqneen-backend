<div class="row">
    <form action="/opportunities" id="filterOpportunities"  method="get">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">@trans('date')</label>
                    <input type="text" id="dob" class="form-control dateranger publish_date">
                </div>
            </div>
            @if (auth()->user()->isAdmin())
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">@trans('users')</label>
                    <select class="form-select select2" id="user_id" name="created_by">
                        <option selected >@trans('select_users')</option> 
                    </select>
{{--                    {!! Form::select("created_by", $users, request()->created_by, ["class" => "form-select"]) !!}--}}
                </div>
            </div>
            @endif
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">@trans('status')</label>
                    <select class="form-select" id="status" name="custom_field4">
                        <option selected disabled>@trans('select_status')</option>
                        @foreach($status as $key=>$myStatus)
                            <option value="{{$key}}">{{$myStatus}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
           
        </div>

        <div class="col-md-4 pb-5">
            <br>
            <button class="btn btn-primary" id="search" type="button">@trans('search')</button>
            <button class="btn btn-primary" id="reset" type="button">@trans('clear')</button>
        </div>

    </form>

</div>
