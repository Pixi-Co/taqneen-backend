@php
  $productStockNotfs = [];
@endphp

@foreach($products as $item)
<li class="notification-li">
  <a href="{{ url('/home?tab=product_alert') }}"   >
  
  <i 
  class="notif-icon " 
  style="width: 40px;height: 40px;border: 1px solid #41BC85;background-size: cover;background-image: url({{ optional(App\Product::find($item->product_id))->image_url }})" ></i> 

    @php
    $msg = __('lang_v1.msg_of_product_alert_notification');
    $name = "";
    $location = $item->location; 
    $stock = $item->stock ? $item->stock : 0 ;
    $stock = ' ' . (float)$stock . ' ' . $item->unit;
    if ($item->type == 'single') {
        $name = $item->product;
    } else {
      $name = $item->product . ' - ' . $item->product_variation . ' - ' . $item->variation;
    }

    $msg = str_replace("{product}", $name, $msg);
    $msg = str_replace("{location}", $location, $msg);
    $msg = str_replace("{stock}", $stock, $msg);
    //$msg = str_replace("{product}", $name);

 
    @endphp
    <span class="notif-info">{!! $msg !!}</span>
    <span class="time">{{ \Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::parse($item->updated_at)) }}</span> 
  </a>
</li>
@endforeach


@foreach($stockAlerts as $item)
<li class="notification-li">
  <a href="{{ url('/home?tab=stock_alert') }}"   >
  
  <i 
  class="notif-icon " 
  style="width: 40px;height: 40px;border: 1px solid #41BC85;background-size: cover;background-image: url({{ optional(App\Product::find($item->product_id))->image_url }})" ></i> 

    @php
    $msg = __('lang_v1.msg_of_stock_alert_notification');
    $name = $item->product;
    $location = $item->location; 
    $expire = $item->exp_date; 
    $stock = $item->stock_left ? $item->stock_left : 0 ;
    $stock = ' ' . (float)$stock . ' ' . $item->unit;
    

    $msg = str_replace("{product}", $name, $msg);
    $msg = str_replace("{location}", $location, $msg);
    $msg = str_replace("{stock}", $stock, $msg);
    $msg = str_replace("{expire}", $expire, $msg); 

 
    @endphp
    <span class="notif-info">{!! $msg !!}</span>
    <span class="time">{{ \Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::parse($item->updated_at)) }}</span> 
  </a>
</li>
@endforeach

@if(!empty($notifications_data))
  @foreach($notifications_data as $notification_data)
    <li class="@if(empty($notification_data['read_at'])) unread @endif notification-li">
      <a href="{{$notification_data['link'] ?? '#'}}" 
      @if(isset($notification_data['show_popup'])) class="show-notification-in-popup" @endif >
      <!--
        old icon
        {{$notification_data['icon_class'] ?? ''}}
        --->  
      <i class="notif-icon fa fa-bell w3-text-white" style="width: 40px;height: 40px;" ></i> 

        <span class="notif-info">{!! $notification_data['msg'] ?? '' !!}</span>
        <span class="time">{{$notification_data['created_at']}}</span> 
      </a>
    </li>
  @endforeach
@endif
@if(empty($notifications_data) && empty($productStockNotfs) && empty($stockAlerts))
  <li class="text-center no-notification notification-li">
    @trans('lang_v1.no_notifications_found')
  </li>
@endif
