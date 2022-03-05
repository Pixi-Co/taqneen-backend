<div class="modal fade rate-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title text-capitalize" v-if="rate_resource.id">{{ __('edit rate') }}</h4>
                <h4 class="modal-title text-capitalize" v-if="!rate_resource.id">{{ __('add rate') }}</h4>

            </div>
            <form method="post" action="{{ url('/sub/rate/save') }}" class="rate-form"
                v-bind:id="rate_resource.id? 'rateEdit' : 'rateAdd'">
                <div class="modal-body">

                    <input type="hidden" name="id" v-model="rate_resource.id">

                    <div class="row" style="margin-bottom: 5px" >
                        <div class="col-md-3">
                            <b> {{ __('name') }} </b>
                        </div> 
                        <div class="col-md-9">
                            <input name="name" required type="text" placeholder="{{ __('name') }}" class="form-control w3-block w3-light-gray"
                                v-model="rate_resource.name">
                        </div>
                    </div> 
                    <div class="row" style="margin-bottom: 8px" >
                        <div class="col-md-3">
                            <b> {{ __('description') }} </b>
                        </div> 
                        <div class="col-md-9">
                            <input name="description" type="text" placeholder="{{ __('description') }}" class="form-control w3-block w3-light-gray"
                                v-model="rate_resource.description">
                        </div>
                    </div>   
                    <div class="row" style="margin-bottom: 5px" >
                        <div class="col-md-3">
                            <b> {{ __('show in rates page') }} </b>
                        </div> 
                        <div class="col-md-9">
                            <input name="active" class="active_rate" required type="checkbox"  >
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
