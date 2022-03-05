 <!-- Main content -->
 <section class="">
     {!! Form::open(['url' => action('OpeningStockController@save'), 'method' => 'post', 'id' => 'add_opening_stock_form']) !!}
     {!! Form::hidden('product_id', $product->id) !!}
     @include('opening_stock.form-part')
     <div class="row">
         <div class="col-sm-12">
             <button type="submit" class="btn btn-primary pull-right">@trans('messages.save')</button>
         </div>
     </div>

     {!! Form::close() !!}
 </section>
 <script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
