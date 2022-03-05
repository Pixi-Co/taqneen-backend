<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('ExpenseCategoryController@store'), 'method' => 'post', 'id' => 'expense_category_add_form' ]) !!}
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@trans( 'expense.add_expense_category' )</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('name', __( 'expense.category_name' ) . ':*') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'expense.category_name' )]); !!}
      </div>

      <div class="form-group">
        {!! Form::label('code', __( 'expense.category_code' ) . ':') !!}
          {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => __( 'expense.category_code' )]); !!}
      </div>
    </div>  

    <div class="form-group">
      <div class="checkbox category-check-container">
          <label>
            {!! Form::checkbox('is_center_cost', 0, false,[ 'class' => 'icheck', 'data-toggle_id' => '' ]); !!} 
            @trans( 'is cost center' )
          </label>
        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="add_btn">@trans( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

@include("layouts.js.icheck")
