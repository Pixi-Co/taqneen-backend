<div class="modal-dialog ">
  
{!! Form::open(['url' => action('BarcodeController@update', [$barcode->id]), 'method' => 'PUT', 'id' => 'edit_barcode_settings_form' ]) !!}

  <div class="modal-content">
      <div class="modal-header dir_rtl">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">
              {{ __('barcode.edit_barcode_setting') }}
          </h4>
      </div>

      <div class="modal-body">
        <div class="">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                {!! Form::label('name', __('barcode.setting_name') . ':*') !!}
                  {!! Form::text('name', $barcode->name, ['class' => 'form-control', 'required',
                  'placeholder' => __('barcode.setting_name')]); !!}
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                {!! Form::label('description', __('barcode.setting_description') ) !!}
                  {!! Form::textarea('description', $barcode->description, ['class' => 'form-control',
                  'placeholder' => __('barcode.setting_description'), 'rows' => 3]); !!}
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    {!! Form::checkbox('is_continuous', 1, $barcode->is_continuous, ['id' => 'is_continuous']); !!} @trans('barcode.is_continuous')</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('top_margin', __('barcode.top_margin') . ' ('. __('barcode.in_in') . '):*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
                  </span>
                  {!! Form::number('top_margin', $barcode->top_margin, ['class' => 'form-control',
                  'placeholder' => __('barcode.top_margin'), 'min' => 0, 'step' => 0.01, 'required']); !!}
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('left_margin', __('barcode.left_margin') . ' ('. __('barcode.in_in') . '):*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                  </span>
                  {!! Form::number('left_margin', $barcode->left_margin, ['class' => 'form-control',
                  'placeholder' => __('barcode.left_margin'), 'min' => 0, 'step' => 0.01, 'required']); !!}
                </div>
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('width', __('barcode.width') . ' ('. __('barcode.in_in') . '):*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <i class="fa fa-text-width" aria-hidden="true"></i>
                  </span>
                  {!! Form::number('width', $barcode->width, ['class' => 'form-control',
                  'placeholder' => __('barcode.width'), 'min' => 0.1, 'step' => 0.01, 'required']); !!}
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('height', __('barcode.height') . ' ('. __('barcode.in_in') . '):*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <i class="fa fa-text-height" aria-hidden="true"></i>
                  </span>
                  {!! Form::number('height', $barcode->height, ['class' => 'form-control',
                  'placeholder' => __('barcode.height'), 'min' => 0.1, 'step' => 0.01, 'required']); !!}
                </div>
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('paper_width', __('barcode.paper_width') . ' ('. __('barcode.in_in') . '):*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <i class="fa fa-text-width" aria-hidden="true"></i>
                  </span>
                  {!! Form::number('paper_width', $barcode->paper_width, ['class' => 'form-control',
                  'placeholder' => __('barcode.paper_width'), 'min' => 0.1, 'step' => 0.01, 'required']); !!}
                </div>
              </div>
            </div>
            <div class="col-sm-6 paper_height_div @if( $barcode->is_continuous ) {{ 'hide' }} @endif">
              <div class="form-group">
                {!! Form::label('paper_height', __('barcode.paper_height') . ' ('. __('barcode.in_in') . '):*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <i class="fa fa-text-height" aria-hidden="true"></i>
                  </span>
                  {!! Form::number('paper_height', $barcode->paper_height, ['class' => 'form-control',
                  'placeholder' => __('barcode.paper_height'), 'min' => 0.1, 'step' => 0.01, 'required']); !!}
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('stickers_in_one_row', __('barcode.stickers_in_one_row'). ':*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                  </span>
                  {!! Form::number('stickers_in_one_row', $barcode->stickers_in_one_row, ['class' => 'form-control',
                  'placeholder' => __('barcode.stickers_in_one_row'), 'min' => 1, 'required']); !!}
                </div>
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('row_distance', __('barcode.row_distance') . ' ('. __('barcode.in_in') . '):*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span>
                  </span>
                  {!! Form::number('row_distance', $barcode->row_distance, ['class' => 'form-control',
                  'placeholder' => __('barcode.row_distance'), 'min' => 0, 'step' => 0.01, 'required']); !!}
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('col_distance', __('barcode.col_distance') . ' ('. __('barcode.in_in') . '):*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <span class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></span>
                  </span>
                  {!! Form::number('col_distance', $barcode->col_distance, ['class' => 'form-control',
                  'placeholder' => __('barcode.col_distance'), 'min' => 0, 'step' => 0.01, 'required']); !!}
                </div>
              </div>
            </div> 
            <div class="col-sm-6 stickers_per_sheet_div @if( $barcode->is_continuous ) {{ 'hide' }} @endif">
              <div class="form-group">
                {!! Form::label('stickers_in_one_sheet', __('barcode.stickers_in_one_sheet') . ':*') !!}
                <div class="input- ">
                  <span class="input-group-addon hidden">
                    <i class="fa fa-th" aria-hidden="true"></i>
                  </span>
                  {!! Form::number('stickers_in_one_sheet', $barcode->stickers_in_one_sheet, ['class' => 'form-control',
                  'placeholder' => __('barcode.stickers_in_one_sheet'), 'min' => 1, 'required']); !!}
                </div>
              </div>
            </div> 
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary pull-right">@trans('messages.update')</button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="submit" id="settingAddBtn" class="btn btn-primary btn-sm setting-add">@trans('messages.save')</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">close</button>
      </div>
  </div>
  {!! Form::close() !!}
</div>



@include("layouts.js.icheck")







 