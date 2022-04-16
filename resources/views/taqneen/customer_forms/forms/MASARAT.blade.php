 
    <div class="ginput_container "> 

        <legend class="gsection_title">نموزج مسارات</legend>
         <br>
        <h4 class="gsection_title">بيانات المنشأة</h4>
        <div class="row">
            <div class="col-md-3">
                <label class="gfield_label pb-1" for="">الرقم بوزارة الداخلية
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[company_number]', $resource->company_number, ['class' => 'form-control', 'placeholder' => '70xxxxxxxxxxx', 'required', 'maxlength' => 10, "max" => 10, "required"]) !!}
                <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من 10 حرف كحد أقصى</div>
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">رقم السجل التجاري
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[commercial_number]', $resource->commercial_number, ['class' => 'form-control', 'placeholder' => '123xxxxxxx', 'maxlength' => 10, "max" => 10, "required"]) !!}

            </div>
            <div class="col-md-3 ">
                <div class="row ">
                    <label class="gfield_label pb-1 " for="">تاريخ إصدار السجل التجاري
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    <div class="col-sm-10">
                        {!! Form::date('form[release_date]', $resource->release_date, ['class' => 'form-control', 'placeholder' => 'yyyy/mm/dd', 'required', 'onchange' => '$(".end_date").attr("min", new Date(this.value).addDays(1).toISOString().substring(0, 10))']) !!}
                    </div>
                    <div class="col-sm-2 pt-1">
                        <img class="ui-datepicker-trigger"
                            src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg"
                            alt="" title="">
                    </div>


                </div>


            </div>
            <div class="col-md-3 ">
                <div class="row ">
                    <label class="gfield_label pb-1 " for="">تاريخ إنتهاء السجل التجاري
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    <div class="col-sm-10">
                        {!! Form::date('form[end_date]', $resource->end_date, ['class' => 'form-control end_date', 'placeholder' => 'yyyy/mm/dd', 'required', 'min' => $resource->release_date]) !!}
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
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">الاسم الكامل بالعربي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[fullname_ar]', $resource->fullname_ar, ['class' => 'form-control related', 'required', 'data-related' => 'name_ar']) !!}
            </div>
            <div class="col-md-3 ">
                <label class="gfield_label pb-1" for="">الاسم الكامل بالإنجليزي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[fullname_en]', $resource->fullname_en, ['class' => 'form-control related', 'required', 'data-related' => 'name_en']) !!}
            </div>
            {!! Form::hidden("form[name_ar]", $resource->name_ar, ["class" => "name_ar"]) !!}
            {!! Form::hidden("form[name_en]", $resource->name_en, ["class" => "name_en"]) !!}
             
        </div>
        <div class="row pt-3">
            <h4 class="gsection_title"> عنوان المنشأة </h4>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">المدينة
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[city]', $resource->city, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">صندوق البريد
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::number('form[mailbox]', $resource->mailbox, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">الرمز البريدي
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::number('form[postcode]', $resource->postcode, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">رقم الهاتف
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[compony_phone]', $resource->compony_phone, ['class' => 'form-control related', 'maxlength' => 10, "max" => 10, "required", 'data-related' => 'phone']) !!}
            </div>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">رقم الفاكس
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::number('form[fax_num]', $resource->fax_num, ['class' => 'form-control', 'required']) !!}

            </div>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">موقع الشركة الإلكتروني
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom"></span>
                    </span>
                </label>
                {!! Form::url('form[company_website]', $resource->company_website, ['class' => 'form-control', 'placeholder' => 'https://example.com']) !!}

            </div>
        </div>

        <div class="row pt-3">
            <h3 class="gsection_title"> معلومات مدير المنشأة </h3>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">الاسم
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[owner_name]', $resource->owner_name, ['class' => 'form-control', 'required']) !!}

            </div>
            <div class="col-md-4 ">
                <label class="gfield_label pb-1" for="">رقم الجوال
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[owner_number]', $resource->owner_number, ['class' => 'form-control', 'maxlength' => 10, "max" => 10, "required"]) !!}

            </div>
            <div class="col-md-4">
                <label class="gfield_label pb-1" for="">رقم الهاتف
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[owner_phone]', $resource->owner_phone, ['class' => 'form-control phone', 'required', 'maxlength' => 10]) !!}

            </div>

        </div>
        <div class="row pt-3">
            <div class="col-md-6 ">
                <label class="gfield_label pb-1" for="">البريد الإلكتروني للشركة
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::email('form[company_email]', $resource->company_email, ['class' => 'form-control', 'required']) !!}

            </div>
            <div class="col-md-6 pb-5">
                <label class="gfield_label pb-1" for="">رقم الهوية
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_custom">*</span>
                    </span>
                </label>
                {!! Form::text('form[identity]', $resource->identity, ['class' => 'form-control', 'maxlength' => 10, "max" => 10, "required"]) !!}

            </div> 

            <div class="row pt-3"> 
                <h3 class="gsection_title pb-4"> معلومات المستخدم الرئيسي </h3>
       
                <div class="col-md-4 ">
                    <label class="gfield_label pb-1" for="">الإسم 
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    {!! Form::text('form[user_name]', $resource->user_name, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                </div> 
                <div class="col-md-4 ">
                    <label class="gfield_label pb-1" for="">رقم الهاتف
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    {!! Form::text('form[user_phone]', $resource->user_phone, ['class' => 'form-control phone', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
                </div> 
                <div class="col-md-4 ">
                    <label class="gfield_label pb-1" for="">رقم الهوية
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    {!! Form::text('form[user_identifi]', $resource->user_identifi, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
                </div>
                <div class="col-md-4 ">
                    <label class="gfield_label pb-1" for="">الجوال
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    {!! Form::text('form[user_mobile]', $resource->user_mobile, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
                </div>
                <div class="col-md-4 ">
                    <label class="gfield_label pb-1" for="">البريد الإلكتروني
                        <span class="gfield_required">
                            <span class="gfield_required gfield_required_custom">*</span>
                        </span>
                    </label>
                    {!! Form::email('form[user_email]', $resource->user_email, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                </div>
      
            </div> 
            <br>

            @include("taqneen.customer_forms.forms.GLOBAL")


            <div class="col-md-12">
                <br>
                <fieldset
                class=" pb-3 pt-5 gfield gfield--width-full field_sublabel_below field_description_below gfield_visibility_visible">
                <legend class="gfield_label gfield_label_before_complex">الخدمات ضمن خدمة مسارات</legend>
                <div class="ginput_container ginput_container_checkbox">
                    <div class="" id="input_4_154">

                        <label for="">
                            <input type="checkbox" name="form[select_service_1]"
                                {{ optional($resource)->select_service_1? 'checked' : '' }}
                                value="{{ optional($resource)->select_service_1 ? '1' : '0' }}"
                                onchange="this.value = this.checked? '1' : '0'">
                            خدمة إدارة تأجير المركبات
                        </label>
                        <br>
                        <label for="">
                            <input type="checkbox" name="form[select_service_2]"
                                {{ optional($resource)->select_service_2? 'checked' : '' }}
                                value="{{ optional($resource)->select_service_2 ? '1' : '0' }}"
                                onchange="this.value = this.checked? '1' : '0'">
                            خدمة إدارة الصيانة والتشغيل للمركبات
                        </label>
                        <br>

                        <label for="">
                            <input type="checkbox" name="form[select_service_3]"
                                {{ optional($resource)->select_service_3? 'checked' : '' }}
                                value="{{ optional($resource)->select_service_3 ? '1' : '0' }}"
                                onchange="this.value = this.checked? '1' : '0'">
                            خدمة تتبع المركبات شاملة إدارة الصيانة والتشغيل
                        </label>

                    </div>
                </div>
            </fieldset>
            </div>
        </div>
    </div>

    <br>
