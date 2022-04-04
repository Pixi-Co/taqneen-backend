
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

input[type='text'],input[type='date'],input[type='date']:focus,input[type="text"]:focus,select,select:focus{
    border-color: #ebebeb;
    background-color: #f8f8f8;
    color: #969696;
}
select {
    /* -webkit-appearance: none; */
    border-radius: 0px;
    background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAANCAYAAAC+ct6XAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjBBRUQ1QTQ1QzkxMTFFMDlDNDdEQzgyNUE1RjI4MTEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjBBRUQ1QTU1QzkxMTFFMDlDNDdEQzgyNUE1RjI4MTEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGMEFFRDVBMjVDOTExMUUwOUM0N0RDODI1QTVGMjgxMSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGMEFFRDVBMzVDOTExMUUwOUM0N0RDODI1QTVGMjgxMSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pk5mU4QAAACUSURBVHjaYmRgYJD6////MwY6AyaGAQIspCieM2cOjKkIxCFA3A0TSElJoZ3FUCANxAeAWA6IOYG4iR5BjWwpCDQCcSnNgxoIVJCDFwnwA/FHWlp8EIpHSKoGgiggLkITewrEcbQO6mVAbAbE+VD+a3IsJTc7FQAxDxD7AbEzEF+jR1DDywtoCr9DbhwzDlRZDRBgACYqHJO9bkklAAAAAElFTkSuQmCC); 
    background-position: center right;
    background-repeat: no-repeat;
    border-radius: 2px;
    
    
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
                <h2 class="gform_title">شموس</h2>
                <span class="gform_description"></span>
                <p class="gform_required_legend">الحقول بعلامة (*) هي حقول مطلوبة</p>
            </div>
        </div>
    </div>
    <div class="row">
        <form class="form-group" action="{{ route('createcustomershomoos.store') }}" method="post" enctype="multipart/form-data">
           @csrf
          @method('post')
            {{-- <div class="ginput_container ginput_container_checkbox">
                <legend class="gsection_title">نوع الطلب</legend>
                <div class="gfield_checkbox" id="input_1_4">
                    <div class="gchoice" style="display: inline;">
                        <input class="gfield-choice-input" name="form['choice_new']" type="checkbox" value="جديد" checked="checked" id="choice_new">
                        <label for="choice" >جديد</label>
                    </div>
                    <div class="gchoice " style="display: inline;">
                        <input class="gfield-choice-input" name="form['choice_renewal']" type="checkbox" value="تجديد" id="choice_renewal">
                        <label for="choice" >تجديد</label>
                    </div>
                </div>
            </div> --}}

            @if ($subscribe_customer->id)
            <input type="hidden" name="customer_type" value="{{ $instance::$EDIT_SUBSCRIBE_SHOMOOS_MODEL_KEY }}">
            @else
            <input type="hidden" name="customer_type" value="{{ $instance::$SUBSCRIBE_SHOMOOS_MODEL_KEY }}">
            @endif
            @if ($subscribe_customer->id)
            <input type="hidden" name="id" value="{{ $subscribe_customer->id }}" >
            @endif


            <div class="ginput_container ">
                <h3 class="gsection_title">بيانات المنشأة</h3>
                <div class="row" >
                    <div class="col-md-4" >
                        <label class="gfield_label pb-1" for="">اسم المنشأة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label>  
                        {!! Form::text('form[company_name]', $subscribe_customer->id?$data->company_name:'', ["class"=>"form-control","required"]) !!}                     
                        {{-- <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من  10 حرف كحد أقصى</div> --}}
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">نوع النشاط
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::select('form[activity_type]', $activity_type, $subscribe_customer->id?$data->activity_type:'', ["class"=>"form-select", "required","placeholder"=>"حدد نوع المنشأ"]) !!}
                    
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">اسم المالك
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[owner_name]', $subscribe_customer->id?$data->owner_name:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                   
                    
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية :
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[owner_identifi]', $subscribe_customer->id?$data->owner_identifi:'', ["class"=>"form-control","required"]) !!}                     

                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الجوال:
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[owner_phone]', $subscribe_customer->id?$data->owner_phone:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">المدينة / المحافظة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[city]', $subscribe_customer->id?$data->city:'', ["class"=>"form-control","required"]) !!}                     
                    </div> 
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">اسم الحي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[neighborhood_name]', $subscribe_customer->id?$data->neighborhood_name:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">اسم الشارع
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[street_name]', $subscribe_customer->id?$data->street_name:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">وصف العنوان
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[addrees]', $subscribe_customer->id?$data->addrees:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الهاتف
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[enterprise_phone]', $subscribe_customer->id?$data->enterprise_phone:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الفاكس
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[enterprise_fax]', $subscribe_customer->id?$data->enterprise_fax:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني 
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[enterprise_email]', $subscribe_customer->id?$data->enterprise_email:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    
                </div>
                <div class="row pt-3">
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">ص.ب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[mailbox]', $subscribe_customer->id?$data->mailbox:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">الرمز البريدي
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[postcode]', $subscribe_customer->id?$data->postcode:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">اسم المستخدم
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[user_name]', $subscribe_customer->id?$data->user_name:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[user_identifi]', $subscribe_customer->id?$data->user_identifi:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    <div class="col-md-4 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني  
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[user_email]', $subscribe_customer->id?$data->user_email:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-6 " >                           
                        <label class="gfield_label pb-1" for="">نوع الهوية</label> 
                        <div class="gfield_checkbox" id="input_1_4">
                            <div class="gchoice" style="display: inline;">
                                {!! Form::radio("form[id_type]",'بطاقة', $subscribe_customer->id?$data->id_type?'checked':'':'')!!}
                                <label for="choice" >بطاقة</label>
                            </div>
                            <div class="gchoice " style="display: inline;">
                                {!! Form::radio("form[id_type]",'إقامة', $subscribe_customer->id?$data->id_type?'checked':'':'')!!}
                                <label for="choice" >إقامة</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">رقم الجوال :
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[user_phone]', $subscribe_customer->id?$data->user_phone:'', ["class"=>"form-control","required"]) !!}                     
                    </div>
                    
                </div>
               
                <div class="row pt-3">
                    <h3 class="gsection_title"> بيانات الإشتراك</h3>
                    <div class="gsection_description pt-4" id="gfield_description_8_179">رسوم التسجيل في شموس 700 ر.س</div>
                    <div class="col-md-12 pt-5" >
                        <div class="row ">
                            <label class="gfield_label pb-1 " for="">تاريخ الإشتراك
                                <span class="gfield_required">
                                    <span class="gfield_required gfield_required_custom">*</span>
                                </span>
                            </label> 
                            <div class="col-sm-11">
                                {!! Form::date('form[subscription_date]', $subscribe_customer->id?$data->subscription_date:'', ["class"=>"form-control","required"]) !!}                     
                            </div>
                            <div class="col-sm-1 pt-1">
                                <img class="ui-datepicker-trigger" src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg" alt="" title="">
                            </div>
                            
                            
                        </div>
                        
                        
                    </div>
                    
                    
                    <div class="col-md-12 pt-2" >
                        <label class="gfield_label pb-1" for=""> المندوب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        {!! Form::text('form[delegate_name]', $subscribe_customer->id?$data->delegate_name:'', ["class"=>"form-control","required"]) !!}                     
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

