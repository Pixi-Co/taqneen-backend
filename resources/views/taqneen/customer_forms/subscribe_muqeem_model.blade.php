
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

input[type='text'],input[type="text"]:focus{
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
<li class="breadcrumb-item">@lang('lang.Dashboard')</li>
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
        <form class="form-group" action="" method="" enctype="multipart/form-data">
            <div class="ginput_container ginput_container_checkbox">
                <legend class="gsection_title">فئة الاشتراك</legend>
                <div class="gfield_checkbox" id="input_1_4">
                    <div class="gchoice" style="display: inline;">
                        <input class="gfield-choice-input" name="form['choice_overall']" type="checkbox" value="شامل" checked="checked" id="choice">
                        <label for="choice" >شامل</label>
                    </div>
                    <div class="gchoice " style="display: inline;">
                        <input class="gfield-choice-input" name="form['choice_process']" type="checkbox" value="عمليات" id="choice">
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
                        <input class="form-control" name="form['company_num']" type="text" value="70" required placeholder="70xxxxxxxxxxx" id="company_num" >
                        <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من  10 حرف كحد أقصى</div>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم العربي الكامل للمنشأة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['name_ar']" type="text" value="" id="namr_ar">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الاسم الإنجليزي الكامل للمنشأة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['name_en']" type="text" value="" id="name_en">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">المدينة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['city']" type="text" value="" id="city">
                    </div> 
                    
                </div>
                <div class="row pt-3">
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الهاتف
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['phone']" type="text" value="" id="phone" required>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">ص.ب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['mailbox']" type="text" value="0" id="mailbox" required>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الرمز البريدي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['postcode']" type="text" value="0" id="postcode" required>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">اسم مدير الموارد البشرية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['hr_name']" type="text" value="" id="hr_name" required>
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">جوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['mobile_num']" type="text" value="" id="mobile_num" placeholder="05xxxxxxxx" required>
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني للموارد البشرية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['email']" type="text" value="" id="email" required>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">جوال الإشعارات
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['phone_notfic']" type="text" value="" id="phone_notific" required placeholder="05xxxxxxx">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني للإشعارات
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['mail_notific']" type="text" value="" id="mail_notific" required>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم السجل التجاري
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['commercial_number']" type="text" value="" id="commercial_number" required>
                    </div>
                    <div class="col-md-3 " >
                        <div class="row ">
                            <label class="gfield_label pb-1 " for="">تاريخ إصدار السجل
                                <span class="gfield_required">
                                    <span class="gfield_required gfield_required_custom">*</span>
                                </span>
                            </label> 
                            <div class="col-sm-10">
                                <input name="form['release_date']" id="release_date" type="text" value="" class="form-control  fc-datepicker" placeholder="yyyy/mm/dd" >
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
                        <input class="form-control" name="form['manager_name']" type="text" value="" id="manager_name" required>
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">جوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['manager_phone']" type="text" value="" placeholder="05xxxxxxxx" id="manager_phone" required>
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
                        <input class="form-control" name="form['user_name']" type="text" value="" id="user_name" required placeholder="الأسم الأول والأخير">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['id_number']" type="text" value="" placeholder="" id="id_number" required>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الجوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['user_phone']" type="text" value="" id="user_phone" required placeholder="05xxxxxxxxx">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['user_mail']" type="text" value="" placeholder="" id="user_mail" required>
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
                        <input class="form-control" name="form['name']" type="text" value="" id="name" required placeholder="">
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">المنصب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['position']" type="text" value="" placeholder="" id="position" required>
                    </div>
                    <div class="col-md-12 " >
                        <label class="gfield_label pb-1" for="">اسم المندوب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['delegate_name']" type="text" value="" id="delegate_name" required placeholder="">
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

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

@endsection

