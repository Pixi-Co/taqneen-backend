@php

    $activityCodes = App\GlobalSetting::getActivityCodesOfEinvoice();
    $listOfCodes = [];
    foreach($activityCodes as $item) {
        $listOfCodes[$item->code] = session('user.language') == 'ar'? $item->description_ar : $item->description_en;
    }

    $issuerTypes = App\GlobalSetting::getIssuerTypes();
    $listOfIssuerTypes = [];
    foreach($issuerTypes as $item) {
        $listOfIssuerTypes[$item->key] = "(" . $item->key . ") " . __($item->description);
    }
    
    $countryCodes = App\GlobalSetting::getCountryCodes();
    $listOfCountryCodes = [];
    foreach($countryCodes as $item) {
        $listOfCountryCodes[$item->code] = session('user.language') == 'ar'? $item->description_ar : $item->description_en;
    }
@endphp

<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-12">
            <h4>
                @trans('issuer einvoice info')
            </h4>
            <hr>
        </div> 
        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('issuer_type', __('Issuer Type') . ':') !!}
                {!! Form::select('common_settings[issuer_type]', $listOfIssuerTypes, $common_settings['issuer_type'] ?? '', ['class' => 'form-control']) !!}
            </div>
        </div> 
        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('registration_number', __('Registration Number') . ':') !!}
                {!! Form::text('common_settings[issuer_registration_number]', $common_settings['issuer_registration_number'] ?? '', ['class' => 'form-control','placeholder' => __('Registration Number'), 'id' => 'registration_number']); !!}
            </div>
        </div> 
        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('registration_name', __('Registration Name') . ':') !!}
                {!! Form::text('common_settings[issuer_registration_name]', $common_settings['issuer_registration_name'] ?? session('business.name'), ['class' => 'form-control','placeholder' => __('Registration Name'), 'id' => 'registration_name']); !!}
            </div>
        </div> 
        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('branch_id', __('Branch Id') . ':') !!}
                {!! Form::text('common_settings[issuer_branch_id]', $common_settings['issuer_branch_id'] ?? '', ['class' => 'form-control','placeholder' => __('Branch Id'), 'id' => 'issuer_branch_id']); !!}
            </div>
        </div> 
        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('issuer_country_code', __('Issuer Country Code') . ':') !!}
                {!! Form::select('common_settings[issuer_country_code]', $listOfCountryCodes, $common_settings['issuer_country_code'] ?? '', ['class' => 'form-control select2']) !!}
            </div>
        </div> 

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('activity_type_code', __('Activity Type Code') . ':') !!}
                {!! Form::select('common_settings[activity_type_code]', $listOfCodes, $common_settings['activity_type_code'] ?? '', ['class' => 'form-control select2']) !!}
            </div>
        </div> 
 
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    {!! Form::checkbox('common_settings[disable_einvoice_sync]', 1,  
                        $common_settings['disable_einvoice_sync']?? false , 
                    [ 'class' => 'input-icheck']); !!} {{ __( 'disable E invoice sync' ) }}
                  </label>
                </div>
            </div>
        </div>




    </div>
</div> 
