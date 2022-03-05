<div class="pos-tab-content active row">
    <div class="hidden page-title">
        @trans('business.business')
    </div>

    <div class="col-md-6">

        <div class="row" style="margin-bottom: 5px" >
            <div class="col-md-4">
                <b>@trans('business.business_name') *</b>
            </div>
            <div class="col-md-8">
                {!! Form::text('name', $business->name, ['class' => 'form-control w3-light-gray', 'required', 'placeholder' => __('business.business_name')]); !!}
            </div>
        </div>

        <div class="row" style="margin-bottom: 5px" >
            <div class="col-md-4">
                <b>@trans('tax_number') *</b>
            </div>
            <div class="col-md-8">
                {!! Form::text('tax_number', $business->tax_number, ['class' => 'form-control w3-light-gray', 'required', 'placeholder' => __('tax_number')]); !!}
            </div>
        </div>

        <div class="row" style="margin-bottom: 5px" >
            <div class="col-md-4">
                <b>@trans('commercial_number') *</b>
            </div>
            <div class="col-md-8">
                {!! Form::text('commercial_number', $business->commercial_number, ['class' => 'form-control w3-light-gray', 'required', 'placeholder' => __('commercial_number')]); !!}
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('business.start_date')</b>
            </div>
            <div class="col-md-8">
                {!! Form::text('start_date', @format_date($business->start_date), ['class' => 'form-control w3-light-gray start-date-picker','placeholder' => __('business.start_date'), 'readonly']); !!}
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('business.default_profit_percent')  *</b> 
                @include("layouts.partials.tooltip", ["text" => __('tooltip.default_profit_percent')])
            </div>
            <div class="col-md-8">
                {!! Form::text('default_profit_percent', @num_format($business->default_profit_percent), ['class' => 'form-control w3-light-gray input_number']); !!}
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('business.currency') </b>  
            </div>
            <div class="col-md-8">
                {!! Form::select('currency_id', $currencies, $business->currency_id, ['class' => 'form-control w3-light-gray select2','placeholder' => __('business.currency'), 'required']); !!}
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('lang_v1.currency_symbol_placement') </b>  
            </div>
            <div class="col-md-8">
                {!! Form::select('currency_symbol_placement', ['before' => __('lang_v1.before_amount'), 'after' => __('lang_v1.after_amount')], $business->currency_symbol_placement, ['class' => 'form-control w3-light-gray select2', 'required']); !!}
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('business.time_zone') </b>  
            </div>
            <div class="col-md-8">
                {!! Form::select('time_zone', $timezone_list, $business->time_zone, ['class' => 'form-control w3-light-gray select2', 'required']); !!}
            </div>
        </div>

    </div>

    <div class="col-md-6">

        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('business.upload_logo') </b>  
                @include("layouts.partials.tooltip", ["text" => __('business.logo_help')])
            </div>
            <div class="col-md-8">
                {!! Form::file('business_logo', ['class' => 'form-control w3-light-gray', 'accept' => 'image/*']); !!}            
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('business.fy_start_month') </b>  
                @include("layouts.partials.tooltip", ["text" => __('tooltip.fy_start_month')])
            </div>
            <div class="col-md-8">
                {!! Form::select('fy_start_month', $months, $business->fy_start_month, ['class' => 'form-control w3-light-gray select2', 'required']); !!}
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('business.accounting_method') *</b>  
                @include("layouts.partials.tooltip", ["text" => __('tooltip.accounting_method')])
            </div>
            <div class="col-md-8">
                {!! Form::select('accounting_method', $accounting_methods, $business->accounting_method, ['class' => 'form-control w3-light-gray select2', 'required']); !!}
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('business.transaction_edit_days') *</b>  
                @include("layouts.partials.tooltip", ["text" => __('tooltip.transaction_edit_days')])
            </div>
            <div class="col-md-8">
                {!! Form::number('transaction_edit_days', $business->transaction_edit_days, ['class' => 'form-control w3-light-gray','placeholder' => __('business.transaction_edit_days'), 'required']); !!}
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('lang_v1.date_format') *</b>   
            </div>
            <div class="col-md-8">
                {!! Form::select('date_format', $date_formats, $business->date_format, ['class' => 'form-control w3-light-gray select2', 'required']); !!}
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-4">
                <b>@trans('lang_v1.time_format') *</b>   
            </div>
            <div class="col-md-8">
                {!! Form::select('time_format', [12 => __('lang_v1.12_hour'), 24 => __('lang_v1.24_hour')], $business->time_format, ['class' => 'form-control w3-light-gray select2', 'required']); !!}
            </div>
        </div>
    </div> 
</div>
