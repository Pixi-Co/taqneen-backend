<div class="modal fade session-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title text-capitalize" v-if="session_resource.id">{{ __('edit session') }}</h4>
                <h4 class="modal-title text-capitalize" v-if="!session_resource.id">{{ __('add session') }}</h4>

            </div>
            <form method="post" action="{{ url('/sub/session/save') }}" class="session-form"
                v-bind:id="session_resource.id? 'sessionEdit' : 'sessionAdd'">
                <div class="modal-body">
 
                    <div class="">

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('name') }} </b>
                            </div>
                            <div class="col-md-9">
                                <input name="name" required type="text" placeholder="{{ __('name') }}"
                                    class="form-control w3-block w3-light-gray" v-model="session_resource.name">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 8px">
                            <div class="col-md-3">
                                <b> {{ __('description') }} </b>
                            </div>
                            <div class="col-md-9">
                                <input name="description" type="text" placeholder="{{ __('description') }}"
                                    class="form-control w3-block w3-light-gray" v-model="session_resource.description">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('group_number') }} </b>
                            </div>
                            <div class="col-md-9">
                                <input name="group_number" required type="number"
                                    placeholder="{{ __('group_number') }}"
                                    class="form-control w3-block w3-light-gray" v-model="session_resource.group_number">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('class type') }} </b>
                            </div>
                            <div class="col-md-9">
                                <select name="class_type_id" required class="form-control w3-block w3-light-gray"
                                    v-model="session_resource.class_type_id">
                                    @foreach (Modules\Subscription\Entities\ClassType::active() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('Trainer') }} </b>
                            </div>
                            <div class="col-md-9">
                                <select name="trainer_id" required class="form-control w3-block w3-light-gray"
                                    v-model="session_resource.trainer_id">
                                    @foreach (Modules\Subscription\Entities\Trainer::active() as $item)
                                        <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @can_bt(['customer_group'])
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('customer group') }} </b>
                            </div>
                            <div class="col-md-9">
                                <select name="customer_group_id" class="form-control w3-block w3-light-gray"
                                    v-model="session_resource.customer_group_id">
                                    <option value="">@trans('select one')</option>
                                    @foreach (App\CustomerGroup::active()->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endcan_bt
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('date from') }} </b>
                            </div>
                            <div class="col-md-9">
                                <input name="date_from" required type="date"
                                    style="width: 100%!important;margin-top: inherit!important"
                                    placeholder="{{ __('from') }}" class="form-control w3-block w3-light-gray"
                                    v-model="session_resource.date_from">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('date to') }} </b>
                            </div>
                            <div class="col-md-9">
                                <input name="date_to" required type="date"
                                    style="width: 100%!important;margin-top: inherit!important"
                                    placeholder="{{ __('to') }}" class="form-control w3-block w3-light-gray"
                                    v-model="session_resource.date_to">
                            </div>
                        </div>
                    </div>
                    <div class="">

                        <div class="row" style="margin-bottom: 5px">
                            <div class="w3-padding">
                                <table class="w3-table table-bordered text-center">
                                    <tr>
                                        <th></th>
                                        <th class="w3-green">@trans('time from')</th>
                                        <th class="w3-green">@trans('time to')</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td class="w3-green">@trans('sat')</td>
                                        <td>
                                            <input name="sat_from"  type="time" placeholder="{{ __('from') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.sat_from">
                                        </td>
                                        <td>
                                            <input name="sat_to"  type="time" placeholder="{{ __('to') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.sat_to">
                                        </td>
                                        <td> 
                                            <button class="w3-text-red w3-round btn" type="button" onclick="$(this).parent().parent().find('input').val('')" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w3-green">@trans('sun')</td>
                                        <td>
                                            <input name="sun_from"  type="time" placeholder="{{ __('from') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.sun_from">
                                        </td>
                                        <td>
                                            <input name="sun_to"  type="time" placeholder="{{ __('to') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.sun_to">
                                        </td>
                                        <td> 
                                            <button class="w3-text-red w3-round btn" type="button" onclick="$(this).parent().parent().find('input').val('')" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w3-green">@trans('mon')</td>
                                        <td>
                                            <input name="mon_from"  type="time" placeholder="{{ __('from') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.mon_from">
                                        </td>
                                        <td>
                                            <input name="mon_to"  type="time" placeholder="{{ __('to') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.mon_to">
                                        </td>
                                        <td> 
                                            <button class="w3-text-red w3-round btn" type="button" onclick="$(this).parent().parent().find('input').val('')" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w3-green">@trans('tue')</td>
                                        <td>
                                            <input name="tue_from"  type="time" placeholder="{{ __('from') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.tue_from">
                                        </td>
                                        <td>
                                            <input name="tue_to"  type="time" placeholder="{{ __('to') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.tue_to">
                                        </td>
                                        <td> 
                                            <button class="w3-text-red w3-round btn" type="button" onclick="$(this).parent().parent().find('input').val('')" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w3-green">@trans('wed')</td>
                                        <td>
                                            <input name="wed_from"  type="time" placeholder="{{ __('from') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.wed_from">
                                        </td>
                                        <td>
                                            <input name="wed_to"  type="time" placeholder="{{ __('to') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.wed_to">
                                        </td>
                                        <td> 
                                            <button class="w3-text-red w3-round btn" type="button" onclick="$(this).parent().parent().find('input').val('')" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w3-green">@trans('thu')</td>
                                        <td>
                                            <input name="thu_from"  type="time" placeholder="{{ __('from') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.thu_from">
                                        </td>
                                        <td>
                                            <input name="thu_to"  type="time" placeholder="{{ __('to') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.thu_to">
                                        </td>
                                        <td> 
                                            <button class="w3-text-red w3-round btn" type="button" onclick="$(this).parent().parent().find('input').val('')" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w3-green">@trans('fri')</td>
                                        <td>
                                            <input name="fri_from"  type="time" placeholder="{{ __('from') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.fri_from">
                                        </td>
                                        <td>
                                            <input name="fri_to"  type="time" placeholder="{{ __('to') }}"
                                                class="form-control w3-block w3-light-gray"
                                                v-model="session_resource.fri_to">
                                        </td>
                                        <td> 
                                            <button class="w3-text-red w3-round btn" type="button" onclick="$(this).parent().parent().find('input').val('')" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" v-model="session_resource.id">


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
