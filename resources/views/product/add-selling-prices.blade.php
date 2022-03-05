 <!-- Main content -->
@if (count($price_groups) > 0)

{!! Form::open(['url' => action('ProductController@saveSellingPrices'), 'method' => 'post', 'id' => 'selling_price_form']) !!}
{!! Form::hidden('product_id', $product->id) !!}
<div class="row">
    <div class="col-xs-12">
        <div class="box- box-solid-">
            <div class="box-header-">
                <h3 class="box-title-">@trans('sale.product'): {{ $product->name }} ({{ $product->sku }})</h3>
            </div>
            <div class="box-body-">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table
                                class="table table-condensed table-bordered table-th-green text-center table-striped">
                                <thead>
                                    <tr>
                                        @if ($product->type == 'variable')
                                            <th>
                                                @trans('lang_v1.variation')
                                            </th>
                                        @endif
                                        <th>@trans('lang_v1.default_selling_price_inc_tax')</th>
                                        @foreach ($price_groups as $price_group)
                                            <th>{{ $price_group->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->variations as $variation)
                                        <tr>
                                            @if ($product->type == 'variable')
                                                <td>
                                                    {{ $variation->product_variation->name }} -
                                                    {{ $variation->name }} ({{ $variation->sub_sku }})
                                                </td>
                                            @endif
                                            <td><span class="display_currency"
                                                    data-currency_symbol="true">{{ $variation->sell_price_inc_tax }}</span>
                                            </td>
                                            @foreach ($price_groups as $price_group)
                                                <td>
                                                    {!! Form::text('group_prices[' . $price_group->id . '][' . $variation->id . ']', !empty($variation_prices[$variation->id][$price_group->id]) ? @num_format($variation_prices[$variation->id][$price_group->id]) : 0, ['class' => 'form-control input_number input-sm']) !!}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        {!! Form::hidden('submit_type', 'save', ['id' => 'submit_type']) !!}
        <div class="text-center">
            <div class="btn-group">
                <!--	
                   <button id="opening_stock_button" @if ($product->enable_stock == 0) disabled @endif type="submit" value="submit_n_add_opening_stock"
                       class="btn bg-purple submit_form">@trans('lang_v1.save_n_add_opening_stock')</button>
                   <button type="submit" value="save_n_add_another"
                       class="btn bg-maroon submit_form">@trans('lang_v1.save_n_add_another')</button>
                   -->
                <button type="submit" value="submit"
                    class="btn btn-primary submit_form">@trans('messages.save')</button>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
<script type="text/javascript">
    $(document).ready(function() {
        $('button.submit_form').click(function(e) {
            e.preventDefault();
            $('input#submit_type').val($(this).attr('value'));

            if ($("form#selling_price_form").valid()) {
                $("form#selling_price_form").submit();
            }
        });
    });
</script>

@endif
