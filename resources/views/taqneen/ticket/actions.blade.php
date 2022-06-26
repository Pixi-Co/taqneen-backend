@can(find_or_create_p('ticket.edit'))
    <a role="button" href="{{route('tickets.edit',$ticket->id)}}" class="btn btn-warning-gradien btn-sm"><i class="fa fa-edit"></i></a>
@endcan
@can(find_or_create_p('ticket.show'))
    <a role="button" href="{{route('tickets.show',$ticket->id)}}" class="btn btn-info-gradien btn-sm"><i class="fa fa-eye"></i></a>
@endcan
@can(find_or_create_p('ticket.delete'))
    <button onclick="destroy('{{route("tickets.delete",$ticket->id)}}')" class="btn btn-danger-gradien btn-xs"><i class="fa fa-trash"></i></button>
@endcan

@can(find_or_create_p('ticket.print'))
    <a role="button" href="{{route('tickets.print',$ticket->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
@endcan

