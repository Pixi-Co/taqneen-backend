<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('AccountController@update',$account->id), 'method' => 'PUT', 'id' => 'edit_payment_account_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@trans( 'account.edit_account' )</h4>
    </div>

    <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', __( 'lang_v1.name' ) .":*") !!}
                {!! Form::text('name', $account->name, ['class' => 'form-control', 'required','placeholder' => __( 'lang_v1.name' ) ]); !!}
            </div>

             <div class="form-group">
                {!! Form::label('account_number', __( 'account.account_number' ) .":*") !!}
                {!! Form::text('account_number', $account->account_number, ['class' => 'form-control', 'required','placeholder' => __( 'account.account_number' ) ]); !!}
            </div>


            <div class="form-group">
              <div class="checkbox category-check-container">
                  <label>
                    {!! Form::checkbox('is_for_discount', $account->is_for_discount, false,[ 'class' => 'icheck', 'id' => 'is_for_discount' ]); !!} @trans( 'is_for_discounts' )
                  </label>
                </div>
            </div>

            <div class="form-group">
              <div class="checkbox category-check-container">
                  <label>
                    {!! Form::checkbox('is_for_tax', 0, $account->is_for_tax,[ 'class' => 'icheck', 'id' => 'is_for_tax' ]); !!} @trans( 'is_for_taxs' )
                  </label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('account_type_id', __( 'account.account_type' ) .":") !!}
                {!! Form::hidden("account_type_id", null, ["class" => 'account_type_id']) !!}
                @include("layouts.js.jstree_option", ["id" => "js_tree_account_type_update", "selectedId" => $account->account_type_code]) 
            </div>

            <div class="form-group">
                {!! Form::label('note', __( 'brand.note' )) !!}
                {!! Form::textarea('note', $account->note, ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 4]); !!}
            </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@trans( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

@include("layouts.js.jtree", ["id" => "js_tree_account_type_update", "selectedId" => $account->account_type_code])


@if ($account->is_for_discount)
<script>
  $('#is_for_discount').iCheck('check');
</script>
@endif

@if ($account->is_for_tax)
<script>
  $('#is_for_tax').iCheck('check');
</script>
@endif
