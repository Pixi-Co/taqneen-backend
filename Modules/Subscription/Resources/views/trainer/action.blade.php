<div style="width: 350px">
    @can('subscription.trainers.update')
        <a href="#" onclick="editTrainer({{ json_encode($trainer) }})" class="btn btn-xs btn-primary">
            <i class="fa fa-edit"></i> @trans("messages.edit")
        </a> 
    @endcan
    @can('subscription.trainers.show')
        <a href="{{ url('/sub/trainer/show') }}/{{ $trainer->id }}"  class="btn btn-xs btn-info"><i class="fa fa-eye"></i> @trans("view")</a>
    @endcan
        <a href="#" onclick="rateTrainerLink('{{ $trainer->rate_link }}')" class="btn btn-xs btn-info"><i class="fa fa-star"></i> @trans("rate link")</a>
    
    @can('subscription.trainers.delete')
        <button data-href="#" onclick="removeTrainer('{{ $trainer->id }}')" class="btn btn-xs btn-danger delete_user_button">
            <i class="fa fa-trash"></i>
            @trans("messages.delete")
        </button>
    @endcan
</div>
