@extends('layouts.app')
@section('title', __('role.add_role'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@trans( 'role.add_role' )</h1>
    </section>

    <!-- Main content -->
    <section class="content w3-padding">
        @component('components.widget', ['class' => 'box-primary'])
            {!! Form::open(['url' => action('RoleController@store'), 'method' => 'post', 'id' => 'role_add_form']) !!}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('name', __('user.role_name') . ':*') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('user.role_name')]) !!}
                    </div>
                </div>
            </div>
            @if (in_array('service_staff', $enabled_modules))
                <div class="row">
                    <div class="col-md-2">
                        <h4>@trans( 'lang_v1.user_type' )</h4>
                    </div>
                    <div class="col-md-9 col-md-offset-1">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('is_service_staff', 0, false, ['class' => 'input-icheck no-icheck']) !!} {{ __('restaurant.service_staff') }}
                                </label>
                                @show_tooltip(__('restaurant.tooltip_service_staff'))
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">  
                <div class="col-lg-7">
                  <br>
                  <h3 class="text-center" >@trans('items')</h3>
                  <hr>
                  <input 
                  class="w3-input w3-round-xlarge w3-light-gray" 
                  style="max-width: 300px;margin: auto"
                  onkeyup="searchPermission(this.value)"
                  placeholder="search" type="text" id="name">
                  <br>
                    <div class="permission-content" style="height: 450px;overflow: auto">
                        <div class="row">
                            <div class="col-md-3">
                                <label>@trans( 'user.permissions' ):</label>
                            </div>
                        </div>
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'role.user' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'user.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.user.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'user.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.user.create') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'user.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.user.update') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'user.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.user.delete') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'user.roles' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'roles.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.view_role') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'roles.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.add_role') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'roles.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.edit_role') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'roles.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.delete_role') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'role.supplier' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'supplier.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.view_all_supplier') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'supplier.view_own', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.view_own_supplier') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'supplier.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.supplier.create') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'supplier.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.supplier.update') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'supplier.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.supplier.delete') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'role.customer' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'customer.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.view_all_customer') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'customer.view_own', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.view_own_customer') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'customer.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.customer.create') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'customer.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.customer.update') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'customer.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.customer.delete') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'business.product' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'product.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.product.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'product.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.product.create') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'product.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.product.update') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'product.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.product.delete') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'product.opening_stock', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.add_opening_stock') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'view_purchase_price', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.view_purchase_price') }}
                                        </label>
                                        @show_tooltip(__('lang_v1.view_purchase_price_tooltip'))
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if (in_array('purchases', $enabled_modules) || in_array('stock_adjustment', $enabled_modules))
                            <div class="row check_group">
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'role.purchase' )
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'purchase.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.purchase.view') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'purchase.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.purchase.create') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'purchase.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.purchase.update') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'purchase.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.purchase.delete') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'purchase.payments', false, ['class' => 'input-icheck no-icheck']) !!}
                                                {{ __('lang_v1.purchase.payments') }}
                                            </label>
                                            @show_tooltip(__('lang_v1.purchase_payments'))
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'purchase.update_status', false, ['class' => 'input-icheck no-icheck']) !!}
                                                {{ __('lang_v1.update_status') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'view_own_purchase', false, ['class' => 'input-icheck no-icheck']) !!}
                                                {{ __('lang_v1.view_own_purchase') }}
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        @endif

                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'sale.pos_sale' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                @if (in_array('pos_sale', $enabled_modules))
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'sell.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.sell.view') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'sell.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.sell.create') }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'sell.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.sell.update') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'sell.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.sell.delete') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'edit_product_price_from_pos_screen', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.edit_product_price_from_pos_screen') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'edit_product_discount_from_pos_screen', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.edit_product_discount_from_pos_screen') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'print_invoice', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.print_invoice') }}
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'sale.sale' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                @if (in_array('add_sale', $enabled_modules))
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'direct_sell.access', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.direct_sell.access') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'direct_sell.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.delete_sell') }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'list_drafts', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.list_drafts') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'list_quotations', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.list_quotations') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'view_own_sell_only', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.view_own_sell_only') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'view_commission_agent_sell', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.view_commission_agent_sell') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'sell.payments', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.sell.payments') }}
                                        </label>
                                        @show_tooltip(__('lang_v1.sell_payments'))
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'edit_product_price_from_sale_screen', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.edit_product_price_from_sale_screen') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'edit_product_discount_from_sale_screen', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.edit_product_discount_from_sale_screen') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'discount.access', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.discount.access') }}
                                        </label>
                                    </div>
                                </div>
                                @if (in_array('types_of_service', $enabled_modules))
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'access_types_of_service', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.access_types_of_service') }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'access_sell_return', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.access_sell_return') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'edit_invoice_number', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.add_edit_invoice_number') }}
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        

                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'lang_v1.shipments' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'access_shipping', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.access_shipping') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'access_own_shipping', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.access_own_shipping') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'access_commission_agent_shipping', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.access_commission_agent_shipping') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans(
                                        'cash_register.cash_register' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'view_cash_register', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.view_cash_register') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'close_cash_register', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.close_cash_register') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'role.brand' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'brand.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.brand.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'brand.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.brand.create') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'brand.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.brand.update') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'brand.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.brand.delete') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'role.tax_rate' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'tax_rate.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.tax_rate.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'tax_rate.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.tax_rate.create') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'tax_rate.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.tax_rate.update') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'tax_rate.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.tax_rate.delete') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'role.unit' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'unit.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.unit.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'unit.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.unit.create') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'unit.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.unit.update') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'unit.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.unit.delete') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'category.category' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'category.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.category.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'category.create', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.category.create') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'category.update', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.category.update') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'category.delete', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.category.delete') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'role.report' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                @if (in_array('purchases', $enabled_modules) || in_array('add_sale', $enabled_modules) || in_array('pos_sale', $enabled_modules))
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'purchase_n_sell_report.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.purchase_n_sell_report.view') }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'tax_report.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.tax_report.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'contacts_report.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.contacts_report.view') }}
                                        </label>
                                    </div>
                                </div>
                                @if (in_array('expenses', $enabled_modules))
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'expense_report.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.expense_report.view') }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'profit_loss_report.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.profit_loss_report.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'stock_report.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.stock_report.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'trending_product_report.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.trending_product_report.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'register_report.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.register_report.view') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'sales_representative.view', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.sales_representative.view') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'view_product_stock_value', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.view_product_stock_value') }}
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'role.settings' )
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'business_settings.access', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.business_settings.access') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'barcode_settings.access', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.barcode_settings.access') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'invoice_settings.access', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.invoice_settings.access') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', find_or_create_p('einvoice_settings'), false, ['class' => 'input-icheck no-icheck']) !!} {{ __('envoice settings') }}
                                        </label>
                                    </div>
                                </div>
                                @if (in_array('expenses', $enabled_modules))
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'expense.access', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('role.expense.access') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'view_own_expense', false, ['class' => 'input-icheck no-icheck']) !!}
                                                {{ __('lang_v1.view_own_expense') }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'access_printers', false, ['class' => 'input-icheck no-icheck']) !!}
                                            {{ __('lang_v1.access_printers') }}
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'dashboard.data', true, ['class' => 'input-icheck no-icheck']) !!} @trans( 'role.dashboard' )
                                            @show_tooltip(__('tooltip.dashboard_permission'))
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row check_group">
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'account.access', false, ['class' => 'input-icheck no-icheck']) !!} @trans( 'account.account' )
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if (in_array('booking', $enabled_modules))
                            <div class="row check_group">
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'restaurant.bookings'
                                            )
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'crud_all_bookings', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('restaurant.add_edit_view_all_booking') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'crud_own_bookings', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('restaurant.add_edit_view_own_booking') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        @endif
                        <div class="row">
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('permissions[]', 'access_default_selling_price', true, ['class' => 'input-icheck no-icheck']) !!} @trans( 'lang_v1.access_selling_price_groups' )
                                        </label>
                                    </div>
                                </div>
                                @if (count($selling_price_groups) > 0)
                                    @foreach ($selling_price_groups as $selling_price_group)
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label>
                                                    {!! Form::checkbox('spg_permissions[]', 'selling_price_group.' . $selling_price_group->id, false, ['class' => 'input-icheck no-icheck']) !!} {{ $selling_price_group->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        

                        @can_bt(['subscription.module'])
                            @include("subscription::roles.form", ['role_permissions' => []])
                        @endcan_bt
                        
                        @if (in_array('tables', $enabled_modules))
                            <div class="row">
                                <div class="col-md-1">
                                    <h4>@trans( 'restaurant.restaurant' )</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                {!! Form::checkbox('permissions[]', 'access_tables', false, ['class' => 'input-icheck no-icheck']) !!} {{ __('lang_v1.access_tables') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @include('role.partials.module_permissions')
                    </div>
                    <div class="w3-padding text-center">
                      <hr> 
                      <input type="checkbox" onchange="checkAll(this)" >
                      <b class="selected-count" >0</b> / <b class="total-count" ></b>
                    </div>
                </div>
                <div class="col-lg-5">
                  <br>
                  <h3 class="text-center" >selected items</h3>
                  <hr> 
                  <input 
                  class="w3-input w3-round-xlarge w3-light-gray" 
                  style="max-width: 300px;margin: auto"
                  onkeyup="searchPermission2(this.value)"
                  placeholder="search" type="text" id="name">

                  <div class="w3-padding" style="height: 450px;overflow: auto" >
                    <ul class="w3-ul selected-items" >

                    </ul>
                  </div>
                  <div class="w3-padding text-center">
                    <hr> 
                    <b class="selected-count" >0</b>
                  </div>

                </div>

                <div class="col-lg-12">
                    <div class="w3-padding">
                        <center class="w3-padding">
                            <button type="submit" style="float: inherit" class="add_btn">@trans( 'messages.save' )</button>
                        </center>
                    </div>
                </div>
            </div>


            {!! Form::close() !!}
        @endcomponent
    </section>
    <!-- /.content -->
@endsection


@section("javascript")
@include("layouts.js.icheck")
<script>
  function checkAll(input) {
    if (input.checked)
      $('input').iCheck('check');
    else 
      $('input').iCheck('uncheck'); 

    getSelectedPermission();
  }

  function searchPermission(key) {
    console.log("search permission function : key => ", key);
    if (key.length <= 0) {
      return $('.check_group').show();
    } 

    $('.check_group').hide();
    $('.check_group').each(function(){
      console.log($(this).text().lowercase);
        if ($(this).text().toLowerCase().indexOf(key.toLowerCase()) >= 0) {
          $(this).show();
        }
    });
  }

  function searchPermission2(key) {
    console.log("search permission function : key => ", key);
    if (key.length <= 0) {
      return $('.w3-ul li').show();
    } 

    $('.w3-ul li').hide();
    $('.w3-ul li').each(function(){
      console.log($(this).text().lowercase);
        if ($(this).text().toLowerCase().indexOf(key.toLowerCase()) >= 0) {
          $(this).show();
        }
    });
  }

  function getSelectedPermission() {
    $('.selected-items').html('');
    $('.checked').each(function(){
      //console.log(this);
      if ($(this).parent().text().length > 0) { 
        var li = document.createElement('li');
        li.innerHTML = "<input type='checkbox' disabled='disabled' class='' > " + $(this).parent().text();
        $('.selected-items').append(li);
      }
    });

    $('.selected-count').html($('.checked').length);
  }

  $('.permission-content').mousedown(function(){
  });
  $('input').on('ifChanged', function(event){
    getSelectedPermission(); 
  }); 

  $(document).ready(function(){
    $('.total-count').html($('.input-icheck').length);
  }); 
</script>
@endsection
