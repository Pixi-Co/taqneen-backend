<div class="w3-block w3-display-container">
    <h2>
        {{ __('class types') }}
    </h2>
    <hr> 
    @can('subscription.class_types.create')
    <div class="w3-display-topright">
        <button class="btn w3-green sb-shadow add_btn" 
            onclick="createClassType()" >
            <i class="fa fa-plus w3-margin-right"></i>
            {{ __('add') }}
        </button>
    </div>
    @endcan

    <div class="w3-padding" style="" >
 
        <div class="row">
        
            <div class="col-md-4" style="padding: 4px!important" v-for="item in class_types" >
                <div  class="w3-white w3-maring-bottom w3-round sb-shadow w3-display-container"  >
                <div class="row">
                    <div class="col-md-2" >
                        <span class="fa fa-trophy w3-xlarge class-type-fa" v-bind:style="'background-color: ' + item.color" ></span>
                    </div>

                    <div class="col-md-8">
                        <h4 class="media-heading" style="margin-left: 5px;margin-right: 5px">
                            <span v-html="item.name" ></span>
                        </h4>
                        <p v-html="item.description" style="margin-left: 5px;margin-right: 5px" ></p>
                    </div>

                    <div class="w3-display-topright w3-padding">
                        
                        @can('subscription.class_types.update')
                        <button onclick="editClassType($(this).data('object'))" v-bind:data-object="JSON.stringify(item)" class="btn btn-warning w3-round-xlarge btn-sm sb-shadow">
                            <i class="fa fa-edit" ></i>
                        </button>
                        @endcan

                        @can('subscription.class_types.delete')
                        <button onclick="removeClassType($(this).data('id'))" v-bind:data-id="item.id" class="btn btn-danger w3-round-xlarge btn-sm sb-shadow">
                            <i class="fa fa-trash" ></i>
                        </button>
                        @endcan
                    </div>
                </div> 
            </div>
            </div>
            
        </div>

    </div>

    @include("subscription::class_type.form")

</div>


