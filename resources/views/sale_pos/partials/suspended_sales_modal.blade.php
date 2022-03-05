<!-- Edit Order tax Modal -->
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@trans('lang_v1.suspended_sales')</h4>
		</div>
		<div class="modal-body w3-light-gray">
			<div class="row">
				@php
					$c = 0;
					$subtype = '';
				@endphp
				@if(!empty($transaction_sub_type))
					@php
						$subtype = '?sub_type='.$transaction_sub_type;
					@endphp
				@endif
				@forelse($sales as $sale)
					@if($sale->is_suspend)
						<div class="col-xs-12 col-sm-3">
							<div class="small-box w3-white w3-round new-shadow">
								<div class="w3-block w3-round" 
								style="height: 80px;background-image: url('/images/suspend.png');background-size: 50%;background-repeat: no-repeat;background-position: center;background-color: #3bbb8242" >

								</div>
								<ul class="w3-ul">
						            @if(!empty($sale->additional_notes))
									<li>
										<i class="fa fa-sticky-note w3-text-green"></i> {{$sale->additional_notes}}
									</li>
						            @endif
									<li>
										<i class="fa fa-barcode w3-text-green"></i> {{$sale->invoice_no}}
									</li>
									<li>
										<i class="fa fa-calendar w3-text-green"></i> {{@format_date($sale->transaction_date)}}
									</li>
									<li>
										<i class="fa fa-user w3-text-green"></i> {{$sale->name}}
									</li>
									<li>
										<i class="fa fa-cubes w3-text-green"></i> {{count($sale->sell_lines)}} @trans('item')
									</li>
									<li>
										<i class="fa fa-money-bill-alt w3-text-green"></i> <span class="display_currency" data-currency_symbol=true>{{$sale->final_total}}</span>
									</li>
									@if($is_tables_enabled && !empty($sale->table->name))
									<li>
										<i class="fa fa-cutlery w3-text-green"></i> @trans('restaurant.table') : {{$sale->table->name}}
									</li>
									@endif
									@if($is_service_staff_enabled && !empty($sale->service_staff))
									<li>
										<i class="fa fa-trophy w3-text-green"></i> @trans('restaurant.service_staff') : {{$sale->service_staff->user_full_name}}
									</li>
									@endif
									<li class="w3-center text-center" >
										<a 
										data-title="@trans('sale.edit_sale')"
										data-toggle="tooltip"
										 href="{{action('SellPosController@edit', ['id' => $sale->id]).$subtype}}" class="btn">
											<i class="fa fa-edit w3-text-deep-orange"></i>
										</a>
										<a 
											data-title="@trans('messages.delete')"
											data-toggle="tooltip"
										href="{{action('SellPosController@destroy', ['id' => $sale->id])}}" class="btn delete-sale is_suspended">
											<i class="fa fa-trash w3-text-red"></i>
										</a>
 									</li>
								</ul> 
					         </div>
				         </div>
				        @php
				         	$c++;
				        @endphp
					@endif

					@if($c%4==0)
						<div class="clearfix"></div>
					@endif
				@empty
					<p class="text-center">@trans('purchase.no_records_found')</p>
				@endforelse
			</div>
		</div>
		<div class="modal-footer">
		    <button type="button" class="btn btn-default" data-dismiss="modal">@trans('messages.close')</button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
	
    //Delete Sale
    $(document).on('click', '.delete-sale', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).attr('href');
                var is_suspended = $(this).hasClass('is_suspended');
                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            if (typeof sell_table !== 'undefined') {
                                sell_table.ajax.reload();
                            }
                            if (typeof pending_repair_table !== 'undefined') {
                                pending_repair_table.ajax.reload();
                            }
                            //Displays list of recent transactions
                            if (typeof get_recent_transactions !== 'undefined') {
                                get_recent_transactions('final', $('div#tab_final'));
                                get_recent_transactions('draft', $('div#tab_draft'));
                            }
                            if (is_suspended) {
                                $('.view_modal').modal('hide');
                            }
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
</script>
