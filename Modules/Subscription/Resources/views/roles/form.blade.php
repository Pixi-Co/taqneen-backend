<div class="row">
    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label>@trans( 'subscriptions' ):</label>
    </div>
</div>
<div class="row check_group">
    <div class="col-md-2">
        <div class="checkbox">
            <label>
                <input type="checkbox" class="check_all input-icheck no-icheck"> @trans( 'subscriptions' )
            </label>
        </div>
    </div>
    <div class="col-md-9">
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.module'), in_array('subscription.module', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('subscription module') }}
                </label>
                @include("layouts.partials.tooltip", ["text" => __('must check to enable all subscription
                permissions')])
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.class_types.view'), in_array('subscription.class_types.view', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('class types') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.class_types.create'), in_array('subscription.class_types.create', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('add class types') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.class_types.update'), in_array('subscription.class_types.update', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('edit class types') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.class_types.delete'), in_array('subscription.class_types.delete', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('remove class types') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div> 

        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.trainers.view'), in_array('subscription.trainers.view', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('trainer') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.trainers.show'), in_array('subscription.trainers.show', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('trainer profile') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.trainers.create'), in_array('subscription.trainers.create', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('add trainer') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.trainers.update'), in_array('subscription.trainers.update', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('edit trainer') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.trainers.delete'), in_array('subscription.trainers.delete', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('remove trainer') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div> 
 

        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.rates.view'), in_array('subscription.rates.view', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('rates') }}
                </label>
            </div>
        </div> 
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.rates.create'), in_array('subscription.rates.create', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('add rates') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.rates.update'), in_array('subscription.rates.update', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('edit rates') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.rates.delete'), in_array('subscription.rates.delete', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('remove rates') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div> 


        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.sessions.view'), in_array('subscription.sessions.view', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('sessions') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.sessions.show'), in_array('subscription.sessions.show', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('session view') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.sessions.create'), in_array('subscription.sessions.create', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('add sessions') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.sessions.update'), in_array('subscription.sessions.update', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('edit sessions') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.sessions.delete'), in_array('subscription.sessions.delete', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('remove sessions') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div> 


        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.memberships.view'), in_array('subscription.memberships.view', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('memberships') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.memberships.show'), in_array('subscription.memberships.show', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('memberships view') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.memberships.create'), in_array('subscription.memberships.create', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('add memberships') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.memberships.update'), in_array('subscription.memberships.update', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('edit memberships') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.memberships.delete'), in_array('subscription.memberships.delete', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('remove memberships') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.measurements.view'), in_array('subscription.measurements.view', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('measurements') }}
                </label>
            </div>
        </div> 
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.measurements.create'), in_array('subscription.measurements.create', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('add measurements') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.measurements.update'), in_array('subscription.measurements.update', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('edit measurements') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.measurements.delete'), in_array('subscription.measurements.delete', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('remove measurements') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>  


        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.calendar'), in_array('subscription.calendar', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('calendar') }}
                </label>
            </div>
        </div> 
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.view'), in_array('subscription.view', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('view all subscriptions') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.create'), in_array('subscription.create', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('sub_pos') }}
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.receiption'), in_array('subscription.receiption', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('receiption page') }}
                </label>
            </div>
        </div> 
        <div class="col-md-12">
            <hr>
        </div>  


        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.report.attendances'), in_array('subscription.report.attendances', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('attendances report') }}
                </label>
            </div>
        </div>  
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.report.trainers'), in_array('subscription.report.trainers', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('trainers report') }}
                </label>
            </div>
        </div>  
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.report.subscriptions'), in_array('subscription.report.subscriptions', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('subscriptions report') }}
                </label>
            </div>
        </div> 
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.report.measurements'), in_array('subscription.report.measurements', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('measurements report') }}
                </label>
            </div>
        </div> 
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.report.rates'), in_array('subscription.report.rates', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('rates report') }}
                </label>
            </div>
        </div> 
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('permissions[]', find_or_create_p('subscription.report.trainer_percents'), in_array('subscription.report.trainer_percents', $role_permissions), ['class' => 'input-icheck no-icheck']) !!} {{ __('trainer percents report') }}
                </label>
            </div>
        </div> 
        <div class="col-md-12">
            <hr>
        </div>  
    </div>
</div>
