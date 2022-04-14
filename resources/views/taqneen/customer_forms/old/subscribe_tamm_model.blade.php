
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
    grid-column-gap: 19px;
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
<li class="breadcrumb-item">@trans('dashboard_')</li>
<li class="breadcrumb-item active">@trans('supportboard')</li> 
@endsection --}}

@section('content')  
<section class="subscribe-model container p-3 ">
    <div class="row ">
        <div class="col-md-12">
            <div class="gform_heading">
                <h2 class="gform_title">تم</h2>
                <span class="gform_description"></span>
                <p class="gform_required_legend">الحقول بعلامة (*) هي حقول مطلوبة</p>
            </div>
        </div>
    </div>
    <div class="row">
        <form class="form-group" action="{{ route('createcustomertamm.store') }}" method="post" enctype="multipart/form-data">
           @csrf
          @method('post')
          
          @if ($subscribe_customer->id)
          <input type="hidden" name="customer_type" value="{{ $instance::$EDIT_SUBSCRIBE_TAMMM_MODEL_KEY }}">
          @else
          <input type="hidden" name="customer_type" value="{{ $instance::$SUBSCRIBE_TAMMM_MODEL_KEY }}">
          @endif
          @if ($subscribe_customer->id)
          <input type="hidden" name="id" value="{{ $subscribe_customer->id }}" >
          @endif


            <div class="ginput_container ginput_container_checkbox">
                <legend class="gsection_title">نوع الطلب</legend>
                <div class="gfield_checkbox" id="input_1_4">
                    <div class="gchoice" style="display: inline;">
                        <label for="">
                            <input type="checkbox" name="form[choice_new_1]" {{ $subscribe_customer->id?optional($data)->choice_new_1? 'checked' : '' : '' }} value="{{ $subscribe_customer->id?optional($data)->choice_new_1? '1' : '0' : '0' }}" onchange="this.value = this.checked? '1' : '0'"  >
                            جديد                             
                        </label>  
                    </div>
                    <div class="gchoice " style="display: inline;">
                        <label for="">
                            <input type="checkbox" name="form[choice_new_2]" {{ $subscribe_customer->id?optional($data)->choice_new_2? 'checked' : '' : '' }} value="{{ $subscribe_customer->id?optional($data)->choice_new_2? '1' : '0' : '0' }}" onchange="this.value = this.checked? '1' : '0'"  >
                            تجديد                             
                        </label>  
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
                        {!! Form::number('form[company_num]', $subscribe_customer->id?$data->company_num:'', ["class" => 'form-control', "placeholder"=>"70xxxxxxx",'required']) !!}                      
                        {{-- <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من  10 حرف كحد أقصى</div> --}}
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم العربي الكامل للمنشأة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[name_ar]', $subscribe_customer->id?$data->name_ar:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم الإنجليزي الكامل للمنشأة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[name_en]', $subscribe_customer->id?$data->name_en:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">المدينة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[city]', $subscribe_customer->id?$data->city:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div> 
                    
                </div>
                <div class="row pt-3">
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">نوع المنشأة
                           
                        </label> 
                        <div class="gfield_checkbox" id="input_1_4">
                            <div class="gchoice" style="display: inline;"> 
                                <label for="">
                                    <input type="checkbox" name="form[company_type_1]" {{ $subscribe_customer->id?optional($data)->company_type_1? 'checked' : '' : '' }} value="{{ $subscribe_customer->id?optional($data)->company_type_1? '1' : '0' : '0' }}" onchange="this.value = this.checked? '1' : '0'"  >
                                    شركة                             
                                </label>    
                            </div>
                            <div class="gchoice " style="display: inline;">
                                <label for="">
                                    <input type="checkbox" name="form[company_type_2]" {{ $subscribe_customer->id?optional($data)->company_type_2? 'checked' : '' : '' }} value="{{ $subscribe_customer->id?optional($data)->company_type_2? '1' : '0' : '0' }}" onchange="this.value = this.checked? '1' : '0'"  >
                                    مؤسسة                             
                                </label>     
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">نشاط المؤسسة الرئيسي :
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[enterprise_activity]', $subscribe_customer->id?$data->enterprise_activity:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">اسم المالك :
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[owner_name]', $subscribe_customer->id?$data->owner_name:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الجوال :
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[owner_phone]', $subscribe_customer->id?$data->owner_phone:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">الهاتف
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[owner_phone2]', $subscribe_customer->id?$data->owner_phone2:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">ص.ب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[mailbox]', $subscribe_customer->id?$data->mailbox:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">الرمز البريدي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[postcode]', $subscribe_customer->id?$data->postcode:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">اسم مسؤول الإتصال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[person_name]', $subscribe_customer->id?$data->person_name:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">جوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[person_phone]', $subscribe_customer->id?$data->person_phone:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني لمسؤول الإتصال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::email('form[person_mail]', $subscribe_customer->id?$data->person_mail:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">جوال الإشعارات
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[phone_notfic]', $subscribe_customer->id?$data->phone_notfic:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني للإشعارات
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::email('form[mail_notfic]', $subscribe_customer->id?optional($data)->mail_notfic:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم السجل التجاري
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[commercial_number]', $subscribe_customer->id?$data->commercial_number:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-4 " >
                        <div class="row ">
                            <label class="gfield_label pb-1 " for="">تاريخ اصدار السجل التجاري
                                <span class="gfield_required">
                                    <span class="gfield_required gfield_required_custom">*</span>
                                </span>
                            </label> 
                            <div class="col-sm-10">
                                {!! Form::date('form[release_date]', $subscribe_customer->id?$data->release_date:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                            </div>
                            <div class="col-sm-2 pt-1">
                                <img class="ui-datepicker-trigger" src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg" alt="" title="">
                            </div>
                            
                            
                        </div>
                        
                        
                    </div>
                    <div class="col-md-4 " >
                        <div class="row ">
                            <label class="gfield_label pb-1 " for="">تاريخ نهاية السجل التجاري
                                <span class="gfield_required">
                                    <span class="gfield_required gfield_required_custom">*</span>
                                </span>
                            </label> 
                            <div class="col-sm-10">
                                {!! Form::date('form[end_date]', $subscribe_customer->id?$data->end_date:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                            </div>
                            <div class="col-sm-2 pt-1">
                                <img class="ui-datepicker-trigger" src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg" alt="" title="">
                            </div>
                            
                            
                        </div>
                        
                        
                    </div>
                </div>

                <div class="row pt-3">
                    <h3 class="gsection_title">التكلفة</h3>
                    <h3 class="gsection_title pb-4"> معلومات المستخدم الرئيسي  </h3>

                    <div class="col-md-4">
                        <label class="gfield_label pb-1" for="">لغة المستخدم
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <div class="gfield_checkbox" id="input_1_4">
                            <div class="gchoice" style="display: inline;"> 
                                <label for="">
                                    <input type="checkbox" name="form[lang_1]" {{ $subscribe_customer->id?optional($data)->lang_1? 'checked' : '' : '' }} value="{{ $subscribe_customer->id?optional($data)->lang_1? '1' : '0' : '0' }}" onchange="this.value = this.checked? '1' : '0'"  >
                                    العربية                             
                                </label>   
                            </div>
                            <div class="gchoice " style="display: inline;">
                                <label for="">
                                    <input type="checkbox" name="form[lang_2]" {{ $subscribe_customer->id?optional($data)->lang_2? 'checked' : '' : '' }} value="{{ $subscribe_customer->id?optional($data)->lang_2? '1' : '0' : '0' }}" onchange="this.value = this.checked? '1' : '0'"  >
                                    الإنجليزية                             
                                </label>  
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">الإسم بالعربي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[user_name_ar]', $subscribe_customer->id?$data->user_name_ar:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">الإسم بالإنجليزي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[user_name_en]', $subscribe_customer->id?$data->user_name_en:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                   
                    
                </div>

                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[user_identifi]', $subscribe_customer->id?$data->user_identifi:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">الجوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[user_phone]', $subscribe_customer->id?$data->user_phone:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::email('form[user_mail]', $subscribe_customer->id?$data->user_mail:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                </div>
                <div class="row pt-3">
                    <h3 class="gsection_title"> معلومات مقدم الطلب </h3>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">الاسم
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[applicant_name]', $subscribe_customer->id?$data->applicant_name:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">المنصب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[position]', $subscribe_customer->id?$data->position:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[identifi_number]', $subscribe_customer->id?$data->identifi_number:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">الجوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::number('form[applicant_phone]', $subscribe_customer->id?$data->applicant_phone:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">اسم المندوب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[delegate_name]', $subscribe_customer->id?$data->delegate_name:'', ["class" => 'form-control', "placeholder"=>"",'required']) !!}                      
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

