@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.communicator'))

@section('content')
@include('superadmin::layouts.nav')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans('superadmin::lang.communicator')</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
				<div class="box-header">
					<i class="fa fa-edit"></i>
					<h3 class="box-title">@trans('superadmin::lang.compose_message')</h3>
				</div>
		        <div class="box-body">
		        	{!! Form::open(['url' => action('\Modules\Superadmin\Http\Controllers\CommunicatorController@send'), 'method' => 'post', 'id' => 'communication_form']) !!}
		        		<div class="col-md-12 form-group">
		        			{!! Form::label('recipients', __('superadmin::lang.recipients').':*') !!} <button type="button" class="btn btn-primary btn-xs select-all">@trans('lang_v1.select_all')</button> <button type="button" class="btn btn-primary btn-xs deselect-all">@trans('lang_v1.deselect_all')</button>
							{!! Form::select('recipients[]', $businesses, null, ['class' => 'form-control select2', 'required', 'multiple', 'id' => 'recipients']); !!}
		        		</div>
		        		<div class="col-md-12 form-group">
		        			{!! Form::label('subject', __('superadmin::lang.subject').':*') !!}
		        			{!! Form::text('subject', null, ['class' => 'form-control', 'required']); !!}
		        		</div>
		        		<div class="col-md-12 form-group">
		        			{!! Form::label('message', __('superadmin::lang.message').':*') !!}
		        			{!! Form::textarea('message', null, ['class' => 'form-control', 'required', 'rows' => 6]); !!}
		        		</div>
		        		<div class="col-md-12 form-group">
		        			<button type="submit" class="btn btn-danger pull-right" id="send_message">@trans('superadmin::lang.send')</button>
		        		</div>
		        	{!! Form::close() !!}
		        </div>
		    </div>
		</div>
		<div class="col-sm-12">
			<div class="material-shadow w3-round w3-white"> 
		        <div class="box-body w3-light-gray">
		        	<table data-title="@trans('superadmin::lang.message_history')" class="table" id="message-history">
		        		<thead>
		        			<tr>
		        				<th>@trans('superadmin::lang.subject')</th>
		        				<th>@trans('superadmin::lang.message')</th>
		        				<th>@trans('lang_v1.date')</th>
		        			</tr>
		        		</thead>
		        	</table>
		        </div>
		     </div>
		</div>

	</div>
</section>
<!-- /.content -->
@stop
@section('javascript')

<script type="text/javascript">
	$(document).ready( function() {
		$('#send_message').click(function(e){
			e.preventDefault();
			if($('form#communication_form').valid()){
				swal({
	              title: LANG.sure,
	              icon: "warning",
	              buttons: true,
	              dangerMode: false,
	            }).then((sure) => {
	            	if(sure){
	            		$('form#communication_form').submit();
	            	} else {
	            		return false;
	            	}
	            });
	        }
		});

		$('#message-history').DataTable({
			dom:'lfrtip',
			processing: true,
			@include("layouts.partials.datatable_plugin")
			serverSide: true,
			ajax: '{{action("\Modules\Superadmin\Http\Controllers\CommunicatorController@getHistory")}}'
	    });

	    init_tinymce('message');
	});
</script>
@endsection
