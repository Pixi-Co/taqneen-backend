@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
<h3>@trans('users')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">@lang('lang.Dashboard')</li>
<li class="breadcrumb-item active">@trans('users')</li> 
@endsection

@section('content') 
    <div class="container-fluid">
        <div class="row"> 
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">

                 </div><!-- /.container-fluid -->
                </section>
                <section>
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                  
                                        <div class="container rounded bg-white mt-5 mb-5">
                                            <div class="row">
                                                <div class="col-md-3 border-right">
                                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                                        <img class="rounded-circle mt-5" width="150px" src="{{ $user->custom_fuild_1?$user->image_path:'https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg' }}">
                                                        <span class="font-weight-bold">{{ $user->first_name . $user->last_name }}</span><span class="text-black-50">{{ $user->email }}</span><span>
                                                        {{-- <a class="btn btn-primary"  href="">متابعت العميل</a> --}}
                                                    </span></div>
                                                </div>
                                                <div class="col-md-9 border-right">
                                                   <form action="{{ route('user-profile-update.updateProfile',$user->id)  }}" method="POST">
                                                      @csrf
                                                     @method('put')
                                                    <div class="p-3 py-5">
                                                        {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <h4 class="text-right">Profile Settings</h4>
                                                        </div> --}}
                                                        <div class="row mt-2">
                                                            <div class="col-md-6"><label class="labels">@trans('first name')</label><input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required></div>
                                                            <div class="col-md-6"><label class="labels"> @trans('last name')</label><input type="text" class="form-control" name="last_name" value=" {{ $user->last_name }}" required></div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-12"><label class="labels">@trans('mobile')</label><input type="text" class="form-control" name="contact_number"  value="{{ $user->contact_number }}" required></div>
                                                            <div class="col-md-12 mt-3"><label class="labels">@trans('email')</label><input type="text" class="form-control" name="email" value="{{ $user->email }}" required></div>
                                                            {{-- <div class="row mt-3">
                                                                <div class="col-md-6"><label class="labels">الدولة</label><input type="text" class="form-control" name="country"  value="{{ $user->country }}"></div>
                                                                <div class="col-md-6"><label class="labels">المدينة</label><input type="text" class="form-control" name="city" value="{{ $user->city }}" ></div>
                                                            </div> --}}
                                                            <div class="col-md-12 mt-3"><label class="labels">@trans('address')</label><input type="text" class="form-control" name="address" value="{{ $user->address }}"></div>
                                                            <div class="form-group col-md-12 pt-3">
                                                                <label>@trans('select roles  ')</label>
                                                                <select name="roles" id="" class="form-select" required>
                                                                   @if ($user->id)
                                                                   <option class="form-control" name="role" value="{{ $userRole }}">{{ $userRole}}</option>
                                                                   @else
                                                                   <option class="form-control" value="role" selected disabled>-- @trans('role') --</option>
                                                                   @endif
                                                                    
                                                                    @foreach ($roles as $role )
                                                                    <option class="form-control" name="role_name" value="{{ $role }}"  >{{ $role }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>                                     
                                                            <div class="col-md-12 mt-3"><label class="labels">@trans('password')</label><input type="password" class="form-control" name="password" ></div>
                                                            <div class="col-md-12 mt-3"><label class="labels">@trans('confirm password')</label><input type="password" name="confirm_password" class="form-control"  value=""></div>
                                                            
                                                        </div>
                                                        
                                                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">حفظ</button></div>
                                                    </div>
                                                   </form>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="p-3 py-5">
                                                        {{-- <div class="d-flex justify-content-between align-items-center experience"><span>الاشتراكات</span></div><br> --}}
                                                        {{-- <div class="col-md-12"><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                                                        <div class="col-md-12"><input type="text" class="form-control" placeholder="additional details" value=""></div> --}}
                                                        <div class=" col-md-12">
                                                    {{-- <div class="row">
                                                        <div class="card  " style="width: 18rem;">
                                                            <img src="{{asset('assets/images/opportunities/muqemm.jpg')}}" class="card-img-top" alt="...">
                                                            <div class="card-body">
                                                              <h5 class="card-title">خدمة مقيم</h5>
                                                              <p class="card-text">
                                                                <h6>تاريخ الاشتراك:12/2/2021</h6>
                                                                <h6>تاريخ الانتهاء:12/2/2022</h6>
                                                              </p>
                                                            </div>
                                                        </div>
                                                        <div class="card " style="width: 18rem;">
                                                            <img src="{{asset('assets/images/opportunities/tamm.jpg')}}" class="card-img-top" alt="...">
                                                            <div class="card-body">
                                                                  <h5 class="card-title">خدمة تم</h5>
                                                                  <p class="card-text">
                                                                    <h6>تاريخ الاشتراك:12/2/2021</h6>
                                                                    <h6>تاريخ الانتهاء:12/2/2022</h6>
                                                                  </p>
                                                            </div>
                                                        </div>          
                                                        <div class="card " style="width: 18rem;">
                                                            <img src="{{asset('assets/images/opportunities/shmos.jpg')}}" class="card-img-top" alt="...">
                                                            <div class="card-body">
                                                                <h5 class="card-title">خدمة شموس</h5>
                                                                <p class="card-text">
                                                                    <h6>تاريخ الاشتراك:12/2/2021</h6>
                                                                    <h6>تاريخ الانتهاء:12/2/2022</h6>
                                                                </p>      
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
        
                            </div>
                        </div><!-- /.container-fluid -->

                      </section>

                </section>
            </div>

        </div>
    </div>
<script type="text/javascript">
var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection




@section('script')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection
