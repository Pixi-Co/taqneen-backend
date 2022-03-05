
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
                                    @trans("expired subscriptions")
                                </h3>
                            </div>
                            <hr>
                             
                            
                            @can('subscription.class_types.view')
                            @foreach(Modules\Subscription\Entities\ClassType::active() as $item)
                                @if(isset($trainer))
                                    @if ($trainer->class_type_id == $item->id)
                                    <div class="">
                                        <div class="form-group">
                                            <label>
                                                {!! Form::checkbox('events', $item->id, true, 
                                                [ 'class' => 'input-icheck event_check', 'data-id' => $item->id]); !!} <span class="label w3-round" style="background-color: {{ $item->color }}" >{{ $item->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                @else
                                <div class="">
                                    <div class="form-group">
                                        <label>
                                            {!! Form::checkbox('events', $item->id, true, 
                                            [ 'class' => 'input-icheck event_check', 'data-id' => $item->id]); !!} <span class="label w3-round" style="background-color: {{ $item->color }}" >{{ $item->name }}</span>
                                        </label>
                                    </div>
                                </div>
                                @endif
                            @endforeach 
                            @endcan
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="calendarSub"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
