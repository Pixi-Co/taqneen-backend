@csrf 
<input type="hidden" name="customer_type" value="{{ $instance::$EDIT_SUBSCRIPE_MUQEEM_MODEL_KEY }}">
<div class="ginput_container ">
    <h3 class="gsection_title pb-3">بيانات المنشأة</h3>
    <div class="row">
        <div class="col-md-6">
            <label class="gfield_label pb-1" for="">رقم المنشأة بوزارة الداخلية
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            <input class="form-control" name="form[company_num]" type="number" value="70" required
                placeholder="70xxxxxxxxxxx" id="company_num">
            <div class="charleft ginput_counter warningTextareaInfo" aria-live="polite">0 من 10 حرف كحد أقصى</div>
        </div>
        <div class="col-md-6 ">
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
        <div class="col-md-3 ">
            <label class="gfield_label pb-1" for="">اسم المستخدم
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            <input class="form-control" name="form[user_name]" type="text" value="" id="user_name" required
                placeholder="الأسم الأول والأخير">
        </div>
        <div class="col-md-3 ">
            <label class="gfield_label pb-1" for="">رقم الهوية / الإقامة
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            <input class="form-control" name="form[user_identifi]" type="number" value="" id="user_identifi"
                placeholder="05xxxxxxxx" required>
        </div>
        <div class="col-md-3 ">
            <label class="gfield_label pb-1" for="">الجوال
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            <input class="form-control" name="form[user_phone]" type="text" value="" id="user_phone"
                placeholder="05xxxxxxxx" required>
        </div>
        <div class="col-md-3 ">
            <label class="gfield_label pb-1" for="">البريد الإلكتروني
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            <input class="form-control" name="form[user_email]" type="email" value="" id="user_email" required>
        </div>
    </div>

    <div class="row pt-3 pb-3">
        <h4 class="gsection_title pb-3 pt-3"> معلومات المستخدم الرئيسي (المطلوب حذفه)</h4>
        <div class="col-md-3 ">
            <label class="gfield_label pb-1" for="">اسم المستخدم
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            <input class="form-control" name="form[user_name_delete]" type="text" value="" id="user_name" required
                placeholder="الأسم الأول والأخير">
        </div>
        <div class="col-md-3 ">
            <label class="gfield_label pb-1" for="">رقم الهوية / الإقامة
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            <input class="form-control" name="form[user_identifi_delete]" type="number" value="" id="user_identifi"
                placeholder="05xxxxxxxx" required>
        </div>
    </div>
    <div class="row pt-3 pb-3">
        <h4 class="gsection_title pb-3 pt-3"> معلومات المستخدمين الآخرين</h4>
        <h6 class="gsection_title">هل يوجد مستخدمين رئيسين اخرين تريد حذفهم ؟</h6>

        <div class="gfield_checkbox" id="input_1_4">
            <div class="gchoice" style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="1" id="choice">
                <label for="choice">1</label>
            </div>
            <div class="gchoice " style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="2" id="choice">
                <label for="choice">2</label>
            </div>
            <div class="gchoice " style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="3" id="choice">
                <label for="choice">3</label>
            </div>
            <div class="gchoice " style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="4" id="choice">
                <label for="choice">4</label>
            </div>
            <div class="gchoice " style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="5" id="choice">
                <label for="choice">5</label>
            </div>
            <div class="gchoice " style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="6" id="choice">
                <label for="choice"> 6 </label>
            </div>
            <div class="gchoice " style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="7" id="choice">
                <label for="choice">7</label>
            </div>
            <div class="gchoice " style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="8" id="choice">
                <label for="choice">8</label>
            </div>
            <div class="gchoice " style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="9" id="choice">
                <label for="choice">9</label>
            </div>
            <div class="gchoice " style="display: inline;">
                <input class="gfield-choice-input" name="form[choice_process]" type="radio" value="10" id="choice">
                <label for="choice">10</label>
            </div>
        </div>
        <div class="row" id="show_input">

        </div>
    </div>
    <div class="row pt-3 pb-3">
        <h4 class="gsection_title pb-3 pt-3">معلومات مقدم الطلب</h4>
        <div class="col-md-6 ">
            <label class="gfield_label pb-1" for="">الاسم
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            <input class="form-control" name="form[applicant_name]" type="text" value="" id="applicant_name" required
                placeholder="الأسم الأول والأخير">
        </div>
        <div class="col-md-6 ">
            <label class="gfield_label pb-1" for="">المنصب
                <span class="gfield_required">
                    <span class="gfield_required gfield_required_custom">*</span>
                </span>
            </label>
            <input class="form-control" name="form[position]" type="text" value="" id="position" placeholder=""
                required>
        </div>
    </div>
</div>

<br>
