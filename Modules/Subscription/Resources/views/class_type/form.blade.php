<div class="modal fade class-type-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title text-capitalize" v-if="class_type_resource.id">{{ __('edit class Type') }}</h4>
                <h4 class="modal-title text-capitalize" v-if="!class_type_resource.id">{{ __('add class Type') }}</h4>
 
            </div>
            <form method="post" action="{{ url('/sub/class-type/save') }}" class="class-type-form" v-bind:id="class_type_resource.id? 'classTypeEdit' : 'classTypeAdd'" >
            <div class="modal-body">
                
                    <input type="hidden" name="id" v-model="class_type_resource.id">
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{  __('name') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="name" required type="text" class="form-control w3-block w3-light-gray" v-model="class_type_resource.name"  >
                        </div>
                    </div> 
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{  __('color') }} </b>
                        </div>
                        <div class="col-md-9">
                            <input name="color" required type="color" class="form-control w3-block w3-light-gray" v-model="class_type_resource.color"  >
                        </div>
                    </div> 
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{  __('description') }} </b>
                        </div>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control w3-block w3-light-gray"  v-model="class_type_resource.description" ></textarea>
                        </div>
                    </div> 
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <b> {{  __('type') }} </b>
                        </div>
                        <div class="col-md-9">
                            <select name="type" class="form-control w3-block w3-light-gray" v-model="class_type_resource.type">
                                <option value="">@trans('none')</option>
                                <option value="football">@trans('football')</option>
                            </select>
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
