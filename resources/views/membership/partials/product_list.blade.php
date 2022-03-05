@php
$colspan = 9;
$custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<div class="w3-padding" style="display: flex; width: 100%;">
    @can('product.delete')
        {!! Form::open(['url' => action('MemberShipController@massDestroy'), 'method' => 'post', 'id' => 'mass_delete_form']) !!}
        {!! Form::hidden('selected_rows', null, ['id' => 'selected_rows']) !!}
        {!! Form::submit(__('lang_v1.delete_selected'), ['class' => 'w3-round-xlarge  sb-shadow btn w3-white btn-sm m-user-edit', 'id' => 'delete-selected']) !!}
        {!! Form::close() !!}
    @endcan

    @if (config('constants.enable_product_bulk_edit'))
        @can('product.update')
            &nbsp;
            {!! Form::open(['url' => action('MemberShipController@bulkEdit'), 'method' => 'post', 'id' => 'bulk_edit_form']) !!}
            {!! Form::hidden('selected_products', null, ['id' => 'selected_products_for_edit']) !!}
            <button type="submit" class="w3-round-xlarge btn btn-default btn-sm m-user-edit" id="edit-selected"> <i
                    class="fa fa-edit"></i>{{ __('lang_v1.bulk_edit') }}</button>
            {!! Form::close() !!}
            &nbsp;
            <button type="button" class="w3-round-xlarge btn btn-default btn-sm m-user-edit update_product_location"
                data-type="add">@trans('lang_v1.add_to_location')
            </button>
            &nbsp;
            <button type="button" class="w3-round-xlarge btn btn-default btn-sm m-user-edit update_product_location"
                data-type="remove">@trans('lang_v1.remove_from_location')</button>
        @endcan
    @endif
    &nbsp;
    {!! Form::open(['url' => action('MemberShipController@massDeactivate'), 'method' => 'post', 'id' => 'mass_deactivate_form']) !!}
    {!! Form::hidden('selected_products', null, ['id' => 'selected_products']) !!}
    {!! Form::submit(__('lang_v1.deactivate_selected'), ['class' => 'w3-round-xlarge sb-shadow btn  w3-white btn-sm m-user-edit', 'id' => 'deactivate-selected']) !!}
    {!! Form::close() !!} @show_tooltip(__('lang_v1.deactive_product_tooltip'))
</div>
<br>

<div class="table-responsive w3-light-gray w3-block">
    <table data-title="{{ __('memberships') }}"
        class="table product-table- table-bordered table-striped w3-block" id="product_table">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all-row" data-table-id="product_table"></th>
                <th>&nbsp;</th>
                <th>@trans('messages.action')</th>
                <th>@trans('membership')</th>
                <th>@trans('subscription_number')</th>

                @can_bt(['subscription.class_type'])
                <th>@trans('class type')</th>
                @endcan_bt
                <th>
                    @trans('purchase.business_location') @show_tooltip(__('lang_v1.product_business_location_tooltip'))
                </th>  
                <th>
                    @trans('price')
                </th>
                <th>@trans('type')</th>
                <th>@trans('product.sku')</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        <tfoot>
            <tr>
                <td colspan="{{ $colspan }}">

                </td>
            </tr>
        </tfoot>
    </table>
</div>
