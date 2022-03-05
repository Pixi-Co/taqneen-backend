<div style="width: 50px" >
    @if($subscription->is_expire == 1 && $subscription->is_renew != 1)
    <button class="btn w3-green" onclick="renewSubscription('{{ $subscription->id }}')" >
        @trans('renew')
    </button>
    @endif
</div>
