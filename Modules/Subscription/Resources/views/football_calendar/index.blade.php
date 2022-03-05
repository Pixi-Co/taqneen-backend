<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-3">
            <div class="box box-solid">
                <div class="box-body w3-padding">
                    <div class="w3-padding">
                        <div class="">
                            <div class="w3-padding w3-center">
                                <img src="{{ url('/images/sub/calendar.png') }}" style="width: 100px" alt="">
                                <h3>
                                    @trans("football orders")
                                </h3>
                            </div>
                            <hr>

                        </div>
                        @can('subscription.football_orders.create')
                            <button class="btn w3-green sb-shadow add_btn w3-block" href="#" onclick="createFootballOrder()"
                                data-container="#task_modal">
                                <i class="fa fa-plus"></i> @trans( 'add football order' )</a>
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="footballcalendarSub"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
