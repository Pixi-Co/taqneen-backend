
@can(find_or_create_p('dashboard.admin'))
@include("taqneen.home.admin")
@endcan

@if(auth()->user()->can(find_or_create_p('dashboard.courier')) && !auth()->user()->can(find_or_create_p('dashboard.admin')))
@include("taqneen.home.courier")
@endif


@if (!auth()->user()->can(find_or_create_p('dashboard.courier')) && !auth()->user()->can(find_or_create_p('dashboard.admin')))
@include("taqneen.home.no-dashboard")
@endif
