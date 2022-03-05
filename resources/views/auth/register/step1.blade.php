<div class="row step step1">

    <div class="col-12">
        <div class=" panel  radio-toolbar w3-padding modal-lg" style="max-width: 600px;">
            <div class="business_type_title my-3">
                <h4>@trans('fill up your information')</h4>
                <br>
            </div>

            <div class="col-sm-12 w3-padding step-min step-min1">

                <div class="col-md-12 text-center">
                    <div class="w3-block text-center">
                        <i class="fa fa-circle w3-text-green"></i>
                        <i class="fa fa-circle w3-text-light-gray"></i>
                    </div>
                    <h6>@trans("first step personal info")</h6>
                    <br>
                </div>

                <div class="col-md-12">
                    <div class="form-group" style="margin-bottom: 7px">
                        <div class="input- ">
                            {!! Form::text('name', null, ['class' => 'form-control name', 'placeholder' => __('business_name'), 'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group" style="margin-bottom: 7px">
                        <div class="input- ">
                            {!! Form::text('first_name', null, ['class' => 'form-control first_name', 'placeholder' => __('first_name'), 'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group" style="margin-bottom: 7px">
                        <div class="input- ">
                            {!! Form::text('last_name', null, ['class' => 'form-control last_name', 'placeholder' => __('last_name'), 'required']) !!}
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 w3-center w3-padding">
                    <br> 
                    <a href="#" class="btn btn-blue text-center my-3 w3-round-xxlarge" onclick="gotoStepMin(2)">
                        Continue
                    </a> 
                </div>
            </div> 

            <div class="col-sm-12 w3-padding step-min step-min2">

                <div class="col-md-12 text-center">
                    <div class="w3-block text-center"> 
                        <i class="fa fa-circle w3-text-green"></i>
                        <i class="fa fa-circle w3-text-green"></i>
                    </div>
                    <h6>@trans("second step login info")</h6>
                    <br>
                </div>

                <div class="col-md-12">
                    <div class="form-group" style="margin-bottom: 7px!important">
                        <div class="input- ">
                            {!! Form::email('email', null, ['class' => 'form-control email', 'placeholder' => __('email'), 'required', 'onblur' => 'validateEmail()']) !!}
                        </div>
                        <p class="email-validation"></p>
                    </div>
                </div> 
                
                <div class="col-md-12">
                    <div class="form-group" style="margin-bottom: 7px!important">
                        <div class="input- ">
                            <div class="w3-display-topright hidden" style="padding: 3px" >
                                <i class="btn fa fa-magic w3-text-green" onclick="generateUsername()" ></i>
                            </div>
                            {!! Form::text('username', null, ['class' => 'form-control username', 'placeholder' => __('username'), 'required', 'readonly']) !!}
                        </div>
                    </div>
                </div> 

                <div class="col-md-12">
                    <div class="form-group w3-display-container" style="margin-bottom: 7px!important"> 
                        <div class="input- ">
                            <div class="w3-display-topright " style="padding: 3px" >
                                <i class="btn fa fa-magic w3-text-green" onclick="generatePassword()" ></i>
                            </div>
                            {!! Form::password('password', ['class' => 'form-control password', 'placeholder' => 'password', 'required']) !!}
                        </div>
                    </div> 
                </div> 

                <div class="col-md-12">
                    <div class="form-group" style="margin-bottom: 7px!important"> 
                        <div class="input- ">
                            {!! Form::password('confirm_password', ['class' => 'form-control confirm_password', 'placeholder' => 'confirm_password', 'required']) !!}
                        </div>
                    </div> 
                </div> 

                <div class="col-md-12 w3-center w3-padding">
                    <br> 
                    <a href="#" class="btn btn-blue text-center my-3 w3-round-xxlarge" onclick="gotoStep(2)">
                        Continue
                    </a> 
                </div>
            </div>
 
 
            <br>
            <br>
        </div>

    </div>

</div>
</div>
