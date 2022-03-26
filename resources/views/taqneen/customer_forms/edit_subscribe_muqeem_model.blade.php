
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
    grid-template-columns: repeat(5,1fr);
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
<li class="breadcrumb-item">@trans('lang.Dashboard')</li>
<li class="breadcrumb-item active">@trans('supportboard')</li> 
@endsection --}}

@section('content') 
<section class="subscribe-model container p-3 ">
    <div class="row ">
        <div class="col-md-12">
            <div class="gform_heading">
                <h2 class="gform_title">نموذج تغيير المستخدم الرئيسي في خدمة مقيم</h2>
                <span class="gform_description"></span>
                <p class="gform_required_legend">الحقول بعلامة (*) هي حقول مطلوبة</p>
            </div>
        </div>
    </div>
    <div class="row">
        <form class="form-group" action="" method="" enctype="multipart/form-data">
            @csrf
            <div class="ginput_container ">
                <h3 class="gsection_title pb-3">بيانات المنشأة</h3>
                <div class="row" >
                    <div class="col-md-6" >
                        <label class="gfield_label pb-1" for="">رقم المنشأة بوزارة الداخلية
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label>                       
                        <input class="form-control" name="form[company_num]" type="text" value="70" required placeholder="70xxxxxxxxxxx" id="company_num" >
                        <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من  10 حرف كحد أقصى</div>
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">الاسم العربي الكامل للمنشأة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[name_ar]" type="text" value="" id="namr_ar">
                    </div>
                    
                </div>
                <div class="row pt-3 pb-3">
                    <h4 class="gsection_title pb-3 pt-3"> معلومات المستخدم الرئيسي (المطلوب إضافته)</h4>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">اسم المستخدم
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_name]" type="text" value="" id="user_name" required placeholder="الأسم الأول والأخير">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية / الإقامة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_identifi]" type="text" value="" id="user_identifi" placeholder="05xxxxxxxx" required>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">الجوال
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_phone]" type="text" value="" id="user_phone" placeholder="05xxxxxxxx" required>
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">البريد الإلكتروني  
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_email]" type="text" value="" id="user_email" required>
                    </div>
                </div>
                
                <div class="row pt-3 pb-3">
                    <h4 class="gsection_title pb-3 pt-3"> معلومات المستخدم الرئيسي (المطلوب حذفه)</h4>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">اسم المستخدم
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_name]" type="text" value="" id="user_name" required placeholder="الأسم الأول والأخير">
                    </div>
                    <div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">رقم الهوية / الإقامة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_identifi]" type="text" value="" id="user_identifi" placeholder="05xxxxxxxx" required>
                    </div>
                </div>
                <div class="row pt-3 pb-3">
                    <h4 class="gsection_title pb-3 pt-3"> معلومات المستخدمين الآخرين</h4>
                    <h6 class="gsection_title">هل يوجد مستخدمين رئيسين اخرين تريد حذفهم ؟</h6>
                    
                    <div class="gfield_checkbox" id="input_1_4">
                        <div class="gchoice" style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="1"  id="choice">
                            <label for="choice" >1</label>
                        </div>
                        <div class="gchoice " style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="2" id="choice">
                            <label for="choice" >2</label>
                        </div>
                        <div class="gchoice " style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="3" id="choice">
                            <label for="choice" >3</label>
                        </div>
                        <div class="gchoice " style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="4" id="choice">
                            <label for="choice" >4</label>
                        </div>
                        <div class="gchoice " style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="5" id="choice">
                            <label for="choice" >5</label>
                        </div>
                        <div class="gchoice " style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="6" id="choice">
                            <label for="choice" > 6     </label>
                        </div>
                        <div class="gchoice " style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="7" id="choice">
                            <label for="choice" >7</label>
                        </div>
                        <div class="gchoice " style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="8" id="choice">
                            <label for="choice" >8</label>
                        </div><div class="gchoice " style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="9" id="choice">
                            <label for="choice" >9</label>
                        </div>
                        <div class="gchoice " style="display: inline;">
                            <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="10" id="choice">
                            <label for="choice" >10</label>
                        </div>
                    </div>
                    <div class="row"id="show_input">
                       
                    </div>
                </div>
                <div class="row pt-3 pb-3">
                    <h4 class="gsection_title pb-3 pt-3">معلومات مقدم الطلب</h4>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">الاسم 
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['applicant_name']" type="text" value="" id="applicant_name" required placeholder="الأسم الأول والأخير">
                    </div>
                    <div class="col-md-6 " >
                        <label class="gfield_label pb-1" for="">المنصب
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form['position']" type="text" value="" id="position" placeholder="" required>
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
        dateFormat: 'yyyy mm dd'
    }).val();
</script>

<script>
    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
             console.log($(this).attr('value'));

    var html = `<div class="col-md-3 " >
                        <label class="gfield_label pb-1" for="">اسم المستخدم
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_name][]" type="text" value="" id="user_name" required placeholder="الأسم الأول والأخير">
                        </div>
                        <div class="col-md-3 " >
                            <label class="gfield_label pb-1" for="">رقم الهوية / الإقامة
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_custom">*</span>
                            </span>
                        </label> 
                        <input class="form-control" name="form[user_identifi][]" type="text" value="" id="user_identifi" placeholder="05xxxxxxxx" required>
                        </div>`;
    $('#show_input').empty();
    
            if ($(this).attr('value') > 0) {
                for (let index = 0; index < $(this).attr('value') ; index++) {
                    console.log(index);
                  
                  $('#show_input').append(html);
                    // document.getElementById('show_input').value=$code;
                   
                }
                // console.log(document.getElementById('show_input').value=$code);
                
            } else {
                console.log('no');
            }
        });
    });
</script>


@endsection

