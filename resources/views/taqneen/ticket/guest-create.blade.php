
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<style>
    body{direction:rtl; color: #000;overflow-x: hidden;height: 100%;background-image: url('{{ url('/images/taqneen_login.jpg') }}')!important;background-repeat: no-repeat;background-size: cover}
    .card{padding: 15px;margin-top:15px;border: none !important;box-shadow: 0 6px 12px 0 rgba(0,0,0,0.2)}.blue-text{color: #00BCD4}.form-control-label{margin-bottom: 0}input, textarea, button{padding: 8px 15px;border-radius: 5px !important;margin: 5px 0px;box-sizing: border-box;border: 1px solid #ccc;font-size: 18px !important;font-weight: 300}input:focus, textarea:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;border: 1px solid #00BCD4;outline-width: 0;font-weight: 400}.btn-block{text-transform: uppercase;font-size: 15px !important;font-weight: 400;height: 43px;cursor: pointer}
    .btn-block:hover{color: #fff !important}button:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;outline-width: 0}
    label {
        float: right!important;
    }

</style>

<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11">
            <div class="card">
                <div class="row">
                    <h4>@trans('send_your_ticket')</h4>
                </div>
                <hr>
                @if(!empty(session('done')))
                    <h6 class="alert alert-success">
                        {{session('done')}}
                    </h6>
                @endif
                <form method="post" action="{{route('tickets.guest.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                            <label for="computer_number" class="form-label">@trans('computer_number')<b class="text-danger">*</b></label>
                            <input type="text" name="computer_num" class="form-control" id="computer_number" placeholder="700xxxxxxxxxxx">
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
                            <input type="text" name="client_email" class="form-control">
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
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">@trans('phone')</label>
                                <input type="text" name="client_phone" class="form-control" id="name">
                                @if($errors->has('client_phone'))
                                    <div class="text text-danger">
                                        {{$errors->first('client_phone')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <label for="name" class="form-label">@trans('ticket_department')<b class="text-danger">*</b></label>
                            <div class="form-group">
                                <select class="form-control" id="main_department">
                                    <option disabled selected>@lang('messages.please_select')</option>
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
                                    <option disabled selected>@lang('messages.please_select')</option>
                                    @if(count($subDepartments))
                                        @foreach($subDepartments as $sub_department)
                                            <option class="{{$sub_department->parent_id}}" value="{{$sub_department->id}}">{{$sub_department->name}}</option>
                                        @endforeach
                                    @endif

                                </select>

                                @if($errors->has('sub_department'))
                                    <div class="text text-danger">
                                        {{$errors->first('sub_department')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
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
                                    <input class="form-control" name="file" type="file" id="formFile">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="form-group col-sm-10"> <button type="submit" class="btn-block btn-primary pull-right">@trans('messages.save')</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
