<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>>@trans('view')</title>
    @include("taqneen.layouts.css")


    <style>
        * {
            direction: rtl;
        }
    </style>
</head>
<body>
 
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <div class="card-body">
                        <div class="invoice" id="invoice">
                            <div>
                                <div>
                                    <div class="row">
                                        <div class="col-sm-6 w3-col s6 l6 m6">
                                            <div class="media">
                                                <div class="media-left"><img class="media-object img-60"
                                                        src="{{ asset('assets/images/other-images/logo.png') }}" alt="">
                                                </div>
                                                <div class="media-body m-l-20 text-right">
                                                    <img src="{{ url('/images/logo.png') }}" width="100px" alt="">
                                                    <h4 class="media-heading">الشركة الوطنية </h4>
                                                    <p>hello@elwatnia.in<br><span>286503</span></p>
                                                </div>
                                            </div>
                                            <!-- End Info-->
                                        </div>
                                        <div class="col-sm-6 w3-col s6 l6 m6">
                                            <div class="text-md-end text-xs-center">
                                                <h3>@trans('price show no') <span
                                                        class="counter">{{ $resource->id }}</span>#</h3>
                                                <p>@trans('date') May<span>{{ $resource->transaction_date }}</span><br>
                                                </p>
                                            </div>
                                            <!-- End Title-->
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div>
                                    <div class="table-responsive invoice-table" id="table">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td class="item">
                                                    <h6 class="p-2 mb-0">@trans('service')</h6>
                                                </td>
                                                <td class="item">
                                                    <h6 class="p-2 mb-0">@trans('package')</h6>
                                                </td>
                                                <td class="Hours">
                                                    <h6 class="p-2 mb-0">@trans('number')</h6>
                                                </td>
                                                <td class="Rate">
                                                    <h6 class="p-2 mb-0">@trans('total')</h6>
                                                </td>
                                            </tr>
                                            <tbody>
                                                @foreach ($resource->subscription_lines()->get() as $item)
                                                    <tr>
                                                        <td class="item">
                                                            <h6 class="p-2 mb-0">
                                                                {{ optional($item->service()->first())->name }}</h6>
                                                        </td>
                                                        <td class="item">
                                                            <h6 class="p-2 mb-0">
                                                                {{ optional($item->package()->first())->name }}</h6>
                                                        </td>
                                                        <td class="Hours">
                                                            <h6 class="p-2 mb-0">0</h6>
                                                        </td>
                                                        <td class="Rate">
                                                            <h6 class="p-2 mb-0">{{ $item->total }}</h6>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="w3-large">
                                            <b>@trans('total before tax')</b> :
                                            {{ $resource->final_total - $resource->tax_amount }}
                                        </div>
                                        <div class="w3-large">
                                            <b>@trans('tax amount')</b> : {{ $resource->tax_amount }}
                                        </div>
                                        <div class="w3-large">
                                            <b>@trans('expenses amount')</b> : {{ $resource->custom_field_2 }}
                                        </div>
                                        <div class="w3-large">
                                            <b>@trans('final total')</b> : {{ $resource->final_total }}
                                        </div>
                                    </div>
                                    <!-- End Table-->
                                    <div class="row mb-0 pb-0">
                                        <div class="col-md-8">
                                            <div>
                                                <p class="legal"><strong>شكرا لحسن تعاونكم معنا</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 text-center mt-0 "> 
                                        </div>
                                    </div>
                                </div>
                                <!-- End InvoiceBot-->
                            </div>

                            <!-- End Invoice-->
                            <!-- End Invoice Holder-->
                            <!-- Container-fluid Ends-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>

@include("taqneen.layouts.script")

<script>
    $(document).ready(function(){
        window.print();
    });
</script>
</html>
 