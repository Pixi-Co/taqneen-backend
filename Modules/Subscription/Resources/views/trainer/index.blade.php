<div class="w3-block w3-display-container">
    <h2>
        {{ __('trainers') }}
    </h2>
    <hr>
    <div class="w3-display-topright w3- ">
        @can('subscription.trainers.create')
            <button  class="btn w3-green sb-shadow add_btn" onclick="createTrainer()" style="width: 180px">
                <i class="fa fa-plus w3-margin-right"></i>
                {{ __('add trainer') }}
            </button>
        @endcan
    </div>

    <div class="" style="height: 400px;overflow: auto">
        <!-- Main content -->
        <section class="content new-content">

            @can('user.view')
                <div class="table-responsive light-gray w3-border w3-border-light-gray">


                    <table id="trainertable" data-title="{{ __('trainers') }}"
                        class="custom-datatable table table-striped table-hover" style="width: 100%">
                        <thead>
                            <tr>
                                <th>@trans( 'user.name' )</th>
                                <th>@trans( 'class type' )</th>
                                <th>@trans( 'username' )</th>
                                <th>@trans( 'email' )</th>
                                <th>@trans( 'rate' )</th>
                                <th>@trans( 'messages.action' )</th>
                                <th>@trans( 'contacts' )</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcan

            <div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            </div>

        </section>
        <!-- /.content -->

    </div>

    @include("subscription::trainer.form")
    @include("subscription::trainer.rate_link")

</div>
