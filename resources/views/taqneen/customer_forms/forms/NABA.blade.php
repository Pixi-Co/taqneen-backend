    
    
    <div class="ginput_container ginput_container_checkbox">
        <legend class="gsection_title">نموزج نبأ </legend>
        <div class="gfield_checkbox" id="input_1_4">

            <div class="gchoice" style="display: inline;">
                <label for="">
                    <input type="checkbox" name="form[portal_naba_1]"
                        {{ optional($resource)->portal_naba_1 ? 'checked' : '' }}
                        value="{{ optional($resource)->portal_naba_1 ? '1' : '0' }}"
                        onchange="this.value = this.checked? '1' : '0'">
                    بوابة نبأ
                </label>
            </div>

            <div class="gchoice" style="display: inline;">
                <label for="">
                    <input type="checkbox" name="form[portal_naba_2]"
                    {{ optional($resource)->portal_naba_2 ? 'checked' : '' }}
                        value="{{ optional($resource)->portal_naba_2 ? '1' : '0' }}"
                        onchange="this.value = this.checked? '1' : '0'">
                    نبأ المباشرة
                </label>
            </div>

            <div class="gchoice" style="display: inline;">
                <label for="">
                    <input type="checkbox" name="form[portal_naba_3]"
                    {{ optional($resource)->portal_naba_3 ? 'checked' : '' }}
                        value="{{ optional($resource)->portal_naba_3 ? '1' : '0' }}"
                        onchange="this.value = this.checked? '1' : '0'">
                    نبأ الأساسية
                </label>
            </div>

        </div>
    </div>

    <div class="ginput_container ">
        <h3 class="gsection_title">بيانات المنشأة</h3>
        <div class="row">
            <div class="col-md-3">
                <label class="gfield_label pb-1" for="">رقم الحاسب الآلي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[company_number]', $resource->company_number, ['class' => 'form-control', 'placeholder' => '70xxxxxxxxxxx', 'required', 'maxlength' => 10, "max" => 10, "required"]) !!}
                <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من 10 حرف كحد أقصى</div>
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">الإسم بالعربي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[name_ar]', $resource->name_ar, ['class' => 'form-control related', 'required', 'data-related' => 'name_ar']) !!}

            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">الإسم بالانجليزي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[name_en]', $resource->name_en, ['class' => 'form-control related', 'required', 'data-related' => 'name_ar']) !!}
            </div>
            {!! Form::hidden("form[name_ar]", $resource->name_ar, ["class" => "name_ar"]) !!}
            {!! Form::hidden("form[name_en]", $resource->name_en, ["class" => "name_en"]) !!}
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">المدينة
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[city]', $resource->city, ['class' => 'form-control', 'required']) !!}
            </div>

        </div>
        <div class="row pt-3">

            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">رقم الهاتف
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[owner_phone]', $resource->owner_phone, ['class' => 'form-control related', 'required', 'maxlength' => 10, 'data-related' => 'phone']) !!}
            </div>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">موقع الشركة الالكتروني :
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom"></span>
                    </span>
                </label>
                {!! Form::url('form[company_website]', $resource->company_website, ['class' => 'form-control', 'placeholder', 'https//:example.com']) !!}
            </div>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">البريد الإلكتروني :
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::email('form[company_email]', $resource->company_email, ['class' => 'form-control', 'required']) !!}
            </div>

        </div>
        <div class="row pt-3">
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">أسم المالك
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[owner_name]', $resource->owner_name, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">رقم السجل التجاري
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[commercial_number]', $resource->commercial_number, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
            </div>
            <div class="col-md-4 ">
                <div class="row ">
                    <label class="gfield_label pb-1 " for="">تاريخ إنتهاء السجل التجاري
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    <div class="col-sm-10">
                        {!! Form::date('form[end_date]', $resource->end_date, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col-sm-2 pt-1">
                        <img class="ui-datepicker-trigger"
                            src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg"
                            alt="" title="">
                    </div>


                </div>

            </div>

        </div>
        <div class="row pt-3">
            <h4 class="gsection_title pb-4">العنوان الوطني</h4>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for=""> رقم المبنى
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[building_num]', $resource->building_num, ['class' => 'form-control', 'required']) !!}

            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">الشارع
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[street]', $resource->street, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">الحي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[district]', $resource->district, ['class' => 'form-control', 'required']) !!}

            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for=""> الرمز البريدي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[postal_code]', $resource->postal_code, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="row pt-3">
            <h4 class="gsection_title pb-4 pt-2"> معلومات مدير المنشأة</h4>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">الاسم الثلاثي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[leader_name]', $resource->leader_name, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم الهوية
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[leader_idenitiy]', $resource->leader_idenitiy, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم الجوال الاساسي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[leader_phone]', $resource->leader_phone, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم الهاتف الثانوي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[leader_phone2]', $resource->leader_phone2, ['class' => 'form-control phone', 'required', 'maxlength' => 10]) !!}
            </div>
            <div class="col-sm-12 pt-3">
                <label class="gfield_label pb-1" for="">البريد الالكتروني
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::email('form[leader_email]', $resource->leader_email, ['class' => 'form-control', 'required']) !!}
            </div>

        </div>
        <div class="row pt-3">
            <h4 class="gsection_title pb-4 pt-2"> معلومات المستخدم الرئيسي </h4>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">الاسم الثلاثي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[user_name]', $resource->user_name, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم الهوية
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[user_idenitiy]', $resource->user_idenitiy, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}

            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم الجوال الاساسي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[user_phone]', $resource->user_phone, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم الهاتف الثانوي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[user_phone2]', $resource->user_phone2, ['class' => 'form-control phone', 'required', 'maxlength' => 10]) !!}
            </div>
            <div class="col-sm-12 pt-3">
                <label class="gfield_label pb-1" for="">البريد الالكتروني
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::email('form[user_email]', $resource->user_email, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="row pt-3">
            <h4 class="gsection_title pb-4 pt-2"> معلومات ممثلي المشترك </h4>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">الاسم الثلاثي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[sub_represent_name]', $resource->sub_represent_name, ['class' => 'form-control', 'required']) !!}

            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم الهوية
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[sub_represent_idenitiy]', $resource->sub_represent_idenitiy, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم الجوال الاساسي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[sub_represent_phone]', $resource->sub_represent_phone, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم الهاتف الثانوي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[sub_represent_phone2]', $resource->sub_represent_phone2, ['class' => 'form-control phone', 'required', 'maxlength' => 10]) !!}
            </div>
            <div class="col-sm-12 pt-3">
                <label class="gfield_label pb-1" for="">البريد الالكتروني
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::email('form[sub_represent_email]', $resource->sub_represent_email, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>


        <div class="row pt-3">
            <h3 class="gsection_title"> المدة</h3>
            <div class="col-md-6 ">
                <label class="gfield_label pb-1" for="">بيانات الاشتراك أن وجدت مثل (نوع الباقة - نوع الاشتراك)
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[sub_type]', $resource->sub_type, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-md-6 ">
                <label class="gfield_label pb-1" for="">بيانات التكلفة أن وجدت
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[cost_data]', $resource->cost_data, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-md-12 pt-3 ">
                <label class="gfield_label pb-1" for="">سبب أستخدام الخدمة
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[reason]', $resource->reason, ['class' => 'form-control', 'required']) !!}
            </div> 

            @include("taqneen.customer_forms.forms.GLOBAL")
        </div>
    </div>

    <br>
