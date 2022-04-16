 <div class="ginput_container ginput_container_checkbox">
     <legend class="gsection_title">فئة الاشتراك مقيم</legend>
     <div class="gfield_checkbox" id="input_1_4">
         <div class="gchoice" style="display: inline;"> 
            <label for="">
                <input type="checkbox" name="form[choice_1]"
                    {{ optional($resource)->choice_1? 'checked' : '' }}
                    value="{{ optional($resource)->choice_1 ? '1' : '0' }}"
                    onchange="this.value = this.checked? '1' : '0'">
                    شامل
            </label> 
         </div>
         <div class="gchoice " style="display: inline;">
            <label for="">
                <input type="checkbox" name="form[choice_2]"
                    {{ optional($resource)->choice_2? 'checked' : '' }}
                    value="{{ optional($resource)->choice_2 ? '1' : '0' }}"
                    onchange="this.value = this.checked? '1' : '0'">
                    عمليات
            </label> 
         </div>
     </div>
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
             {!! Form::text('form[name_ar]', $resource->name_ar, ['class' => 'form-control related', 'required', 'data-related' => 'name_ar']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">الاسم الإنجليزي الكامل للمنشأة
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[name_en]', $resource->name_en, ['class' => 'form-control related', 'required', 'data-related' => 'name_en']) !!}
         </div>
         {!! Form::hidden("form[short_name_ar]", $resource->short_name_ar, ["class" => "name_ar"]) !!}
         {!! Form::hidden("form[short_name_en]", $resource->short_name_en, ["class" => "name_en"]) !!}

         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">المدينة
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[city]', $resource->city, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>


     </div>
     <div class="row pt-3">
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">الهاتف
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[phone]', $resource->phone, ['class' => 'form-control related', 'required', 'placeholder' => '123xxxxxxx', 'maxlength' => 10, 'data-related' => 'phone']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">ص.ب
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[mailbox]', $resource->mailbox, ['class' => 'form-control', 'required', 'placeholder' => '123xxxxxxx']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">الرمز البريدي
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[postcode]', $resource->postcode, ['class' => 'form-control', 'required', 'placeholder' => '123xxxxxxx']) !!}
         </div>
     </div>
     <div class="row pt-3">
         <div class="col-md-4 ">
             <label class="gfield_label pb-1" for="">اسم مدير الموارد البشرية
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[hr_name]', $resource->hr_name, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-4 ">
             <label class="gfield_label pb-1" for="">جوال
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[mobile_num]', $resource->mobile_num, ['class' => 'form-control', 'required', 'placeholder' => '', 'maxlength' => 10]) !!}
         </div>
         <div class="col-md-4 ">
             <label class="gfield_label pb-1" for="">البريد الإلكتروني للموارد البشرية
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::email('form[email]', $resource->email, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
     </div>
     <div class="row pt-3">
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">جوال الإشعارات
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[phone_notfic]', $resource->phone_notfic, ['class' => 'form-control', 'required', 'placeholder' => '', 'maxlength' => 10]) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">البريد الإلكتروني للإشعارات
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::email('form[mail_notific]', $resource->mail_notific, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">رقم السجل التجاري
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[commercial_number]', $resource->commercial_number, ['class' => 'form-control', 'required', 'placeholder' => '', 'maxlength' => 10]) !!}
         </div>
         <div class="col-md-3 ">
             <div class="row ">
                 <label class="gfield_label pb-1 " for="">تاريخ إصدار السجل
                     <span class="gfield_required">
                         <span class="gfield_required gfield_required_custom">*</span>
                     </span>
                 </label>

                 <div class="col-sm-10">
                     {!! Form::date('form[release_date]', $resource->release_date, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
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
         <div class="col-md-6 ">
             <label class="gfield_label pb-1" for="">اسم المدير
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[manager_name]', $resource->manager_name, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>

         <div class="col-md-6 ">
             <label class="gfield_label pb-1" for="">جوال
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[manager_phone]', $resource->manager_phone, ['class' => 'form-control', 'required', 'placeholder' => '', 'maxlength' => 10]) !!}
         </div>

     </div>

     <div class="row pt-3">
         <h3 class="gsection_title"> معلومات المستخدم الرئيسي </h3>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">اسم المستخدم الرئيسي
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[user_name]', $resource->user_name, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>

         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">رقم الهوية
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[id_number]', $resource->id_number, ['class' => 'form-control', 'required', 'placeholder' => '', 'maxlength' => 10]) !!}
         </div>

         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">الجوال
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[user_phone]', $resource->user_phone, ['class' => 'form-control', 'required', 'placeholder' => '', 'maxlength' => 10]) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">البريد الإلكتروني
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::email('form[user_mail]', $resource->user_mail, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>


     </div>
     <div class="row pt-3">
         <h3 class="gsection_title"> مقدم الطلب </h3>
         <div class="col-md-6 ">
             <label class="gfield_label pb-1" for="">الاسم
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[name]', $resource->name, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-6 ">
             <label class="gfield_label pb-1" for="">المنصب
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[position]', $resource->position, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>


     </div>
     <div class="row">
         
        @include("taqneen.customer_forms.forms.GLOBAL")
     </div>
 </div>
