@can(find_or_create_p('customer.edit'))
    <a role="button" href="/customers/{{ $item->id }}/edit" class="m-1 btn btn-primary btn-sm">@trans('edit')</a>
@endcan
@can(find_or_create_p('customer.show'))
    <a role="button" href="/customers/{{ $item->id }}" class="m-1 btn btn-primary btn-sm">@trans('show')</a>
@endcan
@can(find_or_create_p('customer.delete'))
    <button onclick="destroy('/customers/{{ $item->id }}')" class="m-1 btn btn-danger bt-sm">@trans('remove')</button>
@endcan
