<div class="modal-dialog ">
    {!! Form::open(['url' => action('BarcodeController@store'), 'method' => 'post', 'id' => 'add_barcode_settings_form']) !!}
    <div class="modal-content">
        <div class="modal-header dir_rtl">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">
                {{ __('barcode.add_barcode_setting') }}
            </h4>
        </div>

        <div class="modal-body">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::label('name', __('barcode.setting_name') . ':*') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('barcode.setting_name')]) !!}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::label('description', __('barcode.setting_description')) !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('barcode.setting_description'), 'rows' => 3]) !!}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('is_continuous', 1, false, ['id' => 'is_continuous']) !!} @trans('barcode.is_continuous')</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('top_margin', __('barcode.top_margin') . ' (' . __('barcode.in_in') . '):*') !!}
                            <div class="input- ">
                                <span class="input-group-addon hidden">
                                    <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
                                </span>
                                {!! Form::number('top_margin', 0, ['class' => 'form-control', 'placeholder' => __('barcode.top_margin'), 'min' => 0, 'step' => 0.00001, 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('left_margin', __('barcode.left_margin') . ' (' . __('barcode.in_in') . '):*') !!}
                            <div class="input- ">
                                <span class="input-group-addon hidden">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                                </span>
                                {!! Form::number('left_margin', 0, ['class' => 'form-control', 'placeholder' => __('barcode.left_margin'), 'min' => 0, 'step' => 0.00001, 'required']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('width', __('barcode.width') . ' (' . __('barcode.in_in') . '):*') !!}
                            <div class="input- ">
                                <span class="input-group-addon hidden">
                                    <i class="fa fa-text-width" aria-hidden="true"></i>
                                </span>
                                {!! Form::number('width', null, ['class' => 'form-control', 'placeholder' => __('barcode.width'), 'min' => 0.1, 'step' => 0.00001, 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('height', __('barcode.height') . ' (' . __('barcode.in_in') . '):*') !!}
                            <div class="input- ">
                                <span class="input-group-addon hidden">
                                    <i class="fa fa-text-height" aria-hidden="true"></i>
                                </span>
                                {!! Form::number('height', null, ['class' => 'form-control', 'placeholder' => __('barcode.height'), 'min' => 0.1, 'step' => 0.00001, 'required']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('paper_width', __('barcode.paper_width') . ' (' . __('barcode.in_in') . '):*') !!}
                            <div class="input- ">
                                <span class="input-group-addon hidden">
                                    <i class="fa fa-text-width" aria-hidden="true"></i>
                                </span>
                                {!! Form::number('paper_width', null, ['class' => 'form-control', 'placeholder' => __('barcode.paper_width'), 'min' => 0.1, 'step' => 0.00001, 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 paper_height_div">
                        <div class="form-group">
                            {!! Form::label('paper_height', __('barcode.paper_height') . ' (' . __('barcode.in_in') . '):*') !!}
                            <div class="input- ">
                                <span class="input-group-addon hidden">
                                    <i class="fa fa-text-height" aria-hidden="true"></i>
                                </span>
                                {!! Form::number('paper_height', null, ['class' => 'form-control', 'placeholder' => __('barcode.paper_height'), 'min' => 0.1, 'step' => 0.00001, 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('stickers_in_one_row', __('barcode.stickers_in_one_row') . ':*') !!}
                            <div class="input- ">
                                <span class="input-group-addon hidden">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                </span>
                                {!! Form::number('stickers_in_one_row', null, ['class' => 'form-control', 'placeholder' => __('barcode.stickers_in_one_row'), 'min' => 1, 'required']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('row_distance', __('barcode.row_distance') . ' (' . __('barcode.in_in') . '):*') !!}
                            <div class="input- ">
                                <span class="input-group-addon hidden">
                                    <span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span>
                                </span>
                                {!! Form::number('row_distance', 0, ['class' => 'form-control', 'placeholder' => __('barcode.row_distance'), 'min' => 0, 'step' => 0.00001, 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('col_distance', __('barcode.col_distance') . ' (' . __('barcode.in_in') . '):*') !!}
                            <div class="input-group hidden">
                                <span class="input-group- ">
                                    <span class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></span>
                                </span>
                                {!! Form::number('col_distance', 0, ['class' => 'form-control', 'placeholder' => __('barcode.col_distance'), 'min' => 0, 'step' => 0.00001, 'required']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-sm-6 stickers_per_sheet_div">
                        <div class="form-group">
                            {!! Form::label('stickers_in_one_sheet', __('barcode.stickers_in_one_sheet') . ':*') !!}
                            <div class="input- ">
                                <span class="input-group-addon hidden">
                                    <i class="fa fa-th" aria-hidden="true"></i>
                                </span>
                                {!! Form::number('stickers_in_one_sheet', null, ['class' => 'form-control', 'placeholder' => __('barcode.stickers_in_one_sheet'), 'min' => 1, 'required']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('is_default', 1 ,['class' => 'icheck']) !!} @trans('barcode.set_as_default')</label>
                            </div>
                        </div>
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