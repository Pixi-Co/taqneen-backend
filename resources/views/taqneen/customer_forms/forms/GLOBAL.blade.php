<div class="col-md-12 ">
    <label class="gfield_label pb-1" for="">اسم المندوب
        <span class="gfield_required">
            <span class="gfield_required gfield_required_custom"></span>
        </span>
    </label>
    {!! Form::select('form[courier_name]', $users, $resource->courier_name, ['class' => 'form-select', "placeholder" => "اختر المندوب"]) !!}
</div>

<div class="col-md-12 ">
    <label class="gfield_label pb-1" for="">
        ايميل المستحدم لتفعيل الاشعار 
        <span class="gfield_required">
            <span class="gfield_required gfield_required_custom"></span>
        </span>
    </label>
    {!! Form::email("form[user_triger_email]", $resource->user_triger_email, ["class" => "form-control", "placeholder" => "example@gmail.com"]) !!}
</div>
