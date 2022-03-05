<div class="modal fade member_measurement-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title text-capitalize" v-if="member_measurement_resource.id">{{ __('edit member_measurement') }}</h4>
                <h4 class="modal-title text-capitalize" v-if="!member_measurement_resource.id">{{ __('add member_measurement') }}</h4>

            </div>
            <form method="post" action="{{ url('/sub/member-measurement/save') }}" class="member_measurement-form"
                v-bind:id="member_measurement_resource.id? 'member_measurementEdit' : 'member_measurementAdd'">
                <div class="modal-body">

                    <input type="hidden" name="id" v-model="member_measurement_resource.id">
   

                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('measurments') }} </b>
                        </div>
                        <div class="col-md-9">
                            <select name="measurement_id" required class="form-control w3-block w3-light-gray" v-model="member_measurement_resource.measurement_id">
                                @foreach(Modules\Subscription\Entities\Measurement::active() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>    
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-3">
                            <b> {{ __('members') }} </b>
                        </div>
                        <div class="col-md-9">
                            <select name="member_id" required class="form-control w3-block w3-light-gray" v-model="member_measurement_resource.member_id">
                                @foreach(Modules\Subscription\Entities\Member::active() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-bottom: 5px" >
                        <div class="col-md-3">
                            <b> {{ __('result') }} </b>
                        </div> 
                        <div class="col-md-9">
                            <input name="result" required type="number" placeholder="{{ __('result') }}" class="form-control w3-block w3-light-gray"
                                v-model="member_measurement_resource.result">
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
