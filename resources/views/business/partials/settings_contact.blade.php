<!--Purchase related settings -->
<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('default_credit_limit',__('lang_v1.default_credit_limit') . ':') !!}
                {!! Form::text('common_settings[default_credit_limit]', $common_settings['default_credit_limit'] ?? '', ['class' => 'form-control input_number',
                'placeholder' => __('lang_v1.default_credit_limit'), 'id' => 'default_credit_limit']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group"> 
                {!! Form::label('default_country_code',__('default_country_code') . ':') !!} 
                <select name="common_settings[default_country_code]" value="{{ $common_settings['default_country_code'] ?? '' }}" id="default_country_code" class="form-control select2 w3-light-gray">
                    <option value="">@trans('select country code')</option>
                    @foreach (DB::table('countries')->get() as $item)
                        <option value="{{ $item->phone_code }}">{{ $item->name }}
                            ({{ $item->phone_code }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<script>
    $('#default_country_code').val("{{ $common_settings['default_country_code'] ?? '' }}");
</script>
