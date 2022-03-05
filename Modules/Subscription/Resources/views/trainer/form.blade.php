<div class="modal fade trainer-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title text-capitalize" v-if="trainer_resource.id">{{ __('edit trainer') }}</h4>
                <h4 class="modal-title text-capitalize" v-if="!trainer_resource.id">{{ __('add trainer') }}</h4>

            </div>
            <form method="post" action="{{ url('/sub/trainer/save') }}" class="form"
                v-bind:id="trainer_resource.id? 'trainerEdit' : 'trainerAdd'">
                <div class="modal-body">

                    <input type="hidden" name="id" v-model="trainer_resource.id">

                    <div class="row" style="margin-bottom: 5px" >
                        <div class="col-md-3">
                            <b> {{ __('name') }} </b>
                        </div>
                        <div class="col-md-5">
                            <input name="first_name" required type="text" placeholder="{{ __('first_name') }}" class="form-control w3-block w3-light-gray"
                                v-model="trainer_resource.first_name">
                        </div>
                        <div class="col-md-4">
                            <input name="last_name" required type="text" placeholder="{{ __('last_name') }}" class="form-control w3-block w3-light-gray"
                                v-model="trainer_resource.last_name">
                        </div>
                    </div>  
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('class type') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input type="hidden" name="class_type_ids"  class="class_type_ids" >
                            <select name="class_type_ids_select" onchange="setClassTypes()" multiple required class="class_type_ids_select form-control w3-block w3-light-gray"   >
                                @foreach(Modules\Subscription\Entities\ClassType::active() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('username') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="username" required type="text" placeholder="{{ __('username') }}" class="form-control w3-block w3-light-gray"
                                v-model="trainer_resource.username">
                            <p v-if="!trainer_resource.id && trainer_resource.username" >
                                @trans('username of login') : <span v-html="trainer_resource.username + '-' + business_id" ></span>
                            </p>
                        </div>
                    </div> 
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('password') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="password" type="password"   placeholder="{{ __('password') }}" class="form-control w3-block w3-light-gray"
                                v-model="trainer_resource.password">
                        </div>
                    </div> 
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('email') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="email" required type="text" placeholder="{{ __('email') }}" class="form-control w3-block w3-light-gray"
                                v-model="trainer_resource.email">
                        </div>
                    </div> 
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('address') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="address" required type="text" placeholder="{{ __('address') }}" class="form-control w3-block w3-light-gray"
                                v-model="trainer_resource.address">
                        </div>
                    </div> 
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('salary') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="salary" type="number" placeholder="{{ __('salary') }}" class="form-control w3-block w3-light-gray"  v-model="trainer_resource.salary">
                        </div>
                    </div> 
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('profit_percent') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="profit_percent"  type="number" placeholder="{{ __('profit_percent') }}" class="form-control w3-block w3-light-gray"  v-model="trainer_resource.profit_percent">
                        </div>
                    </div> 
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('status') }} </b>
                        </div>
                        <div class="col-md-9">
                            <select name="status" required class="form-control w3-block w3-light-gray"
                                v-model="trainer_resource.status">
                                <option value="active">{{ __('active') }}</option>
                                <option value="inactive">{{ __('inactive') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default w3-round-xlarge sb-shadow"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit"
                        class="btn btn-primary w3-round-xlarge sb-shadow">{{ __('Save changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
