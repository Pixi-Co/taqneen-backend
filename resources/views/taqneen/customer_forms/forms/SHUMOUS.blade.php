    @php
    $activity_type=[
        'وحدات ايواء' => 'وحدات ايواء',
        'محلات ذهب' => 'محلات ذهب',
        'تأجير السيارات' => 'تأجير السيارات',
        'المجمعات الخاصة' => 'المجمعات الخاصة',
        'المكاتب العقارية' => 'المكاتب العقارية',
        'مقاهي الانترنت' => 'مقاهي الانترنت',
        'شركة الحراسات الامنية الخاصة' => 'شركة الحراسات الامنية الخاصة',
        'السكك الحديدية' => 'السكك الحديدية',
        'مكاتب النقل العام' => 'مكاتب النقل العام',
        'مكاتب نقل المركبات' => 'مكاتب نقل المركبات',
        'مواقف السيارات العامة' => 'مواقف السيارات العامة',
        'الاثاث' => 'الاثاث',
        'مكاتب ترحيل الافراد' => 'مكاتب ترحيل الافراد',
        'تشاليح السيارات' => 'تشاليح السيارات',
        'النوادي الصحية' => 'النوادي الصحية'
    ];
    @endphp
   <div class="ginput_container ">
    <legend class="gsection_title">نموذج شموس </legend>
       <h3 class="gsection_title">بيانات المنشأة</h3>
       <div class="row">
           <div class="col-md-4">
               <label class="gfield_label pb-1" for="">اسم المنشأة
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[company_name]', $resource->company_name, ['class' => 'form-control', 'required']) !!}
               {{-- <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من  10 حرف كحد أقصى</div> --}}
           </div>
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">نوع النشاط
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::select('form[activity_type]', $activity_type, $resource->activity_type, ['class' => 'form-select', 'required', 'placeholder' => 'حدد نوع المنشأ']) !!}

           </div>
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">اسم المالك
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[owner_name]', $resource->owner_name, ['class' => 'form-control', 'required']) !!}
           </div>


       </div>
       <div class="row pt-3">
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">رقم الهوية :
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[owner_identifi]', $resource->owner_identifi, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}

           </div>
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">رقم الجوال:
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[owner_phone]', $resource->owner_phone, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
           </div>
           <div class="col-md-3 ">
               <label class="gfield_label pb-1" for="">المدينة / المحافظة
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[city]', $resource->city, ['class' => 'form-control', 'required']) !!}
           </div>
       </div>
       <div class="row pt-3">
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">اسم الحي
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[neighborhood_name]', $resource->neighborhood_name, ['class' => 'form-control', 'required']) !!}
           </div>
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">اسم الشارع
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[street_name]', $resource->street_name, ['class' => 'form-control', 'required']) !!}
           </div>
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">وصف العنوان
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom"></span>
                   </span>
               </label>
               {!! Form::text('form[addrees]', $resource->addrees, ['class' => 'form-control', '']) !!}
           </div>
       </div>
       <div class="row pt-3">
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">رقم الهاتف
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom"></span>
                   </span>
               </label>
               {!! Form::text('form[enterprise_phone]', $resource->enterprise_phone, ['class' => 'form-control related', '', 'maxlength' => 10, 'data-related' => 'phone']) !!}
           </div>
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">رقم الفاكس
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom"></span>
                   </span>
               </label>
               {!! Form::text('form[enterprise_fax]', $resource->enterprise_fax, ['class' => 'form-control', '']) !!}
           </div>
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">البريد الإلكتروني
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::email('form[enterprise_email]', $resource->enterprise_email, ['class' => 'form-control', 'required']) !!}
           </div>

       </div>
       <div class="row pt-3">
           <div class="col-md-6 ">
               <label class="gfield_label pb-1" for="">ص.ب
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[mailbox]', $resource->mailbox, ['class' => 'form-control', 'required']) !!}
           </div>
           <div class="col-md-6 ">
               <label class="gfield_label pb-1" for="">الرمز البريدي
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[postcode]', $resource->postcode, ['class' => 'form-control', 'required']) !!}
           </div>
       </div>
       <div class="row pt-3">
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">اسم المستخدم
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[user_name]', $resource->user_name, ['class' => 'form-control', 'required']) !!}
           </div>
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">رقم الهوية
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[user_identifi]', $resource->user_identifi, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
           </div>
           <div class="col-md-4 ">
               <label class="gfield_label pb-1" for="">البريد الإلكتروني
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::email('form[user_email]', $resource->user_email, ['class' => 'form-control', 'required']) !!}
           </div>
       </div>
       <div class="row pt-3">
           <div class="col-md-6 ">
               <label class="gfield_label pb-1" for="">نوع الهوية</label>
               <div class="gfield_checkbox" id="input_1_4">
                   <div class="gchoice" style="display: inline;">
                       <label for="">
                           <input type="checkbox" name="form[id_type_1]"
                               {{ optional($resource)->id_type_1 ? 'checked': '0' }}
                               value="{{ optional($resource)->id_type_1 ? '1' : '0' }}"
                               onchange="this.value = this.checked? '1' : '0'">
                           بطاقة
                       </label>
                   </div>
                   <div class="gchoice " style="display: inline;">
                       <label for="">
                           <input type="checkbox" name="form[id_type_2]"
                               {{ optional($resource)->id_type_2 ? 'checked': '0' }}
                               value="{{ optional($resource)->id_type_2 ? '1' : '0' }}"
                               onchange="this.value = this.checked? '1' : '0'">
                           اقامة
                       </label>
                   </div>
               </div>
           </div>
           <div class="col-md-6 ">
               <label class="gfield_label pb-1" for="">رقم الجوال :
                   <span class="gfield_required">
                       <span class="gfield_required gfield_required_custom">*</span>
                   </span>
               </label>
               {!! Form::text('form[user_phone]', $resource->user_phone, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
           </div>

       </div>

       <div class="row pt-3">
           <h3 class="gsection_title"> بيانات الإشتراك</h3>
           <div class="gsection_description pt-4" id="gfield_description_8_179">رسوم التسجيل في شموس 700 ر.س</div>
           <div class="col-md-12 pt-5">
               <div class="row ">
                   <label class="gfield_label pb-1 " for="">تاريخ الإشتراك
                       <span class="gfield_required">
                           <span class="gfield_required gfield_required_custom">*</span>
                       </span>
                   </label>
                   <div class="col-sm-11">
                       {!! Form::date('form[subscription_date]', $resource->subscription_date?? date('Y-m-d'), ['class' => 'form-control', 'required', "readonly"]) !!}
                   </div>
                   <div class="col-sm-1 pt-1">
                       <img class="ui-datepicker-trigger"
                           src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg"
                           alt="" title="">
                   </div>


               </div>


           </div>


           @include("taqneen.customer_forms.forms.GLOBAL")


       </div>
   </div>

   <br>
