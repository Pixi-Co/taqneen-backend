@extends("sale_pos.receipts.main")

@section('content')
<div class="w3-block" style="padding: 6px;border: 2px dashed gray" >
    
    <table class="w3-table">
        <tr> 
            <td>
                <div class="w3-row">
                    <div class="w3-col  l4 m4 s4" style="width: 33.33%!important">
                        <div class="w3-row">
                            <div class="w3-col w3-border w3-border-gray w3-round" style="height: 35px;width: 50px;margin: 5px;height: 10">
        
                            </div>
                            <div class="w3-col w3-border w3-border-gray w3-round" style="height: 35px;width: 100px;margin: 5px;height: 10">
        
                            </div>
                        </div>
                    </div>
                    <div class="w3-col  l4 m4 s4" style="width: 33.33%!important">
                        <div class="w3-center w3-large">
                            <b>
                                @if ($resource->contact_type == 'customer')
                                    @trans('catch receipt')
                                @else
                                    @trans('receipt')
                                @endif
                            </b>
                        </div>
                    </div>
                    <div class="w3-col  l4 m4 s4" style="width: 33.33%!important" >
                        
                    </div>
                </div>
            </td> 
        </tr>
        <tr>
            <td class="text-left w3-row" > 
                <div class="w3-col " style="width: auto" >
                    <b>@trans('date') : </b> 
                </div>
                <div class="w3-col l9 m9 s9" style="border-bottom: 1px dashed gray">
                    {{ $resource->paid_on }}
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-left w3-row" > 
                <div class="w3-col " style="width: auto" >
                    <b>@trans('receipt_to') : </b>
                </div>
                <div class="w3-col l9 m9 s9" style="border-bottom: 1px dashed gray">
                    {{ $resource->contact_name }}
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-left w3-row" > 
                <div class="w3-col " style="width: auto" >
                    <b>@trans('receipt_value') : </b>
                </div>
                <div class="w3-col l9 m9 s9" style="border-bottom: 1px dashed gray">
                    {{ $resource->amount }}
                </div>
            </td>
        </tr>  
        <tr>
            <td class="text-left w3-row" > 
                <div class="w3-col " style="width: auto" >
                    <b>@trans('receipt_check') : </b>
                </div>
                <div class="w3-col l9 m9 s9" style="border-bottom: 1px dashed gray">
                    {{ $resource->payment_ref_no }}
                </div>
            </td>
        </tr>   
        <tr>
            <td class="text-left w3-row" > 
                <div class="w3-col " style="width: auto" >
                    <b>@trans('receipt_for') : </b>
                </div>
                <div class="w3-col l9 m9 s9" style="border-bottom: 1px dashed gray">
                    {{ $resource->note?? '--' }}
                </div>
            </td>
        </tr>    
        <tr>
            <td>
                <div class="w3-row w3-block w3-center">
                    <div class="w3-col l4 m4 s4 w3-padding">
                        <b>@trans("receipt_receiver")</b>
                        <br>
                        <br>
                        <div class="w3-block" style="border-bottom: 1px dashed gray" ></div>
                    </div>
                    <div class="w3-col l4 m4 s4 w3-padding">
                        <b>@trans("receipt_accountant")</b>
                        <br>
                        <br>
                        <div class="w3-block" style="border-bottom: 1px dashed gray" ></div>
                    </div>
                    <div class="w3-col l4 m4 s4 w3-padding">
                        <b>@trans("receipt_manager")</b>
                        <br>
                        <br>
                        <div class="w3-block" style="border-bottom: 1px dashed gray" ></div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>

@endsection
