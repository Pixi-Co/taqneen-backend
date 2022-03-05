<div style="width: 230px">
    @can('subscription.sessions.update')
        <a href="#" onclick="editSession({{ json_encode($session) }})" class="btn btn-xs btn-primary">
            <i class="fa fa-edit"></i> @trans("messages.edit")
        </a>
    @endcan
    @can('subscription.sessions.show')
        <button data-href="#" onclick="showSession('{{ $session->id }}')" class="btn btn-xs w3-green">
            <i class="fa fa-eye"></i>
            @trans("show")
        </button>
    @endcan
    @can('subscription.sessions.delete')
        <button data-href="#" onclick="removeSession('{{ $session->id }}')"
            class="btn btn-xs btn-danger delete_user_button">
            <i class="fa fa-trash"></i>
            @trans("messages.delete")
        </button>
    @endcan
</div>
