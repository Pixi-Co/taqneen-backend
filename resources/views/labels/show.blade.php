 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     <br>
     <h1>@trans('barcode.print_labels') @show_tooltip(__('tooltip.print_label'))</h1>
 </section>

 <div class="page-title hidden">
     {{ __('barcode.print_labels') }}
 </div>


 <!-- Main content -->
 <section class="content no-print">
     {!! Form::open(['url' => '#', 'method' => 'post', 'id' => 'preview_setting_form', 'onsubmit' => 'return false']) !!}

     <div class="w3-white w3-round w3-card-4 w3-padding">
         <div class="w3-large text-center">
             {{ __('product.add_product_for_labels') }}
         </div>
         <br>
         <div class="">
             <div class="" style="width: 60%;margin: auto">
                 <div class="form-group">
                     <div class="input- w3-display-container">
                         <div class="w3-display-topright w3-padding">
                             <i class="fa fa-search new-theme-text"></i>
                         </div>
                         {!! Form::text('search_product', null, ['class' => 'w3-input w3-round-xxlarge w3-light-gray', 'id' => 'search_product_for_label', 'placeholder' => __('lang_v1.enter_product_name_to_print_labels'), 'autofocus']) !!}
                     </div>
                 </div>
             </div>
             <br>
         </div>

         <div class="row">
             <div class="col-sm-8 col-sm-offset-2">
                 <table class="table table-bordered table-striped table-condensed" id="product_table">
                     <thead>
                         <tr class="new-theme-text">
                             <th>@trans( 'barcode.products' )</th>
                             <th>@trans( 'barcode.no_of_labels' )</th>
                             @if (request()->session()->get('business.enable_lot_number') == 1)
                                 <th>@trans( 'lang_v1.lot_number' )</th>
                             @endif
                             @if (request()->session()->get('business.enable_product_expiry') == 1)
                                 <th>@trans( 'product.exp_date' )</th>
                             @endif
                             <th>@trans('lang_v1.packing_date')</th>
                         </tr>
                     </thead>
                     <tbody>
                         @include('labels.partials.show_table_rows', ['index' => 0])
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

     <br>
     <div class="row">

         <div class="col-sm-6 w3-padding">
             <div class="w3-white w3-card-4 w3-round w3-padding">
                 <div class="text-center">
                     {{ __('barcode.info_in_labels') }}
                 </div>
                 <br>
                 <div class="w3-block ">
                     <div class="w3-margin-bottom">
                         <div class="checkbox">
                             <label>
                                 <input class="icheck" type="checkbox" checked name="print[name]" value="1"> <b>@trans(
                                     'barcode.print_name' )</b>
                             </label>
                         </div>
                     </div>
                     <div class="w3-margin-bottom">
                         <div class="checkbox">
                             <label>
                                 <input type="checkbox" checked name="print[variations]" value="1"> <b>
                                     @trans('barcode.print_variations' )</b>
                             </label>
                         </div>
                     </div>
                     <div class="w3-margin-bottom">
                         <div class="checkbox">
                             <label>
                                 <input type="checkbox" checked name="print[business_name]" value="1"> <b>@trans('barcode.print_business_name' )</b>
                             </label>
                         </div>
                     </div>
                     <div class="w3-margin-bottom">
                         @if (request()->session()->get('business.enable_lot_number') == 1)
                             <div class="checkbox">
                                 <label>
                                     <input type="checkbox" checked name="print[lot_number]" value="1"> <b>@trans('lang_v1.print_lot_number' )</b>
                                 </label>
                             </div>
                         @endif
                     </div>
                     <div class="w3-margin-bottom">
                         @if (request()->session()->get('business.enable_product_expiry') == 1)
                             <div class="checkbox">
                                 <label>
                                     <input type="checkbox" checked name="print[exp_date]" value="1"> <b>@trans('lang_v1.print_exp_date' )</b>
                                 </label>
                             </div>
                         @endif
                     </div>
                     <div class="w3-margin-bottom">
                         <div class="checkbox">
                             <label>
                                 <input type="checkbox" checked name="print[packing_date]" value="1"> <b>@trans('lang_v1.print_packing_date' )</b>
                             </label>
                         </div>
                     </div>
                     <div class="w3-margin-bottom">
                         <div class="checkbox">
                             <label>
                                 <input type="checkbox" checked name="print[price]" value="1" id="is_show_price">
                                 <b>@trans('barcode.print_price' )</b>
                             </label>
                         </div>
                     </div>
                     <div class="w3-margin-bottom" id="barcodeProductPrice">
                         <div class="form-group">
                             {!! Form::label('print[price_type]', __('barcode.show_price') . ':') !!}
                             <div class="">
                                 {!! Form::select('print[price_type]', ['inclusive' => __('product.inc_of_tax'), 'exclusive' => __('product.exc_of_tax')], 'inclusive', ['class' => 'form-control']) !!}
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-sm-6 w3-padding">
             <div class="w3-white w3-card-4 w3-round w3-padding">
                 <div class="w3-block">
                     <div class="form-group">
                         {!! Form::label('price_type', __('barcode.barcode_setting') . ':') !!}
                         <div class="input-group">
                             {!! Form::select('barcode_setting', $barcode_settings, null, ['class' => 'form-control']) !!}
                         </div>
                     </div>
                 </div>

                 <div class="w3-block">
                     <div class="hide display_label_div">
                         <h3 class="box-title">@trans( 'barcode.preview' )</h3>
                         <button type="button" class="col-sm-offset-2 btn btn-success btn-block"
                             id="print_label">Print</button>
                     </div>
                 </div>

                 <div class="w3-block">
                     <button type="button" id="labels_preview" class="add_btn w3-block">
                         @trans('barcode.preview' )
                     </button>
                 </div>

             </div>
         </div>

     </div>

     {!! Form::close() !!}

     <div class="clearfix"></div>
 </section>

 <!-- Preview section-->
 <div id="preview_box">
 </div>

 <script src="{{ asset('js/labels.js?v=' . $asset_v) }}"></script>
 <script>
     $('input[type=checkbox]').iCheck({
         checkboxClass: 'icheckbox_flat-green',
         radioClass: 'iradio_flat-green'
     });
     $('#is_show_price').on('ifClicked', function(event) {
         $('#is_show_price').iCheck('check', function() {
             console.log('checked');
             $('#barcodeProductPrice').slideDown(500);
         });
         $('#is_show_price').iCheck('uncheck', function() {
             console.log('unchecked');
             $('#barcodeProductPrice').slideUp(500);
         });
     });
 </script>
