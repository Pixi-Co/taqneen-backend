<br>
<div class="row">
	<div class="col-md-12">
	    <button type="button" class="btn btn-primary center-block more_btn w3-round-xlarge" data-target="#contact_person_div">@trans('crm::lang.add_contact_persons') <i class="fa fa-chevron-down"></i></button>
	</div>
</div>
<div id="contact_person_div" class="hide">
	@include('crm::contact_login.partial.contact_login_from', ['index' => 0])
	@include('crm::contact_login.partial.contact_login_from', ['index' => 1])
	@include('crm::contact_login.partial.contact_login_from', ['index' => 2])
</div>
