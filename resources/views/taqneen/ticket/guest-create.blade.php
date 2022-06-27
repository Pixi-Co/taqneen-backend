
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
                <h4>Send Your Ticket</h4>
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
                            <label for="computer_number" class="form-label">@lang('support.computer_number')<b class="text-danger">*</b></label>
                            <input type="text" name="computer_num" value="{{$ip}}" class="form-control" id="computer_number" placeholder="700xxxxxxxxxxx">
                            @if($errors->has('computer_number'))
                                <div class="text text-danger">
                                    {{$errors->first('computer_number')}}
                                </div>
                            @endif
                        </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                            <label for="name" class="form-label">@lang('support.email')</label>
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
                            <label for="name" class="form-label">@lang('support.name')</label>
                            <input type="text" name="client_name" value="{{isset($authedUser)?$authedUser->name:''}}" class="form-control" id="name">
                            @if($errors->has('client_name'))
                                <div class="text text-danger">
                                    {{$errors->first('client_name')}}
                                </div>
                            @endif
                        </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">@lang('support.mobile')</label>
                                <input type="text" name="mobile" value="{{isset($authedUser)?$authedUser->mobile:''}}" class="form-control" id="name">
                                @if($errors->has('mobile'))
                                    <div class="text text-danger">
                                        {{$errors->first('mobile')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <label for="name" class="form-label">@lang('support.ticket_department')<b class="text-danger">*</b></label>
                            <div class="form-group">
                                <select class="form-control" id="main_department">
                                    <option>@lang('messages.please_select')</option>
                                    @if(count($mainDepartments))
                                        @foreach($mainDepartments as $mainDepartment)
                                            <option value="{{$mainDepartment->id}}">{{$mainDepartment->name}}</option>
                                        @endforeach
                                    @else
                                        <option>@lang('messages.please_select')</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <label for="name" class="form-label">@lang('support.sub_department')<b class="text-danger">*</b></label>
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
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group mb-3">
                                <label for="color" class="form-label">@lang('support.status_desc')<b class="text-danger">*</b></label>
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
                                    <label for="formFile" class="form-label">@lang('support.upload_file')</label>
                                    <input class="form-control" name="file" type="file" id="formFile">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">{{__('messages.save')}}</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
    function validate(val) {
        v1 = document.getElementById("fname");
        v2 = document.getElementById("lname");
        v3 = document.getElementById("email");
        v4 = document.getElementById("mob");
        v5 = document.getElementById("job");
        v6 = document.getElementById("ans");

        flag1 = true;
        flag2 = true;
        flag3 = true;
        flag4 = true;
        flag5 = true;
        flag6 = true;

        if(val>=1 || val==0) {
            if(v1.value == "") {
                v1.style.borderColor = "red";
                flag1 = false;
            }
            else {
                v1.style.borderColor = "green";
                flag1 = true;
            }
        }

        if(val>=2 || val==0) {
            if(v2.value == "") {
                v2.style.borderColor = "red";
                flag2 = false;
            }
            else {
                v2.style.borderColor = "green";
                flag2 = true;
            }
        }
        if(val>=3 || val==0) {
            if(v3.value == "") {
                v3.style.borderColor = "red";
                flag3 = false;
            }
            else {
                v3.style.borderColor = "green";
                flag3 = true;
            }
        }
        if(val>=4 || val==0) {
            if(v4.value == "") {
                v4.style.borderColor = "red";
                flag4 = false;
            }
            else {
                v4.style.borderColor = "green";
                flag4 = true;
            }
        }
        if(val>=5 || val==0) {
            if(v5.value == "") {
                v5.style.borderColor = "red";
                flag5 = false;
            }
            else {
                v5.style.borderColor = "green";
                flag5 = true;
            }
        }
        if(val>=6 || val==0) {
            if(v6.value == "") {
                v6.style.borderColor = "red";
                flag6 = false;
            }
            else {
                v6.style.borderColor = "green";
                flag6 = true;
            }
        }

        flag = flag1 && flag2 && flag3 && flag4 && flag5 && flag6;

        return flag;
    }
</script>
