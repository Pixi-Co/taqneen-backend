<div class="w3-block w3-display-container">
    <h2>
        {{ __('rates') }}
    </h2>
    <hr>
    <div class="w3-display-topright w3- ">
        @can('subscription.rates.create')
        <button class="btn w3-green sb-shadow add_btn" onclick="createRate()" style="width: 180px">
            <i class="fa fa-plus w3-margin-right"></i>
            {{ __('add rate') }}
        </button>
        @endcan
    </div>

    <div class="" style="height: 400px;overflow: auto">
        <!-- Main content -->
        <section class="">
            <b>@trans('multi rate page link')</b>
            <input type="text" readonly class="form-control" value="{{ url('/multi-rate') }}" >
            <div class="table-responsive light-gray w3-border w3-border-light-gray"> 
                <table id="ratetable" data-title="{{ __('rates') }}"
                    class="custom-datatable table table-striped table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th>@trans( 'name' )</th>
                            <th>@trans( 'description' )</th>
                            <th>@trans( 'active' )</th>
                            <th>@trans( 'rate' )</th>
                            <th>@trans( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </section>

    </div>

    @include("subscription::rate.form")
    @include("subscription::rate.show")

</div>
