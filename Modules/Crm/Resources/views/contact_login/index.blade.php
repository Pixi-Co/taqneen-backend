<a class="btn btn-sm btn-primary pull-right contact-login-add" data-href="{{action('\Modules\Crm\Http\Controllers\ContactLoginController@create')}}" >
	<i class="fa fa-plus"></i>
	@trans( 'messages.add' )
</a>
<br><br>
<div class="table-responsive">
	<table class="table table-bordered table-striped" id="contact_login_table" style="width: 100%;">
		<thead>
			<tr>
				<th>@trans('messages.action')</th>
				<th>@trans('business.username')</th>
                <th>@trans('user.name')</th>
                <th>@trans( 'business.email' )</th>
			</tr>
		</thead>
	</table>
</div>
<!-- modal -->
<div class="modal fade contact_login_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>