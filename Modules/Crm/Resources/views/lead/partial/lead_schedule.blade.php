<div class="pull-right">
    <button type="button" class="btn btn-sm btn-primary btn-add-schedule pull-right">
        @trans('messages.add')&nbsp;
        <i class="fa fa-plus"></i>
    </button>
    <input type="hidden" name="schedule_create_url" id="schedule_create_url" value="{{action('\Modules\Crm\Http\Controllers\ScheduleController@create')}}?schedule_for=lead&contact_id={{$contact->id}}">
    <input type="hidden" name="lead_id" value="{{$contact->id}}" id="lead_id">
    <input type="hidden" name="view_type" value="lead_info" id="view_type">
</div> <br><br>
<div class="table-responsive">
	<table class="table table-bordered table-striped" id="lead_schedule_table" style="width: 100%">
        <thead>
            <tr>
                <th> @trans('messages.action')</th>
                <th>@trans('crm::lang.title')</th>
                <th>@trans('sale.status')</th>
                <th>@trans('crm::lang.schedule_type')</th>
                <th>@trans('crm::lang.start_datetime')</th>
                <th>@trans('crm::lang.end_datetime')</th>
                <th>@trans('lang_v1.assigned_to')</th>
            </tr>
        </thead>
    </table>
</div>