<div class="w3-block w3-display-container">
    <h2>
        {{ __('measurments') }}
    </h2>
    <hr> 
    @can('subscription.measurements.create')
    <div class="w3-display-topright w3- ">
        <button  class="btn w3-green sb-shadow add_btn"
            onclick="createMeasurment()" >
            <i class="fa fa-plus w3-margin-right"></i>
            {{ __('add') }}
        </button>
    </div>
    @endcan

    <div class="" style="height: 400px;overflow: auto" >
 
        <ul class="w3-ul">
            <li v-for="item in measurments" 
            class="w3-white w3-maring-bottom w3-round sb-shadow w3-display-container" 
            style="width: 90%;margin-bottom: 10px">
                <div class="row">
                    <div class="col-md-1" >
                        <span class="fa fa-address-book w3-xlarge measurment-fa w3-text-green"   ></span>
                    </div>

                    <div class="col-md-9">
                        <h4 class="media-heading">
                            <span v-html="item.name" ></span>
                        </h4>
                        <p v-html="item.description" ></p>
                    </div>

                    <div class="w3-display-topright w3-padding">
                        @can('subscription.measurements.update')
                        <button onclick="editMeasurment($(this).data('object'))" v-bind:data-object="JSON.stringify(item)" class="btn btn-warning w3-round-xlarge btn-sm sb-shadow">
                            <i class="fa fa-edit" ></i>
                        </button>
                        @endcan

                        @can('subscription.measurements.remove')
                        <button onclick="removeMeasurment($(this).data('id'))" v-bind:data-id="item.id" class="btn btn-danger w3-round-xlarge btn-sm sb-shadow">
                            <i class="fa fa-trash" ></i>
                        </button>
                        @endcan
                    </div>
                </div> 
            </li>
            
        </ul>

    </div>

    @include("subscription::measurment.form")

</div>


