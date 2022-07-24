@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('breadcrumb-title')
    <h3>@lang('support.ticket_departments')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard')</li>
    <li class="breadcrumb-item">
        <a href="{{route('tickets.departments')}}">@trans('support.ticket_departments')</a>
    </li>
    <li class="breadcrumb-item active">@trans('support.edit_ticket_departments')</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{route('tickets.departments.update',$ticketDepartment->id)}}" method="post" >
            @csrf
            <div class="row">
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">

                        </div><!-- /.container-fluid -->
                    </section>
                    <section class="content">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li class="text-bold">{{$error}}</li>
                                                    @endforeach
                                                </ul>

                                            </div>
                                        @endif
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">@trans('support.department_name')</label>
                                                <input type="text" name="name" class="form-control" id="name" value="{{$ticketDepartment->name}}">
                                                @if($errors->has('name'))
                                                    <div class="text text-danger">
                                                        {{$errors->first('name')}}
                                                    </div>
                                                @endif
                                            </div>

                                            @if(isset($ticketDepartment->subDepartmentsWithPriorty))
                                                <div class="form-group mb-3">
                                                    <label for="name" class="form-label text-bold text-info">@trans('support.department_titles')</label>
                                                    <fieldset class="ticket-titles" style="border: 1px dashed #e88446">
                                                        <div class="row targetDiv" id="div0">
                                                            <div class="col-md-12">
                                                                <div id="group1" class="title_duplicate">
                                                                    @foreach($ticketDepartment->subDepartmentsWithPriorty as $row)
                                                                        <div class="row entry">
                                                                            <div class="col-xs-12 col-md-4" style="margin: 5px">
                                                                                <div class="form-group">
                                                                                    <input class="form-control" name="department_titles[]" value="{{$row->name}}" type="text" placeholder="department-title">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-xs-12 col-md-3" style="margin: 5px">
                                                                                <div class="form-group">
                                                                                    <select class="form-control" name="titles_priorities[]">
                                                                                        @foreach($periorites as $periorty)
                                                                                            <option value="{{$row->priority_id}}" {{$periorty->id==$row->priority_id?'selected':''}}>{{$periorty->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xs-12 col-md-1" style="margin: 5px">
                                                                                <div class="form-group">
                                                                                    <button type="button" class="btn-xs btn-success btn-sm btn-add">
                                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-12 my-3">
                    <input type="submit" value="@trans('submit')" class="btn btn-primary float-right" data-bs-original-title="" title="">
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        import Init from "../../../../../public/js/init";
        var session_layout = '{{ session()->get('layout') }}';
        export default {
            components: {Init}
        }
    </script>
@endsection

@section('script')
    <script>
        $( document ).ready(function() {

            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();
                var controlForm = $(this).closest('.ticket-titles'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);
                newEntry.find('input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<i class="fa fa-minus" aria-hidden="true"></i>');
            }).on('click', '.btn-remove', function(e) {
                $(this).closest('.entry').remove();
                return false;
            });
        });
    </script>
@endsection
