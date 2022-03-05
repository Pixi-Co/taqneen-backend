<div class="w3-block w3-display-container">
    <h2>
        {{ __('football_orders') }}
    </h2>
    <hr>
    <div class="w3-display-topright w3- ">
        @can('subscription.football_orders.create')
            <button  class="btn w3-green sb-shadow add_btn" onclick="createFootballOrder()" style="width: 180px">
                <i class="fa fa-plus w3-margin-right"></i>
                {{ __('add football_order') }}
            </button>
        @endcan
    </div>

    <div class="" style="height: 400px;overflow: auto">
        <!-- Main content -->
        <section class="content new-content">

            @can('subscription.football_orders.view')
                <div class="table-responsive light-gray w3-border w3-border-light-gray">


                    <table id="footballOrderTable" data-title="{{ __('football_orders') }}"
                        class="custom-datatable table table-striped table-hover" style="width: 100%">
                        <thead>
                            <tr>
                                <th>@trans( 'name' )</th>
                                <th>@trans( 'description' )</th>
                                <th>@trans( 'group' )</th>
                                <th>@trans( 'contact' )</th>
                                <th>@trans( 'date' )</th>
                                <th>@trans( 'start_time' )</th>
                                <th>@trans( 'end_time' )</th>  
                                <th>@trans( 'class type' )</th> 
                                <th>@trans( 'messages.action' )</th> 
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcan 

        </section>
        <!-- /.content -->

    </div>

    @include("subscription::football_order.form") 

</div>
