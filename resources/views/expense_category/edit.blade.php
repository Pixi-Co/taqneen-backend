<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('ExpenseCategoryController@update', [$expense_category->id]), 'method' => 'PUT', 'id' => 'expense_category_add_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@trans( 'expense.edit_expense_category' )</h4>
    </div>

    <div class="modal-body">
     <div class="form-group">
        {!! Form::label('name', __( 'expense.category_name' ) . ':*') !!}
          {!! Form::text('name', $expense_category->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'expense.category_name' )]); !!}
      </div>

      <div class="form-group">
        {!! Form::label('code', __( 'expense.category_code' ) . ':') !!}
          {!! Form::text('code', $expense_category->code, ['class' => 'form-control', 'placeholder' => __( 'expense.category_code' )]); !!}
      </div>
      

      <div class="form-group">
        <div class="checkbox category-check-container">
            <label>
              {!! Form::checkbox('is_center_cost', 0, $expense_category->is_center_cost,[ 'class' => 'icheck', 'id' => 'is_center_cost' ]); !!} @trans( 'is cost center' )
            </label>
          </div>
      </div>

    <div class="modal-footer">
      <button type="submit" class="add_btn">@trans( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
 

@if ($expense_category->is_center_cost)
<script>
  $('#is_center_cost').iCheck('check');
</script>
@endif
