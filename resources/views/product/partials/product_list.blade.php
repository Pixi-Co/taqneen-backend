@php
$colspan = 15;
$custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<div style="display: flex; width: 100%;">
    @can('product.delete')
        {!! Form::open(['url' => action('ProductController@massDestroy'), 'method' => 'post', 'id' => 'mass_delete_form']) !!}
        {!! Form::hidden('selected_rows', null, ['id' => 'selected_rows']) !!}
        {!! Form::submit(__('lang_v1.delete_selected'), ['class' => 'w3-round-xlarge btn btn-default btn-sm m-user-edit', 'id' => 'delete-selected']) !!}
        {!! Form::close() !!}
    @endcan

    @if (config('constants.enable_product_bulk_edit'))
        @can('product.update')
            &nbsp;
            {!! Form::open(['url' => action('ProductController@bulkEdit'), 'method' => 'post', 'id' => 'bulk_edit_form']) !!}
            {!! Form::hidden('selected_products', null, ['id' => 'selected_products_for_edit']) !!}
            <button type="submit" class="w3-round-xlarge btn btn-default btn-sm m-user-edit" id="edit-selected"> <i
                    class="fa fa-edit"></i>{{ __('lang_v1.bulk_edit') }}</button>
            {!! Form::close() !!}
            &nbsp;
            <button type="button" class="w3-round-xlarge btn btn-default btn-sm m-user-edit update_product_location"
                data-type="add">@trans('lang_v1.add_to_location')</button>
            &nbsp;
            <button type="button" class="w3-round-xlarge btn btn-default btn-sm m-user-edit update_product_location"
                data-type="remove">@trans('lang_v1.remove_from_location')</button>
        @endcan
    @endif
    &nbsp;
    {!! Form::open(['url' => action('ProductController@massDeactivate'), 'method' => 'post', 'id' => 'mass_deactivate_form']) !!}
    {!! Form::hidden('selected_products', null, ['id' => 'selected_products']) !!}
    {!! Form::submit(__('lang_v1.deactivate_selected'), ['class' => 'w3-round-xlarge btn btn-default btn-sm m-user-edit', 'id' => 'deactivate-selected']) !!}
    {!! Form::close() !!} @show_tooltip(__('lang_v1.deactive_product_tooltip'))
</div>
<br>

<div class="table-responsive w3-light-gray">
    <table data-title="{{ __('lang_v1.all_products') }}"
        class="table product-table table-bordered table-striped ajax_view hide-footer" id="product_table">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all-row" data-table-id="product_table"></th>
                <th>&nbsp;</th>
                <th>@trans('messages.action')</th>
                <th>@trans('sale.product')</th>

                @can_bt(['subscription.class_type'])
                <th>@trans('class type')</th>
                @endcan_bt
                <th>@trans('purchase.business_location') @show_tooltip(__('lang_v1.product_business_location_tooltip'))
                </th>
                @can('view_purchase_price')
                    @php
                        $colspan++;
                    @endphp
                    <th>@trans('lang_v1.unit_perchase_price')</th>
                @endcan
                @can('access_default_selling_price')
                    @php
                        $colspan++;
                    @endphp
                    <th>@trans('lang_v1.selling_price')</th>
                @endcan
                <th>@trans('report.current_stock')</th>
                <th>@trans('product.product_type')</th>
                <th>@trans('product.category')</th>
                <th>@trans('product.brand')</th>
                <th>@trans('product.tax')</th>
                <th>@trans('product.sku')</th>
                <th>{{ $custom_labels['product']['custom_field_1'] ?? __('lang_v1.product_custom_field1') }}</th>
                <th>{{ $custom_labels['product']['custom_field_2'] ?? __('lang_v1.product_custom_field2') }}</th>
                <th>{{ $custom_labels['product']['custom_field_3'] ?? __('lang_v1.product_custom_field3') }}</th>
                <th>{{ $custom_labels['product']['custom_field_4'] ?? __('lang_v1.product_custom_field4') }}</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="{{ $colspan }}">

                </td>
            </tr>
        </tfoot>
    </table>
</div>
