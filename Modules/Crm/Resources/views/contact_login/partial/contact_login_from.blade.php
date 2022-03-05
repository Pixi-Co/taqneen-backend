@php
	$index = isset($index) ? (int) $index : '';
@endphp
<div class="row">
	<div class="col-md-12">
		<hr>
		<button type="button" class="btn btn-primary more_btn w3-round-xlarge" data-target="#add_contact_person_div_{{$index}}">@trans('crm::lang.add_contact_person') {{ $index + 1 }} <i class="fa fa-chevron-down"></i></button>
	</div>
</div>
<br>

<div class="col-md-12 w3-padding @if($index !== 0)hide @endif" id="add_contact_person_div_{{$index}}">
	{!! Form::hidden($index === '' ? 'surname' : "contact_persons[$index][surname]", null, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ), 'id' => "surname$index" ]); !!}


	<div class="row" style="margin-bottom: 5px">
		<div class="col-md-4">
			<b>{{ __( 'name' ) }} *</b>
		</div>
		<div class="col-md-4">
			{!! Form::text($index === '' ? 'first_name' : "contact_persons[$index][first_name]", null, ['class' => 'form-control w3-light-gray', 'required', 'placeholder' => __( 'business.first_name' ), 'id' => "first_name$index" ]); !!}
		</div>
		<div class="col-md-4">
			{!! Form::text($index === '' ? 'last_name' : "contact_persons[$index][last_name]", null, ['class' => 'form-control w3-light-gray', 'placeholder' => __( 'business.last_name' ), 'id' => "last_name$index" ]); !!}
		</div>
	</div>

	<div class="row" style="margin-bottom: 5px">
		<div class="col-md-4">
			<b>{{ __( 'lang_v1.mobile_number' ) }}</b>
		</div>
		<div class="col-md-8">
		    {!! Form::text($index === '' ? 'contact_number' : "contact_persons[$index][contact_number]", !empty($user->contact_number) ? $user->contact_number : null, ['class' => 'form-control w3-light-gray', 'placeholder' => __( 'lang_v1.mobile_number'), 'id'=>"contact_number$index" ]); !!}
		</div>
	</div>

	<div class="row" style="margin-bottom: 5px">
		<div class="col-md-4">
			<b>{{ __( 'business.email' ) }}</b>
		</div>
		<div class="col-md-8">
			{!! Form::text($index ==='' ? 'email' : "contact_persons[$index][email]", null, ['class' => 'w3-light-gray form-control', 'placeholder' => __( 'business.email' ), 'id' => "email$index" ]); !!}
		</div>
	</div>

	<div class="row" style="margin-bottom: 5px">
		<div class="col-md-4">
			<b>{{ __( 'business.alternate_number' ) }}</b>
		</div>
		<div class="col-md-8">
		    {!! Form::text($index === '' ? 'alt_number' : "contact_persons[$index][alt_number]", !empty($user->alt_number) ? $user->alt_number : null, ['class' => 'form-control w3-light-gray', 'placeholder' => __( 'business.alternate_number'), 'id'=>"alt_number$index" ]); !!}
		</div>
	</div>

	<div class="row" style="margin-bottom: 5px">
		<div class="col-md-4">
			<b>{{ __( 'lang_v1.family_contact_number' ) }}</b>
		</div>
		<div class="col-md-8">
		    {!! Form::text($index === '' ? 'family_number' : "contact_persons[$index][family_number]", !empty($user->family_number) ? $user->family_number : null, ['class' => 'form-control w3-light-gray', 'placeholder' => __( 'lang_v1.family_contact_number'), 'id'=>"family_number$index" ]); !!}
		</div>
	</div>

	<div class="row" style="margin-bottom: 5px">
		<div class="col-md-4">
			<b>{{ __( 'lang_v1.allow_login' ) }}</b>
		</div>
		<div class="col-md-8">
			<div class="checkbox">
				<label>
				  {!! Form::checkbox($index === '' ? 'allow_login' : "contact_persons[$index][allow_login]", 1, false,  [ 'class' => 'input-icheck allow_login', "data-loginDiv" => "loginDiv$index"]); !!} 
				</label>
			  </div>		
		</div>
	</div>


	<div class="row hide" id="loginDiv{{$index}}">
	
		<div class="row" style="margin-bottom: 5px">
			<div class="col-md-4">
				<b>{{ __( 'business.username' ) }}</b>
			</div>
			<div class="col-md-8">
				{!! Form::text($index ==='' ? 'username' : "contact_persons[$index][username]", null, ['class' => 'w3-light-gray form-control', 'placeholder' => __( 'business.username' ), 'required', 'id'=>"username$index"]); !!}
			</div>
		</div> 
	
		<div class="row" style="margin-bottom: 5px">
			<div class="col-md-4">
				<b>{{ __( 'business.password' ) }}</b>
			</div>
			<div class="col-md-8">
				{!! Form::password($index === '' ? 'password' : "contact_persons[$index][password]", ['class' => 'w3-light-gray form-control', 'required', 'placeholder' => __( 'business.password' ), 'id'=>"password$index" ]); !!}
			</div>
		</div> 
		
		<div class="row" style="margin-bottom: 5px">
			<div class="col-md-4">
				<b>{{ __( 'business.confirm_password' ) }}</b>
			</div>
			<div class="col-md-8">
				{!! Form::password($index === '' ? 'confirm_password' : "contact_persons[$index][confirm_password]", ['class' => 'form-control w3-light-gray', 'required', 'placeholder' => __( 'business.confirm_password' ), 'id' => "confirm_password$index", 'data-rule-equalTo' => "#password$index" ]); !!}
			</div>
		</div>    
		
		<div class="row" style="margin-bottom: 5px">
			<div class="col-md-4">
				<b>{{ __('lang_v1.status_for_user') }}</b> @show_tooltip(__('lang_v1.tooltip_enable_user_active'))
			</div>
			<div class="col-md-8">
				<label>
					{!! Form::checkbox($index === '' ? 'is_active' : "contact_persons[$index][is_active]", 'active', true, ['class' => 'input-icheck status']); !!} 
				</label>
			</div>
		</div>  
	</div>

</div>
 
