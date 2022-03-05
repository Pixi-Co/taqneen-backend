<div style="width: 200px">
    <button type="button" data-href="{{ action('CashRegisterController@show', [$row->id]) }}"
        class="btn btn-xs btn-info btn-modal" data-container=".view_register">
        <i class="fas fa-eye" aria-hidden="true"></i> @trans("messages.view")
    </button>
    @if ($row->status != 'close' &&
    auth()->user()->can('close_cash_register'))<button type="button"
            data-href="{{ action('CashRegisterController@getCloseRegister', [$row->id]) }}"
            class="btn btn-xs btn-danger btn-modal" data-container=".view_register"><i class="fas fa-window-close"></i>
            @trans("messages.close")</button>
    @endif
    @if (session('business.common_settings.enable_export_money_to_safe_proccess') && $row->safe_status != 'user_receive_money')
        <button class="btn w3-green" onclick="updateCashRegister({{ $row->id }})">user received money</button>
    @endif
</div>
