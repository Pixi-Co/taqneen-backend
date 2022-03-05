@if(!session('business.enable_price_tax')) 
  @php
    $default = 0;
    $class = 'hide__';
  @endphp
@else
  @php
    $default = null;
    $class = '';
  @endphp
@endif

<div class="table-responsive">
    <table class="table table-bordered add-product-price-table table-condensed {{$class}}  ">
        <tr class="w3-white" >
          <th class="hidden">@trans('product.default_purchase_price')</th>
          <th class="hidden">@trans('product.profit_percent') @show_tooltip(__('tooltip.profit_percent'))</th>
          <th>@trans('product.default_selling_price')</th>
          @if(empty($quick_add))
            <th>@trans('lang_v1.product_image')</th>
          @endif
        </tr>
        <tr class="  " >
          <td class="hidden">
            <div class="col-sm-6">
              {!! Form::text('single_dpp', $default, ['id' => 'single_dpp',  'class' => 'form-control input-sm dpp input_number w3-light-gray', 'placeholder' => __('product.exc_of_tax'), 'required']); !!}
              
              {!! Form::label('single_dpp', trans('product.exc_of_tax') . ':*') !!}

            </div>

            <div class="col-sm-6 ">
              {!! Form::text('single_dpp_inc_tax', $default, ['id' => 'single_dpp_inc_tax',  'class' => 'form-control input-sm dpp_inc_tax input_number w3-light-gray', 'placeholder' => __('product.inc_of_tax'), 'required']); !!}
            
              {!! Form::label('single_dpp_inc_tax', trans('product.inc_of_tax') . ':*') !!}
            
            </div>
          </td>

          <td class="hidden" > 
            {!! Form::text('profit_percent', @num_format($profit_percent), ['id' => 'profit_percent',  'class' => 'form-control input-sm input_number w3-light-gray', 'id' => 'profit_percent', 'required']); !!}
          </td>

          <td>
            {!! Form::text('single_dsp', $default, ['id' => 'single_dsp',  'class' => 'form-control input-sm dsp input_number w3-light-gray', 'placeholder' => __('product.exc_of_tax'), 'id' => 'single_dsp', 'required']); !!}

            {!! Form::text('single_dsp_inc_tax', $default, ['id' => 'single_dsp_inc_tax',  'class' => 'form-control input-sm hide input_number w3-light-gray', 'placeholder' => __('product.inc_of_tax'), 'id' => 'single_dsp_inc_tax', 'required']); !!}
            
            <label><span class="dsp_label">@trans('product.exc_of_tax')</span></label>
          </td>
          @if(empty($quick_add))
          <td>
              <div class="form-group"> 
                {!! Form::file('variation_images[]', ['class' => 'form-control variation_images w3-light-gray', 'accept' => 'image/*', 'multiple']); !!}
                @include("layouts.partials.tooltip", ["text" => __('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) . __('lang_v1.aspect_ratio_should_be_1_1')])
              </div>
          </td>
          @endif
        </tr>
    </table>
</div>
