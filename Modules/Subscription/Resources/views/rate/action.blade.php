<div style="width: 250px">
    @can('subscription.rates.update')
    <a href="#" onclick="editRate({{ json_encode($rate) }})" class="btn btn-xs btn-primary">
        <i class="fa fa-edit"></i> @trans("messages.edit")
    </a>
    @endcan
    <button data-href="#" onclick="rateLink('{{ $rate->rate_link }}')" class="btn btn-xs w3-green">
        <i class="fa fa-star"></i>
        @trans("rate link")
    </button>
    @can('subscription.measurements.delete')
    <button data-href="#" onclick="removeRate('{{ $rate->id }}')" class="btn btn-xs btn-danger delete_user_button">
        <i class="fa fa-trash"></i>
        @trans("messages.delete")
    </button>
    @endcan
</div>
