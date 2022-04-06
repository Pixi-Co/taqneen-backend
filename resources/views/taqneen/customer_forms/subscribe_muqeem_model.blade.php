
@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
<style>
.gfield_checkbox{
    display: grid;
    -ms-grid-columns: (1fr) [ 3 ];
    grid-template-columns: repeat(3,1fr);
    grid-column-gap: 32px;
}

input[type='text'],
input[type='date'],
input[type='date']:focus,
input[type="text"]:focus,
input[type='number'],
input[type='number']:focus,
input[type='email'],
input[type='email']:focus,
input[type='url'],
input[type='url']:focus
{
    border-color: #ebebeb;
    background-color: #f8f8f8;
    color: #969696;
}
input[type="text"]:focus{
    box-shadow: 0px 0px 2px 0px rgb(0 0 0 / 20%);
}

label {
    font-weight: bold;
    font-size: 0.92em;
}
.gform_wrapper.gravity-theme .ginput_container_date {
    display: flex;
    align-items: center;
    align-content: flex-start;
}
html[dir=rtl] .gform_wrapper.gravity-theme .ginput_container_date img.ui-datepicker-trigger {
    margin-right: 12.8px
px
;
    margin-left: 0;
    order: 1;
}

input[type=submit] {
    color: #FFFFFF;
    background: #d45b24;
    font-size: 19px;
    letter-spacing: 1px;
    text-transform: uppercase;
    float: right;
    height: 50px;
    border: none;
    border-radius: 5px;
    margin-left: 12px;
    transition: 0.3s;
    }
input[type=submit]:hover{
    background: #134474;
    color: #FFFFFF
}

.subscribe-model{
    background: #fff;
}
</style>
@endsection

{{-- @section('breadcrumb-title')
<h3>@trans('supportboard')</h3>
@endsection --}}

{{-- @section('breadcrumb-items')
<li class="breadcrumb-item">@trans('lang.Dashboard')</li>
<li class="breadcrumb-item active">@trans('supportboard')</li> 
@endsection --}}

@section('content') 
<section class="subscribe-model container p-3 ">
    <div class="row ">
        <div class="col-md-12">
            <div class="gform_heading">
                <h2 class="gform_title">مقيم</h2>
                <span class="gform_description"></span>
                <p class="gform_required_legend">الحقول بعلامة (*) هي حقول مطلوبة</p>
            </div>
        </div>
    </div>
    <div class="row">
        <form class="form-group" action="{{ route('createCustomerMuqeem.store') }}" method="post" enctype="multipart/form-data">
           @csrf
          @method('post')
          @if ($subscribe_customer->id)
          <input type="hidden" name="customer_type" value="{{ $instance::$INFO_SUBSCRIBE_MUQEEM_MODEL_KEY }}">
          @else
          <input type="hidden" name="customer_type" value="{{ $instance::$SUBSCRIBE_MUQEEM_MODEL_KEY }}">
          @endif
          @if ($subscribe_customer->id)
          <input type="hidden" name="id" value="{{ $subscribe_customer->id }}" >
          @endif

            <div class="ginput_container ginput_container_checkbox">
                <legend class="gsection_title">فئة الاشتراك</legend>
                <div class="gfield_checkbox" id="input_1_4">
                    <div class="gchoice" style="display: inline;">
                        <input class="gfield-choice-input" name="form[choice][]" type="checkbox" value="شامل" checked="checked" id="choice">
                        <label for="choice" >شامل</label>
                    </div>
                    <div class="gchoice " style="display: inline;">
                        <input class="gfield-choice-input" name="form[choice][]" type="checkbox" value="عمليات" id="choice">
                        <label for="choice" >عمليات</label>
                    </div>
                </div>
            </div>

            <div class="ginput_container ">
                <h3 class="gsection_title">بيانات المنشأة</h3>
                <div class="row" >
                    <div class="col-md-3" >
                        <label class="gfield_label pb-1" for="">رقم المنشأة بوزارة الداخلية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label>     
                        {!! Form::number('form[company_num]', $subscribe_customer->id?$data->company_num:'', ["class" => "form-control", "required" ,"placeholder" => '123xxxxxxx']) !!}                  
                        <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من  10 حرف كحد أقصى</div>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم العربي الكامل للمنشأة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[name_ar]', $subscribe_customer->id?$data->name_ar:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}  
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم الإنجليزي الكامل للمنشأة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[name_en]', $subscribe_customer->id?$data->name_en:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">المدينة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[city]', $subscribe_customer->id?$data->city:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                   
                    
                </div>
                <div class="row pt-3">
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الهاتف
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[phone]', $subscribe_customer->id?$data->phone:'', ["class" => "form-control", "required" ,"placeholder" => '123xxxxxxx']) !!}
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">ص.ب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[mailbox]', $subscribe_customer->id?$data->mailbox:'', ["class" => "form-control", "required" ,"placeholder" => '123xxxxxxx']) !!}
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الرمز البريدي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[postcode]', $subscribe_customer->id?$data->postcode:'', ["class" => "form-control", "required" ,"placeholder" => '123xxxxxxx']) !!}
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">اسم مدير الموارد البشرية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[hr_name]', $subscribe_customer->id?$data->hr_name:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">جوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[mobile_num]', $subscribe_customer->id?$data->mobile_num:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني للموارد البشرية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::email('form[email]', $subscribe_customer->id?$data->email:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">جوال الإشعارات
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[phone_notfic]', $subscribe_customer->id?$data->phone_notfic:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني للإشعارات
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::email('form[mail_notific]', $subscribe_customer->id?$data->mail_notific:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم السجل التجاري
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[commercial_number]', $subscribe_customer->id?$data->commercial_number:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                    <div class="col-md-3 " >
                        <div class="row ">
                            <label class="gfield_label pb-1 " for="">تاريخ إصدار السجل
                                <span class="gfield_required">
                                    <span class="gfield_required gfield_required_custom">*</span>
                                </span>
                            </label> 

                            <div class="col-sm-10">
                                {!! Form::date('form[release_date]', $subscribe_customer->id?$data->release_date:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                            </div>

                            <div class="col-sm-2 pt-1">
                                <img class="ui-datepicker-trigger" src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg" alt="" title="">
                            </div>
                            
                            
                        </div>
                        
                        
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">اسم المدير
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[manager_name]', $subscribe_customer->id?$data->manager_name:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>

                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">جوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[manager_phone]', $subscribe_customer->id?$data->manager_phone:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                    
                </div>

                <div class="row pt-3">
                    <h3 class="gsection_title"> معلومات المستخدم الرئيسي  </h3>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">اسم المستخدم الرئيسي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[user_name]', $subscribe_customer->id?$data->user_name:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>

                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[id_number]', $subscribe_customer->id?$data->id_number:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>

                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الجوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[user_phone]', $subscribe_customer->id?$data->user_phone:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::email('form[user_mail]', $subscribe_customer->id?$data->user_mail:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>

                    
                </div>
                <div class="row pt-3">
                    <h3 class="gsection_title"> مقدم الطلب  </h3>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">الاسم
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label>
                        {!! Form::text('form[name]', $subscribe_customer->id?$data->name:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!} 
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">المنصب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[position]', $subscribe_customer->id?$data->position:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                    <div class="col-md-12 " >
                        <label class="gfield_label pb-1" for="">اسم المندوب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[delegate_name]', $subscribe_customer->id?$data->delegate_name:'', ["class" => "form-control", "required" ,"placeholder" => '']) !!}
                    </div>
                 
                    
                </div>
            </div>

            <br>
            <input type="submit" class="btn gform_button button" value="أشترك الأن">
        </form>
    </div>
    
</section>

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

