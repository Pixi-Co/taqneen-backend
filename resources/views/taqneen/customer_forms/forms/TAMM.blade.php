 
  <div class="ginput_container ginput_container_checkbox">
      <legend class="gsection_title">  نموزج   تم</legend> 
      <div class="gfield_checkbox" id="input_1_4">
          <div class="gchoice" style="display: inline;">
              <label for="">
                  <input type="checkbox" name="form[choice_new_1]"
                      {{ optional($resource)->choice_new_1 ? 'checked' : '' }}
                      value="{{ optional($resource)->choice_new_1 ? '1' : '0' }}"
                      onchange="this.value = this.checked? '1' : '0'">
                  جديد
              </label>
          </div>
          <div class="gchoice " style="display: inline;">
              <label for="">
                  <input type="checkbox" name="form[choice_new_2]"
                      {{ optional($resource)->choice_new_2 ? 'checked' : '' }}
                      value="{{ optional($resource)->choice_new_2 ? '1' : '0' }}"
                      onchange="this.value = this.checked? '1' : '0'">
                  تجديد
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
              {!! Form::text('form[name_ar]', $resource->name_ar, ['class' => 'form-control', 'placeholder' => '', 'required', "onchange" => "$('.name_ar').val(this.value)"]) !!}
          </div>
          <div class="col-md-3 ">
              <label class="gfield_label pb-1" for="">الاسم الإنجليزي الكامل للمنشأة
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[name_en]', $resource->name_en, ['class' => 'form-control', 'placeholder' => '', 'required', "onchange" => "$('.name_en').val(this.value)"]) !!}
          </div>
          <div class="col-md-3 ">
              <label class="gfield_label pb-1" for="">المدينة
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[city]', $resource->city, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
          {!! Form::hidden("form[short_name_ar]", $resource->short_name_ar, ["class" => "name_ar"]) !!}
          {!! Form::hidden("form[short_name_en]", $resource->short_name_en, ["class" => "name_en"]) !!}

      </div>
      <div class="row pt-3">
          <div class="col-md-3 ">
              <label class="gfield_label pb-1" for="">نوع المنشأة

              </label>
              <div class="gfield_checkbox" id="input_1_4">
                  <div class="gchoice" style="display: inline;">
                      <label for="">
                          <input type="checkbox" name="form[company_type_1]"
                              {{ optional($resource)->company_type_1 ? 'checked' : '' }}
                              value="{{ optional($resource)->company_type_1 ? '1' : '0' }}"
                              onchange="this.value = this.checked? '1' : '0'">
                          شركة
                      </label>
                  </div>
                  <div class="gchoice " style="display: inline;">
                      <label for="">
                          <input type="checkbox" name="form[company_type_2]"
                              {{ optional($resource)->company_type_2 ? 'checked' : '' }}
                              value="{{ optional($resource)->company_type_2 ? '1' : '0' }}"
                              onchange="this.value = this.checked? '1' : '0'">
                          مؤسسة
                      </label>
                  </div>
              </div>
          </div>
          <div class="col-md-3 ">
              <label class="gfield_label pb-1" for="">نشاط المؤسسة الرئيسي :
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[enterprise_activity]', $resource->enterprise_activity, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
          <div class="col-md-3 ">
              <label class="gfield_label pb-1" for="">اسم المالك :
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[owner_name]', $resource->owner_name, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
          <div class="col-md-3 ">
              <label class="gfield_label pb-1" for="">الجوال :
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[owner_phone]', $resource->owner_phone, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
          </div>

      </div>
      <div class="row pt-3">
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">الهاتف
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[owner_phone2]', $resource->owner_phone2, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
          </div>
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">ص.ب
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[mailbox]', $resource->mailbox, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">الرمز البريدي
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[postcode]', $resource->postcode, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
      </div>
      <div class="row pt-3">
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">اسم مسؤول الإتصال
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[person_name]', $resource->person_name, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">جوال
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[person_phone]', $resource->person_phone, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
          </div>
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">البريد الإلكتروني لمسؤول الإتصال
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::email('form[person_mail]', $resource->person_mail, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
      </div>
      <div class="row pt-3">
          <div class="col-md-6 ">
              <label class="gfield_label pb-1" for="">جوال الإشعارات
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[phone_notfic]', $resource->phone_notfic, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
          </div>
          <div class="col-md-6 ">
              <label class="gfield_label pb-1" for="">البريد الإلكتروني للإشعارات
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::email('form[mail_notfic]', optional($resource)->mail_notfic, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>

      </div>
      <div class="row pt-3">
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">رقم السجل التجاري
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[commercial_number]', $resource->commercial_number, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
          </div>
          <div class="col-md-4 ">
              <div class="row ">
                  <label class="gfield_label pb-1 " for="">تاريخ اصدار السجل التجاري
                      <span class="gfield_required">
                          <span class="gfield_required gfield_required_custom">*</span>
                      </span>
                  </label>
                  <div class="col-sm-10">
                      {!! Form::date('form[release_date]', $resource->release_date, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                  </div>
                  <div class="col-sm-2 pt-1">
                      <img class="ui-datepicker-trigger"
                          src="https://taqneen.com/wp-content/plugins/gravityforms/images/datepicker/datepicker.svg"
                          alt="" title="">
                  </div>


              </div>


          </div>
          <div class="col-md-4 ">
              <div class="row ">
                  <label class="gfield_label pb-1 " for="">تاريخ نهاية السجل التجاري
                      <span class="gfield_required">
                          <span class="gfield_required gfield_required_custom">*</span>
                      </span>
                  </label>
                  <div class="col-sm-10">
                      {!! Form::date('form[end_date]', $resource->end_date, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
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
          <h3 class="gsection_title">التكلفة</h3>
          <h3 class="gsection_title pb-4"> معلومات المستخدم الرئيسي </h3>

          <div class="col-md-4">
              <label class="gfield_label pb-1" for="">لغة المستخدم
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              <div class="gfield_checkbox" id="input_1_4">
                  <div class="gchoice" style="display: inline;">
                      <label for="">
                          <input type="checkbox" name="form[lang_1]"
                              {{ optional($resource)->lang_1 ? 'checked' : '' }}
                              value="{{ optional($resource)->lang_1 ? '1' : '0' }}"
                              onchange="this.value = this.checked? '1' : '0'">
                          العربية
                      </label>
                  </div>
                  <div class="gchoice " style="display: inline;">
                      <label for="">
                          <input type="checkbox" name="form[lang_2]"
                              {{ optional($resource)->lang_2 ? 'checked' : '' }}
                              value="{{ optional($resource)->lang_2 ? '1' : '0' }}"
                              onchange="this.value = this.checked? '1' : '0'">
                          الإنجليزية
                      </label>
                  </div>
              </div>
          </div>
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">الإسم بالعربي
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[user_name_ar]', $resource->user_name_ar, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">الإسم بالإنجليزي
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[user_name_en]', $resource->user_name_en, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>


      </div>

      <div class="row pt-3">
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
              {!! Form::text('form[user_phone]', $resource->user_phone, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
          </div>
          <div class="col-md-4 ">
              <label class="gfield_label pb-1" for="">البريد الإلكتروني
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::email('form[user_mail]', $resource->user_mail, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
      </div>
      <div class="row pt-3">
          <h3 class="gsection_title"> معلومات مقدم الطلب </h3>
          <div class="col-md-6 ">
              <label class="gfield_label pb-1" for="">الاسم
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[applicant_name]', $resource->applicant_name, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
          <div class="col-md-6 ">
              <label class="gfield_label pb-1" for="">المنصب
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[position]', $resource->position, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
          </div>
          <div class="col-md-6 ">
              <label class="gfield_label pb-1" for="">رقم الهوية
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[identifi_number]', $resource->identifi_number, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
          </div>
          <div class="col-md-6 ">
              <label class="gfield_label pb-1" for="">الجوال
                  <span class="gfield_required">
                      <span class="gfield_required gfield_required_custom">*</span>
                  </span>
              </label>
              {!! Form::text('form[applicant_phone]', $resource->applicant_phone, ['class' => 'form-control', 'placeholder' => '', 'required', 'maxlength' => 10]) !!}
          </div>
         
          <div class="col-md-12 pb-5">
            <label class="gfield_label pb-1" for="">
                اسم المندوب 
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            {!! Form::select('form[courier_name]', App\User::where('user_type', 'user')->selectRaw('CONCAT(first_name, last_name) as name')->pluck('name', 'name')->toArray(), $resource->courier_name, ["class"=>"form-select", "required"]) !!}
        </div>

      </div>
       

  </div>

  <br>
