<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('UnitController@store'), 'method' => 'post', 'id' => $quick_add ? 'quick_add_unit_form' : 'unit_add_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@trans( 'unit.add_unit' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="form-group col-sm-12">
          {!! Form::label('actual_name', __( 'unit.name' ) . ':*') !!}
            {!! Form::text('actual_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'unit.name' )]); !!}
        </div>

        <div class="form-group col-sm-12">
          {!! Form::label('short_name', __( 'unit.short_name' ) . ':*') !!}
            {!! Form::text('short_name', null, ['class' => 'form-control', 'placeholder' => __( 'unit.short_name' ), 'required']); !!}
        </div>
        
        @php 
          $unitCodes = App\GlobalSetting::getUnitCodes();
          $listOfUnitCodes = [];
          foreach($unitCodes as $item) {
              $listOfUnitCodes[$item->code] = "(" . $item->code . ") " . (session('user.language') == 'ar'? $item->desc_ar : $item->desc_en);
          }
 
        @endphp     
        <div class="row " > 
            <div class="col-sm-12">
              <b>{{ __('unit code of einvoice') }}</b>
              @include("layouts.partials.tooltip", ["text" => __('List of unit types allowed as part of the invoice line information as part of the document submission.')])
                {!! Form::select('einvoice_unit_code', $listOfUnitCodes, '', ['class' => 'form-control select2 w3-light-gray']) !!}
            </div>
        </div>

        <div class="form-group col-sm-12">
          {!! Form::label('allow_decimal', __( 'unit.allow_decimal' ) . ':*') !!}
            {!! Form::select('allow_decimal', ['1' => __('messages.yes'), '0' => __('messages.no')], null, ['placeholder' => __( 'messages.please_select' ), 'required', 'class' => 'form-control']); !!}
        </div>
        @if(!$quick_add)
          <div class="form-group col-sm-12">
            <div class="form-group">
                <div class="checkbox">
                  <label>
                     {!! Form::checkbox('define_base_unit', 1, false,[ 'class' => 'toggler', 'data-toggle_id' => 'base_unit_div' ]); !!} @trans( 'lang_v1.add_as_multiple_of_base_unit' )
                  </label> @show_tooltip(__('lang_v1.multi_unit_help'))
                </div>
            </div>
          </div>
          <div class="form-group col-sm-12 hide" id="base_unit_div">
            <table class="table">
              <tr>
                <th style="vertical-align: middle;">1 <span id="unit_name">@trans('product.unit')</span></th>
                <th style="vertical-align: middle;">=</th>
                <td style="vertical-align: middle;">
                  {!! Form::text('base_unit_multiplier', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.times_base_unit' )]); !!}</td>
                <td style="vertical-align: middle;">
                  {!! Form::select('base_unit_id', $units, null, ['placeholder' => __( 'lang_v1.select_base_unit' ), 'class' => 'form-control']); !!}
                </td>
              </tr>
            </table>
          </div>
        @endif
      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@trans( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


<script>
  $('input[type=checkbox]').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
  $('.toggler').iCheck('ifToggled', function(){
    alert();
    if ($('.toggler').iCheck('check')) {
      $('#base_unit_div').slideDown();
    } else {
      $('#base_unit_div').slideUp();
    }
  }); 
</script>
