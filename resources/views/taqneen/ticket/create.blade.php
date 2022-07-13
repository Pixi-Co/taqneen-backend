@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('breadcrumb-title')
    <h3>@trans('add_ticket')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item">
        <a href="{{route('tickets')}}">@trans('all_tickets')</a>
    </li>
    <li class="breadcrumb-item active">@trans('add_ticket')</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('tickets.store')}}" method="post" enctype="multipart/form-data">
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
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    @if(!empty(auth()->user())&&auth()->user()->user_type==\App\Enum\UserType::$USERCUSTOMER)
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="computer_number" class="form-label">@trans('computer_number')<b class="text-danger">*</b></label>
                                                <input type="text" name="computer_num" value="{{isset($authedUser)?$authedUser->custom_field1:''}}" class="form-control" id="computer_number" placeholder="700xxxxxxxxxxx">
                                                @if($errors->has('computer_number'))
                                                    <div class="text text-danger">
                                                        {{$errors->first('computer_number')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">@trans('email')</label>
                                                <input type="text" name="client_email" value="{{isset($authedUser)?$authedUser->email:''}}" class="form-control">
                                                @if($errors->has('client_email'))
                                                    <div class="text text-danger">
                                                        {{$errors->first('client_email')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">@trans('name')</label>
                                                <input type="text" name="client_name" value="{{isset($authedUser)?$authedUser->name:''}}" class="form-control" id="name">
                                                @if($errors->has('client_name'))
                                                    <div class="text text-danger">
                                                        {{$errors->first('client_name')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    @endif

                                    @if(!empty(auth()->user())&&auth()->user()->user_type==\App\Enum\UserType::$USER)
                                            <div class="col-xs-12 col-md-8" style="margin: 5px">
                                            <label for="name" class="form-label">@trans('client_name')<b class="text-danger">*</b></label>
                                            <div class="form-group">
                                                <select class="form-control select2" id="agent_id" name ="agent_id">
                                                    <option disabled selected>@trans('select_client')</option>
                                                </select>
                                                @if($errors->has('agent_id'))
                                                    <div class="text text-danger">
                                                        {{$errors->first('agent_id')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-6 col-md-6">
                                        <label for="name" class="form-label">@trans('ticket_department')<b class="text-danger">*</b></label>
                                        <div class="form-group">
                                            <select class="form-control" id="main_department">
                                                <option>@lang('messages.please_select')</option>
                                                @if(count($mainDepartments))
                                                    @foreach($mainDepartments as $mainDepartment)
                                                        <option value="{{$mainDepartment->id}}">{{$mainDepartment->name}}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-md-6">
                                        <label for="name" class="form-label">@trans('sub_department')<b class="text-danger">*</b></label>
                                        <div class="form-group">
                                            <select class="form-control sub_departments" name="sub_department">
                                                <option>@lang('messages.please_select')</option>
                                                @if(count($subDepartments))
                                                    @foreach($subDepartments as $sub_department)
                                                        <option class="{{$sub_department->parent_id}}" value="{{$sub_department->id}}">{{$sub_department->name}}</option>
                                                    @endforeach
                                                @else
                                                    <option>@lang('messages.please_select')</option>
                                                @endif

                                            </select>

                                            @if($errors->has('sub_department'))
                                                <div class="text text-danger">
                                                    {{$errors->first('sub_department')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12" style="margin: 5px">
                                        <div class="form-group mb-3">
                                            <label for="color" class="form-label">@trans('status_desc')<b class="text-danger">*</b></label>
                                            <textarea name="description" class="form-control"></textarea>
                                            @if($errors->has('description'))
                                                <p class="text text-danger">
                                                    {{$errors->first('description')}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-8" style="margin: 5px">
                                        <div class="form-group mb-3">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">@trans('upload_file')</label>
                                                <input class="form-control" name="files[]" type="file" id="formFile" multiple>
                                            </div>
                                        </div>
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
     <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
     <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
     <script src="{{ asset('assets/js/notify/index.js') }}"></script>
     <script>
        $( document ).ready(function() {

            $('select[name="sub_department"] option').not(':first').hide();
            $('#main_department').on('change', function() {
                $('select[name="sub_department"] option').not(':first').hide();
                $('.'+this.value+'').show();
            });
            $('#agent_id').select2({
                placeholder: 'search in users',
                ajax: {
                url: '/select2-autocomplete-ajax',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        searchInContacts:true,
                    };
                },
                processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.supplier_business_name +" / "+ item.custom_field1,
                            id: item.converted_by
                        }
                    })
                };
            },
                cache: true
            }
            });
        });
    </script>
@endsection
