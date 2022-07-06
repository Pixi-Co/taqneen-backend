@can(find_or_create_p('opportunity.edit'))
    <a role="button"
       href="/opportunities/{{ $opportunit->id }}/edit"
       class="m-1 btn btn-primary btn-sm">@trans('edit')</a>
@endcan
@can(find_or_create_p('opportunity.delete'))
    <button
            onclick="destroy('/opportunities/{{ $opportunit->id }}')"
            class="m-1 btn btn-danger bt-sm">@trans('remove')</button>
@endcan

