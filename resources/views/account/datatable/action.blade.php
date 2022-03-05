<button data-href="{{action('AccountController@edit',[$row->id])}}" data-container=".account_model"
    class="btn btn-xs btn-primary btn-modal"><i class="glyphicon glyphicon-edit"></i> @trans("messages.edit")</button>
<a href="{{action('AccountController@show',[$row->id])}}" class="btn btn-warning btn-xs"><i class="fa fa-book"></i>
    @trans("account.account_book")</a>&nbsp;
@if($row->is_closed == 0)
<button data-href="{{action('AccountController@getFundTransfer',[$row->id])}}" class="btn btn-xs btn-info btn-modal"
    data-container=".view_modal"><i class="fa fa-exchange"></i> @trans("account.fund_transfer")</button>

<button data-href="{{action('AccountController@getDeposit',[$row->id])}}" class="btn btn-xs btn-success btn-modal"
    data-container=".view_modal"><i class="fas fa-money-bill-alt"></i> @trans("account.deposit")</button>
@if ($row->balance <= 0)
<button data-url="{{action('AccountController@close',[$row->id])}}" class="btn btn-xs btn-danger close_account"><i
        class="fa fa-power-off"></i> @trans("deactive")</button>
@endif

@elseif($row->is_closed == 1)
<button data-url="{{action('AccountController@activate',[$row->id])}}" class="btn btn-xs btn-success activate_account"><i
        class="fa fa-power-off"></i> @trans("messages.activate")</button>
@endif
