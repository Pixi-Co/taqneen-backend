<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    {!! Form::checkbox('common_settings[enable_export_money_to_safe_proccess]', 1,  
                        $common_settings['enable_export_money_to_safe_proccess']?? false , 
                    [ 'class' => 'input-icheck']); !!} {{ __( 'enable export money to safe proccess' ) }}
                  </label>
                </div>
            </div>
        </div> 

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('football_start_hour', __('football_start_hour') . ':') !!}
                {!! Form::time('common_settings[football_start_hour]', $common_settings['football_start_hour'] ?? '', ['class' => 'form-control','placeholder' => __('football_start_hour'), 'id' => 'football_start_hour']); !!}
            </div>
        </div> 

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('football_end_hour', __('football_end_hour') . ':') !!}
                {!! Form::time('common_settings[football_end_hour]', $common_settings['football_end_hour'] ?? '', ['class' => 'form-control','placeholder' => __('football_end_hour'), 'id' => 'football_end_hour']); !!}
            </div>
        </div> 

    </div>
</div> 
