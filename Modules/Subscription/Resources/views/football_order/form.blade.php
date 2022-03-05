
@php
$walk_in_customer = (new App\Utils\ContactUtil)->getWalkInCustomer(session('business.id')); 
$customer_groups = App\CustomerGroup::forDropdown(session('business.id'));
$types = App\Contact::getContactTypes();
@endphp
<div class="modal fade football-order-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title text-capitalize" v-if="football_order_resource.id">{{ __('edit football order') }}
                </h4>
                <h4 class="modal-title text-capitalize" v-if="!football_order_resource.id">{{ __('add football order') }}
                </h4>

            </div>
            <form method="post" action="{{ url('/sub/football-order/save') }}" class="football-order-form"
                v-bind:id="football_order_resource.id? 'footballOrderEdit' : 'footballOrderAdd'">
                <div class="modal-body">

                    <input type="hidden" name="id" v-model="football_order_resource.id">
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{ __('date') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="date" readonly style="width: 100%" value="{{ date('Y-m-d') }}" required type="date" class="date form-control w3-block w3-light-gray"
                                v-model="football_order_resource.date">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{ __('start_time') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="start_time" readonly type="time" class="start_time form-control w3-block w3-light-gray"
                                v-model="football_order_resource.start_time">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{ __('name') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="name" required type="text" class="form-control w3-block w3-light-gray"
                                v-model="football_order_resource.name">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{ __('contact') }} </b>
                        </div>
                        <div class="col-md-9 w3-padding">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon hidden">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="hidden" id="default_customer_id" 
                                    value="{{ $walk_in_customer['id'] ?? ''}}" >
                                    <input type="hidden" id="default_customer_name" 
                                    value="{{ $walk_in_customer['name'] ?? ''}}" >
                                    <input type="hidden" id="default_customer_balance" 
                                    value="{{ $walk_in_customer['balance'] ?? ''}}" >
                                    <input type="hidden" id="default_customer_address" 
                                    value="{{ $walk_in_customer['shipping_address'] ?? ''}}" >
                                    @if(!empty($walk_in_customer['price_calculation_type']) && $walk_in_customer['price_calculation_type'] == 'selling_price_group')
                                        <input type="hidden" id="default_selling_price_group" 
                                    value="{{ $walk_in_customer['selling_price_group_id'] ?? ''}}" >
                                    @endif
                                    {!! Form::select('contact_id', [], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 100%;display: none']); !!}
                                     <span class="input-group-addon  w3-green w3-round" style="padding: 0px;border-radius: 7px" >
                                        <button type="button" class="btn add_new_customer" data-name=""  @if(!auth()->user()->can('customer.create')) disabled @endif><i class="fa fa-plus-circle fa-lg"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{ __('end_time') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="end_time" type="time" class="end_time form-control w3-block w3-light-gray"
                                v-model="football_order_resource.end_time">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{ __('group_number') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="group_number" type="number" class="form-control w3-block w3-light-gray"
                                v-model="football_order_resource.group_number">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{ __('description') }} </b>
                        </div>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control w3-block w3-light-gray"
                                v-model="football_order_resource.description"></textarea>
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


<div class="modal fade contact_modal" tabindex="-1" style="z-index: 999999999999999" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('contact.create', ['quick_add' => true])
</div>
