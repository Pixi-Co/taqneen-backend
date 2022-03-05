<div class="row">
	<div class="col-md-4">
	    <div class="form-group">
	        {!! Form::label('sr_location_id',  __('purchase.business_location') . ':') !!}

	        {!! Form::select('sr_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
	    </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
            <table class="table table-bordered table-striped" 
            id="supplier_stock_report_table" width="100%">
                <thead>
                    <tr>
                        <th>@trans('sale.product')</th>
                        <th>@trans('product.sku')</th>
                        <th>@trans('purchase.purchase_quantity')</th>
                        <th>@trans('lang_v1.total_sold')</th>
                        <th>@trans('lang_v1.total_returned')</th>
                        <th>@trans('report.current_stock')</th>
                        <th>@trans('lang_v1.total_stock_price')</th>
                    </tr>
                </thead>
            </table>
        </div>
	</div>
</div>