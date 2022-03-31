
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
                <h2 class="gform_title">مسارات</h2>
                <span class="gform_description"></span>
                <p class="gform_required_legend">الحقول بعلامة (*) هي حقول مطلوبة</p>
            </div>
        </div>
    </div>
    <div class="row">
        <form class="form-group" action="{{ route('createCustomerMasarat.store') }}" method="post" enctype="multipart/form-data">
           @csrf
          @method('post')
            <div class="ginput_container ">
                <input type="hidden" name="customer_type" value="{{ $instance::$SUBSCRIBE_MASARAT_MODEL_KEY }}">
                <h4 class="gsection_title">بيانات المنشأة</h4>
                <div class="row" >
                    <div class="col-md-3" >
                        <label class="gfield_label pb-1" for="">الرقم بوزارة الداخلية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label>                       
                        <input class="form-control" name="form[company_num]" type="text" value="70" required placeholder="70xxxxxxxxxxx" id="company_num" >
                        <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من  10 حرف كحد أقصى</div>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم السجل التجاري
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[commercial_number]" type="text" value="" id="commercial_number" required>
                    </div> 
                    <div class="col-md-3 " >
                        <div class="row ">
                            <label class="gfield_label pb-1 " for="">تاريخ إصدار السجل التجاري
                                <span class="gfield_required">
                                    <span class="gfield_required gfield_required_custom">*</span>
                                </span>
                            </label> 
                            <div class="col-sm-10">
                                <input name="form[release_date]" id="release_date" type="date" value="" class="form-control fc-datepicker" placeholder="yyyy/mm/dd" autocomplete="off" >
                            </div>
                            <div class="col-sm-2 pt-1">
                                <img class="ui-datepicker-trigger" src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg" alt="" title="">
                            </div>
                            
                            
                        </div>
                        
                        
                    </div>
                    <div class="col-md-3 " >
                        <div class="row ">
                            <label class="gfield_label pb-1 " for="">تاريخ إنتهاء السجل التجاري
                                <span class="gfield_required">
                                    <span class="gfield_required gfield_required_custom">*</span>
                                </span>
                            </label> 
                            <div class="col-sm-10">
                                <input name="form[end_date]" id="end_date" type="date" value="" class="form-control fc-datepicker" placeholder="yyyy/mm/dd" autocomplete="off" >
                            </div>
                            <div class="col-sm-2 pt-1">
                                <img class="ui-datepicker-trigger" src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg" alt="" title="">
                            </div>
                            
                            
                        </div>
                        
                        
                    </div>

                </div>
                <div class="row pt-3">
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم الكامل بالعربي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[fullname_ar]" type="text" value="" id="namr_ar">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم الكامل بالإنجليزي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[fullname_en]" type="text" value="" id="name_en">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم المختصر بالعربي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[name_ar]" type="text" value="" id="namr_ar">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم المختصر بالإنجليزي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[name_en]" type="text" value="" id="name_en">
                    </div>
                </div>
                <div class="row pt-3">
                    <h4 class="gsection_title"> عنوان المنشأة   </h4>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">المدينة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[city]" type="text" value="" id="city">
                    </div> 
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">صندوق البريد
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[mailbox]" type="text" value="0" id="mailbox" required>
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">الرمز البريدي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[postcode]" type="text" value="0" id="postcode" required>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الهاتف
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[compony_phone]" type="text" value="" id="compony_phone" required>
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الفاكس
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[fax_num]" type="text" value="" id="fax_num" placeholder="05xxxxxxxx" required>
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">موقع الشركة الإلكتروني
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[company_website]" type="text" value="" id="company_website" required>
                    </div>
                </div>
              
                <div class="row pt-3">
                    <h3 class="gsection_title"> معلومات مدير المنشأة </h3>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">الاسم
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[owner_name]" type="text" value="" id="owner_name" required placeholder="الأسم الأول والأخير">
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الجوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[owner_number]" type="text" value="" placeholder="" id="owner_number    " required>
                    </div>
                    <div class="col-md-4" >
                        <label class="gfield_label pb-1" for="">رقم الهاتف
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[owner_phone]" type="text" value="" id="owner_phone" required placeholder="05xxxxxxxxx">
                    </div>
                    
                </div>
                <div class="row pt-3">
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني للشركة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[company_email]" type="text" value="" id="company_email" required placeholder="">
                    </div>
                    <div class="col-md-6 pb-5" >
                        <label class="gfield_label pb-1" for="">رقم الهوية                            
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[identity]" type="text" value="" placeholder="" id="position" required>
                    </div>
                    
                 
                    <fieldset  class=" pb-3 pt-5 gfield gfield--width-full field_sublabel_below field_description_below gfield_visibility_visible">
                        <legend class="gfield_label gfield_label_before_complex">الخدمات ضمن خدمة مسارات</legend>
                        <div class="ginput_container ginput_container_checkbox">
                            <div class="" id="input_4_154">
                                <div class="gchoice gchoice_4_154_1">
                                    <input class="gfield-choice-input" name="form[select_service][]" type="checkbox" value="خدمة إدارة تأجير المركبات" id="select_service">
                                    <label for="choice_4_154_1" id="label_4_154_1">خدمة إدارة تأجير المركبات</label>
                                </div>
                                <div class="gchoice gchoice_4_154_2">
                                    <input class="gfield-choice-input" name="form[select_service][]" type="checkbox" value="خدمة إدارة الصيانة والتشغيل للمركبات" id="select_service2">
                                    <label for="choice_4_154_2" id="label_4_154_2">خدمة إدارة الصيانة والتشغيل للمركبات</label>
                                </div>
                                <div class="gchoice gchoice_4_154_3">
                                    <input class="gfield-choice-input" name="form[select_service][]" type="checkbox" value="خدمة تتبع المركبات شاملة إدارة الصيانة والتشغيل" id="select_service3">
                                    <label for="choice_4_154_3" id="label_4_154_3">خدمة تتبع المركبات شاملة إدارة الصيانة والتشغيل</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            <br>
            <input type="submit" class=" btn gform_button button" value="أشترك الأن">
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

