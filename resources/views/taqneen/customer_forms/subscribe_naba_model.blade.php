
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

input[type='text'],input[type='date'],input[type='date']:focus,input[type="text"]:focus{
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
                <h2 class="gform_title">نبأ</h2>
                <span class="gform_description"></span>
                {{-- <p class="gform_required_legend">الحقول بعلامة (*) هي حقول مطلوبة</p> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <form class="form-group" action="{{ route('createcustomernaba.store') }}" method="post" enctype="multipart/form-data">
           @csrf
          @method('post')
            <input type="hidden" name="customer_type" value="{{ $instance::$SUBSCRIBE_NABA_MODEL_KEY }}">
            <div class="ginput_container ginput_container_checkbox">
                <legend class="gsection_title">الباقة </legend>
                <div class="gfield_checkbox" id="input_1_4">
                    <div class="gchoice" style="display: inline;">
                        <input class="gfield-choice-input" name="form[portal_naba][]" type="checkbox" value="بوابةنبأ"  id="portal_naba">
                        <label for="choice" >بوابة نبأ</label>
                    </div>
                    <div class="gchoice " style="display: inline;">
                        <input class="gfield-choice-input" name="form[portal_naba][]" type="checkbox" value="نبأالمباشرة" id="naba_live">
                        <label for="choice" >نبأ المباشرة</label>
                    </div>
                    <div class="gchoice " style="display: inline;">
                        <input class="gfield-choice-input" name="form[portal_naba][]" type="checkbox" value="نبأالأساسية" id="naba_main">
                        <label for="choice" > نبأ الأساسية</label>
                    </div>
                </div>
            </div>

            <div class="ginput_container ">
                <h3 class="gsection_title">بيانات المنشأة</h3>
                <div class="row" >
                    <div class="col-md-3" >
                        <label class="gfield_label pb-1" for="">رقم الحاسب الآلي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label>                       
                        <input class="form-control" name="form[pc_num]" type="text" value="" required placeholder="70xxxxxxxxxxx" id="pc_num" >
                        {{-- <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من  10 حرف كحد أقصى</div> --}}
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الإسم بالعربي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[name_ar]" type="text" value="" id="namr_ar">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الإسم بالانجليزي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[name_en]" type="text" value="" id="name_en">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">المدينة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[city]" type="text" value="" id="city">
                    </div> 
                    
                </div>
                <div class="row pt-3">
                    
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الهاتف
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[owner_phone]" type="text" value="" id="enterprise_phone" required>
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">موقع الشركة الالكتروني :
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[company_website]" type="text" value="" id="company_website" required placeholder="  ">
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني :
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[company_email]" type="text" value="" id="company_email" required placeholder="">
                    </div>
                    
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">أسم المالك
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[owner_name]" type="text" value="" id="phone" required>
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم السجل التجاري
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[commercial_number]" type="text" value="" id="commercial_number" required>
                    </div>
                    <div class="col-md-4 " >
                        <div class="row ">
                            <label class="gfield_label pb-1 " for="">تاريخ إنتهاء السجل التجاري
                                <span class="gfield_required">
                                    <span class="gfield_required gfield_required_custom">*</span>
                                </span>
                            </label> 
                            <div class="col-sm-10">
                                <input name="form[end_date]" id="end_date" type="date" value="" class="form-control  fc-datepicker" placeholder="yyyy/mm/dd" >
                            </div>
                            <div class="col-sm-2 pt-1">
                                <img class="ui-datepicker-trigger" src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg" alt="" title="">
                            </div>
                            
                            
                        </div>
                        
                    </div>
                    
                </div>
                <div class="row pt-3">
                    <h4 class="gsection_title pb-4">العنوان الوطني</h4>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">  رقم المبنى
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[building_num]" type="text" value="" id="building_num" required placeholder=" ">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الشارع
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[street]" type="text" value="" id="street" placeholder="" required>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الحي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[district]" type="text" value="" id="district" required>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">
                            الرمز البريدي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[postal_code]" type="text" value="" id="postal_code" required>
                    </div>
                </div>
                <div class="row pt-3">
                    <h4 class="gsection_title pb-4 pt-2"> معلومات مدير المنشأة</h4>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم الثلاثي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[leader_name]" type="text" value="" id="leader_name" required placeholder="">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[leader_idenitiy]" type="text" value="" id="leader_idenitiy" required placeholder="">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الجوال الاساسي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[leader_phone]" type="text" value="" id="leader_phone" required placeholder="">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهاتف الثانوي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[leader_phone2]" type="text" value="" id="leader_phone2" required>
                    </div>
                    <div class="col-sm-12 pt-3">
                        <label class="gfield_label pb-1" for="">البريد الالكتروني
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[leader_email]" type="text" value="" id="leader_email" required>
                    </div>
                    
                </div>
                <div class="row pt-3">
                    <h4 class="gsection_title pb-4 pt-2"> معلومات المستخدم الرئيسي  </h4>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم الثلاثي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_name]" type="text" value="" id="user_name" required placeholder="">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_idenitiy]" type="text" value="" id="user_idenitiy" required placeholder="">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الجوال الاساسي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_phone]" type="text" value="" id="user_phone" required placeholder="">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهاتف الثانوي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_phone2]" type="text" value="" id="user_phone2" required>
                    </div>
                    <div class="col-sm-12 pt-3">
                        <label class="gfield_label pb-1" for="">البريد الالكتروني
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_email]" type="text" value="" id="user_email" required>
                    </div>
                </div>
                <div class="row pt-3">
                    <h4 class="gsection_title pb-4 pt-2"> معلومات ممثلي المشترك   </h4>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم الثلاثي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[sub_represent_name]" type="text" value="" id="sub_represent_name" required placeholder="">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[sub_represent_idenitiy]" type="text" value="" id="sub_represent_idenitiy" required placeholder="">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الجوال الاساسي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[sub_represent_phone]" type="text" value="" id="sub_represent_phone" required placeholder="">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهاتف الثانوي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[sub_represent_phone2]" type="text" value="" id="sub_represent_phone2" required>
                    </div>
                    <div class="col-sm-12 pt-3">
                        <label class="gfield_label pb-1" for="">البريد الالكتروني
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[sub_represent_email]" type="text" value="" id="sub_represent_email" required>
                    </div>
                </div>

               
                <div class="row pt-3">
                    <h3 class="gsection_title"> المدة</h3>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">بيانات الاشتراك أن وجدت مثل (نوع الباقة - نوع الاشتراك)
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[sub_type]" type="text" value="" id="sub_type" required placeholder="">
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">بيانات التكلفة أن وجدت
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[cost_data]" type="text" value="" placeholder="" id="cost_data" required>
                    </div>
                    <div class="col-md-12 pt-3 " >
                        <label class="gfield_label pb-1" for="">سبب أستخدام الخدمة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[reason]" type="text" value="" placeholder="" id="reason" required>
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

