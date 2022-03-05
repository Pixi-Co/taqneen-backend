<div class="sb-shadow w3-white sb-shadow w3-round"  >
    <table class="table table-bordered text-center" >
        <tr>
            <td></td>
            <td class="w3-green" ><b>@trans("from")</b></td>
            <td class="w3-green" ><b>@trans("to")</b></td>
        </tr> 
        @foreach (Subscription::$helper::$days as $key => $value)
        <tr>
            <td class="w3-green" >@trans($key)</td>
            <td>
                <span v-html="session_resource.{{ $key }}_from" ></span>
            </td>
            <td>
                <span v-html="session_resource.{{ $key }}_to" ></span>
            </td>
        </tr>     
        @endforeach
    </table>
</div>
