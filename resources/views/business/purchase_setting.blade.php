
{!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'class' => 'form', 'id' => 'bussiness_edit_form', 'files' => true ]) !!}
<div class="modal-">
  <div class="text-center w3-padding">
    @trans('purchase.purchases')
  </div>

  <div class="w3-padding">
    @include('business.partials.settings_purchase') 
  </div>
  <div class="">
    <div class="text-center">
        <button 
        type="submit" 
        style="width: 200px"
        class="add_btn">@trans('business.update_settings')</button>
    </div>
    <button type="button" class="btn btn-default btn-sm hidden" data-dismiss="modal">
      Close
    </button>
  </div>
</div>
{!! Form::close() !!}

  @include("business.partials.settings_js")