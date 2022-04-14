 
  <div class="ginput_container ginput_container_checkbox">
    <legend class="gsection_title">نموذج تغيير المستخدم الرئيسي في خدمة تم    </legend> 
   
</div>

<div class="ginput_container ">
    <h3 class="gsection_title">بيانات المنشأة</h3>
    <div class="row">
        <div class="col-md-3">
            <label class="gfield_label pb-1" for="">رقم المنشأة بوزارة الداخلية
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[company_number]', $resource->company_number, ['class' => 'form-control', 'placeholder' => '70xxxxxxxxxxx', 'required', 'maxlength' => 10, "max" => 10, "required"]) !!}
            <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من 10 حرف كحد أقصى</div>
        </div>
        <div class="col-md-3 ">
            <label class="gfield_label pb-1" for="">الاسم العربي الكامل للمنشأة
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[name_ar]', $resource->name_ar, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
        </div>
        

    </div>
         
    </div>

    <br>
    <div class="row pt-3"> 
        <h3 class="gsection_title pb-4">معلومات المستخدم الرئيسي (المطلوب إضافته)</h3>
        <input type="hidden" name="form[checkbox_to_add]" value="1" >
 
        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">
                اسم المستخدم الرئيسي* 
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[username_to_add]', $resource->username_to_add, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
        </div> 

        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">رقم الهوية
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[identity_to_add]', $resource->identity_to_add, ['class' => 'form-control', 'placeholder' => '', 'required', "maxlength" => 10]) !!}
        </div>
        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">الجوال
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[phone_to_add]', $resource->phone_to_add, ['class' => 'form-control', 'placeholder' => '', 'required', "maxlength" => 10]) !!}
        </div>
        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">البريد الإلكتروني
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::email('form[email_to_add]', $resource->email_to_add, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
        </div>
    </div>
 

    <br>
    <div class="row pt-3"> 
        <h3 class="gsection_title pb-4">معلومات المستخدم الرئيسي (المطلوب حذفه)</h3>
        <input type="hidden" name="form[checkbox_to_remove]" value="1" >
 
        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">
                اسم المستخدم الرئيسي* 
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[username_to_remove]', $resource->username_to_remove, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
        </div> 

        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">رقم الهوية
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[identity_to_remove]', $resource->identity_to_remove, ['class' => 'form-control', 'placeholder' => '', 'required', "maxlength" => 10]) !!}
        </div>
        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">الجوال
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[phone_to_remove]', $resource->phone_to_remove, ['class' => 'form-control', 'placeholder' => '', 'required', "maxlength" => 10]) !!}
        </div>
        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">البريد الإلكتروني
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::email('form[email_to_remove]', $resource->email_to_remove, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
        </div>
    </div>

    <br>
    <div class="row pt-3"> 
        <h3 class="gsection_title pb-4">معلومات مقدم الطلب</h3>
 
        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">
                اسم 
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[applicant_name]', $resource->applicant_name, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
        </div> 
 
        <div class="col-md-4 ">
            <label class="gfield_label pb-1" for="">
                المنصب 
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::text('form[applicant_position]', $resource->applicant_position, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
        </div> 
    </div>

    <div class="col-md-12 pb-5">
        <label class="gfield_label pb-1" for="">
            اسم المندوب 
            <span class="gfield_required">
                <span class="gfield_required gfield_required_custom">*</span>
            </span>
        </label>
        {!! Form::select('form[courier_name]', $users, ["class"=>"form-select", "required"]) !!}
    </div>
</div>

<br>
