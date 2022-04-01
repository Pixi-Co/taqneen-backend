<div class="row">
    <form action="" method="get">

        <div class="col-md-4">
            <div class="form-group">
                <label for="">@trans('date')</label>
                <input type="text" class="form-control dateranger publish_date">
                <input type="hidden" name="publish_date_start">
                <input type="hidden" name="publish_date_end">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">@trans('users')</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">@trans('status')</label>
            </div>
        </div>

        <div class="col-md-4 pb-5">
            <br>
            <button class="btn btn-primary" onclick="setDate()" type="submit">@trans('search')</button>
            <button class="btn btn-primary" type="reset">@trans('clear')</button>
        </div>

    </form>

</div>