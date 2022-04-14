 <div class="ginput_container ginput_container_checkbox">
     <legend class="gsection_title">فئة الاشتراك مقيم</legend>
     <div class="gfield_checkbox" id="input_1_4">
         <div class="gchoice" style="display: inline;">
             <input class="gfield-choice-input" name="form[choice][]" type="checkbox" value="شامل" checked="checked"
                 id="choice">
             <label for="choice">شامل</label>
         </div>
         <div class="gchoice " style="display: inline;">
             <input class="gfield-choice-input" name="form[choice][]" type="checkbox" value="عمليات" id="choice">
             <label for="choice">عمليات</label>
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
             {!! Form::number('form[company_num]', $subscribe_customer->id ? $data->company_num : '', ['class' => 'form-control', 'required', 'placeholder' => '123xxxxxxx']) !!}
             <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من 10 حرف كحد أقصى</div>
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">الاسم العربي الكامل للمنشأة
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[name_ar]', $subscribe_customer->id ? $data->name_ar : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">الاسم الإنجليزي الكامل للمنشأة
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[name_en]', $subscribe_customer->id ? $data->name_en : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">المدينة
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[city]', $subscribe_customer->id ? $data->city : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>


     </div>
     <div class="row pt-3">
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">الهاتف
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::number('form[phone]', $subscribe_customer->id ? $data->phone : '', ['class' => 'form-control', 'required', 'placeholder' => '123xxxxxxx']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">ص.ب
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::number('form[mailbox]', $subscribe_customer->id ? $data->mailbox : '', ['class' => 'form-control', 'required', 'placeholder' => '123xxxxxxx']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">الرمز البريدي
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::number('form[postcode]', $subscribe_customer->id ? $data->postcode : '', ['class' => 'form-control', 'required', 'placeholder' => '123xxxxxxx']) !!}
         </div>
     </div>
     <div class="row pt-3">
         <div class="col-md-4 ">
             <label class="gfield_label pb-1" for="">اسم مدير الموارد البشرية
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[hr_name]', $subscribe_customer->id ? $data->hr_name : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-4 ">
             <label class="gfield_label pb-1" for="">جوال
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::number('form[mobile_num]', $subscribe_customer->id ? $data->mobile_num : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-4 ">
             <label class="gfield_label pb-1" for="">البريد الإلكتروني للموارد البشرية
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::email('form[email]', $subscribe_customer->id ? $data->email : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
     </div>
     <div class="row pt-3">
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">جوال الإشعارات
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::number('form[phone_notfic]', $subscribe_customer->id ? $data->phone_notfic : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">البريد الإلكتروني للإشعارات
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::email('form[mail_notific]', $subscribe_customer->id ? $data->mail_notific : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">رقم السجل التجاري
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::number('form[commercial_number]', $subscribe_customer->id ? $data->commercial_number : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-3 ">
             <div class="row ">
                 <label class="gfield_label pb-1 " for="">تاريخ إصدار السجل
                     <span class="gfield_required">
                         <span class="gfield_required gfield_required_custom">*</span>
                     </span>
                 </label>

                 <div class="col-sm-10">
                     {!! Form::date('form[release_date]', $subscribe_customer->id ? $data->release_date : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
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
             {!! Form::text('form[manager_name]', $subscribe_customer->id ? $data->manager_name : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>

         <div class="col-md-6 ">
             <label class="gfield_label pb-1" for="">جوال
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::number('form[manager_phone]', $subscribe_customer->id ? $data->manager_phone : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
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
             {!! Form::text('form[user_name]', $subscribe_customer->id ? $data->user_name : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>

         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">رقم الهوية
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::number('form[id_number]', $subscribe_customer->id ? $data->id_number : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>

         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">الجوال
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::number('form[user_phone]', $subscribe_customer->id ? $data->user_phone : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-3 ">
             <label class="gfield_label pb-1" for="">البريد الإلكتروني
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::email('form[user_mail]', $subscribe_customer->id ? $data->user_mail : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
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
             {!! Form::text('form[name]', $subscribe_customer->id ? $data->name : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-6 ">
             <label class="gfield_label pb-1" for="">المنصب
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[position]', $subscribe_customer->id ? $data->position : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>
         <div class="col-md-12 ">
             <label class="gfield_label pb-1" for="">اسم المندوب
                 <span class="gfield_required">
                     <span class="gfield_required gfield_required_custom">*</span>
                 </span>
             </label>
             {!! Form::text('form[delegate_name]', $subscribe_customer->id ? $data->delegate_name : '', ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
         </div>


     </div>
 </div>
