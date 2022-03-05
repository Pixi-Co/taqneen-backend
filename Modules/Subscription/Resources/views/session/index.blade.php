<div class="w3-block w3-display-container">
    <h2>
        {{ __('sessions') }}
    </h2>
    <hr>
    <div class="w3-display-topright w3- ">
        @can('subscription.sessions.create')
            <button  class="btn w3-green sb-shadow add_btn" onclick="createSession()" style="width: 180px">
                <i class="fa fa-plus w3-margin-right"></i>
                {{ __('add session') }}
            </button>
        @endcan
    </div>

    <div class="" style="height: 400px;overflow: auto">
        <!-- Main content -->
        <section class="">
 
                <div class="table-responsive light-gray w3-border w3-border-light-gray">


                    <table id="sessiontable" data-title="{{ __('sessions') }}"
                        class="custom-datatable table table-striped table-hover" style="width: 100%">
                        <thead>
                            <tr>
                                <th>@trans( 'name' )</th>
                                <th>@trans( 'class type' )</th>
                                <th>@trans( 'session totals' )</th>
                                <th>@trans( 'trainer' )</th>
                                <th>@trans( 'date_from' )</th>
                                <th>@trans( 'date_to' )</th>
                                <th>@trans( 'group number' )</th>
                                @can_bt(['customer_group'])
                                <th>@trans( 'customer group' )</th>
                                @endcan_bt
                                <th>@trans( 'messages.action' )</th>
                            </tr>
                        </thead>
                    </table>
                </div> 

            <div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            </div>

        </section>
        <!-- /.content -->

    </div>

    @include("subscription::session.form")

</div>
