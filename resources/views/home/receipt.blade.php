 <div class="modal animate__animated animate__zoomIn" style="display: none" id="receiptModel" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-modal="true" style="display: block; padding-right: 16px;">
     <div class="modal-dialog modal-dialog-centered " role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">@trans('Catch/receipt document')</h5>

                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-md-3">
                         <b> {{ __('contact') }} </b>
                     </div>
                     <div class="col-md-9 w3-padding">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon hidden">
                                     <i class="fa fa-user"></i>
                                 </span>
                                 <input type="hidden" id="default_customer_id"
                                     value="{{ $walk_in_customer['id'] ?? '' }}">
                                 <input type="hidden" id="default_customer_name"
                                     value="{{ $walk_in_customer['name'] ?? '' }}">
                                 <input type="hidden" id="default_customer_balance"
                                     value="{{ $walk_in_customer['balance'] ?? '' }}">
                                 <input type="hidden" id="default_customer_address"
                                     value="{{ $walk_in_customer['shipping_address'] ?? '' }}">
                                 @if (!empty($walk_in_customer['price_calculation_type']) && $walk_in_customer['price_calculation_type'] == 'selling_price_group')
                                     <input type="hidden" id="default_selling_price_group"
                                         value="{{ $walk_in_customer['selling_price_group_id'] ?? '' }}">
                                 @endif
                                 {!! Form::select('contact_id', [], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 100%;display: none']) !!}
                                 <span class="input-group-addon  w3-green w3-round hidden"
                                     style="padding: 0px;border-radius: 7px">
                                     <button type="button" class="btn add_new_customer" data-name=""
                                         @if (!auth()->user()->can('customer.create')) disabled @endif><i class="fa fa-plus-circle fa-lg"></i></button>
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button 
                    type="button" 
                    class="btn btn-secondary" 
                    data-dismiss="modal">@trans('Cancel')</button>
                 
                 <a type="button" 
                    href="{{ url('/payments/pay-contact-due/') }}/270?type=sell" 
                    class="pay_sale_due btn w3-green" 
                    id="paybtn">@trans('pay')</a>
             </div>
         </div>
     </div>
 </div> 
