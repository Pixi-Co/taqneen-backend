<div class="modal fade" id="mobile_product_suggestion_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<!-- Edit Order tax Modal -->
	<div class="modal-dialog modal-lg" style="min-width: 90%" role="document">
		<div class="modal-content w3-white">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				@include('sale_pos.partials.pos_sidebar')
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">@trans('messages.close')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
