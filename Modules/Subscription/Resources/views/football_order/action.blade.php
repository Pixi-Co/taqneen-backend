<div style="width: 230px">
    @can('subscription.football_orders.update')
    <!--
        <a href="#" onclick="editFootballOrder({{ json_encode($football_order) }})" class="btn btn-xs btn-primary">
            <i class="fa fa-edit"></i> @trans("messages.edit")
        </a>
    -->
    @endcan
    @can('subscription.football_orders.delete')
        <button data-href="#" onclick="removeFootballOrder('{{ $football_order->id }}')"
            class="btn btn-xs btn-danger delete_user_button">
            <i class="fa fa-trash"></i>
            @trans("messages.delete")
        </button>
    @endcan
</div>
