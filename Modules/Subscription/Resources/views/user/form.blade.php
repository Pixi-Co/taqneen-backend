<div class="modal fade member-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title text-capitalize" v-if="member_resource.id">{{ __('edit member') }}</h4>
                <h4 class="modal-title text-capitalize" v-if="!member_resource.id">{{ __('add member') }}</h4>
 
            </div>
            <form method="post" action="{{ url('/sub/class-type/save') }}" class="form" v-bind:id="member_resource.id? 'classTypeEdit' : 'classTypeAdd'" >
            <div class="modal-body">
                
                    <input type="hidden" name="id" v-model="member_resource.id">

                    <div class="row">
                        <div class="col-md-3">
                            <b> {{  __('name') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="name" required type="text" class="form-control w3-block w3-light-gray" v-model="member_resource.name"  >
                        </div>
                    </div> 
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{  __('description') }} </b>
                        </div>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control w3-block w3-light-gray"  v-model="member_resource.description" ></textarea>
                        </div>
                    </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default w3-round-xlarge sb-shadow" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="submit" class="btn btn-primary w3-round-xlarge sb-shadow">{{ __('Save changes') }}</button>
            </div>
        </form>
        </div>
    </div>
</div>
