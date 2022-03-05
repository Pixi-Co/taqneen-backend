@extends("layouts.app")

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="w3-padding" id="app-sub" >

        <section class=" profile_content w3-padding">
            <div class="profile_first_row row d-flex w3-white">
                <div class="profile_first_row_col col-md-4 col-12 d-flex">
                    <!-- <div class="col-md-2"> -->
                    <div class="profile_img">
                        <img src="{{ url('/images/sub/trainer.png') }}" alt="">
                    </div>
                    <!-- </div> -->
                    <div class="profile_title">
                        <h2>{{ $trainer->full_name }}</h2>
                        <p>
                            @for($index = 0; $index < 5; $index ++)
                                @if ($index < $trainer->rate)
                                <span class="fa fa-star w3-text-orange"></span>
                                @else
                                <span class="fa fa-star w3-text-gray"></span>
                                @endif
                            @endfor
                        </p>
                        <h4>{{ $trainer->class_type_names }}</h4>
                        <h4 class="hidden" >
                            <button class="btn w3-green sb-shadow" onclick="checkIn('{{ $trainer->id }}')">@trans("check in")</button>
                        </h4>
                    </div>
                </div>
                <div class="profile_first_row_col col-md-4 col-12 profile_Contact ">
                    <h5>@trans("personal info")</h5>
                    <p><i class="circle-avatar w3-text-white w3-large margin-r-5 fas fa-envelope"> </i> {{ $trainer->email }}</p>
                    <p><i class="circle-avatar w3-text-white w3-large margin-r-5 fa fa-user"></i> {{ $trainer->username }}</p>
                    <p><i class="circle-avatar w3-text-white w3-large margin-r-5 fa fa-map-marker"></i> {{ $trainer->address }}</p>
                    <p><i class="circle-avatar w3-text-white w3-large margin-r-5 fa fa-star"></i> {{ number_format($trainer->rate, 1) }}</p>
                </div>
                <div class="profile_first_row_col col-md-4 col-12 ">
                    <div class="qrcode" data-text="{{ $trainer->rate_link }}" data-width="100" data-height="100" ></div>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h3>{{ $trainer->sessions()->count() }}</h3>
                            <span>@trans("sessions")</span>
                        </div>
                        <div class="col-md-4">
                            <h3>{{ $trainer->rates()->count() }}</h3>
                            <span>@trans("rates")</span>
                        </div>
                        <div class="col-md-4">
                            <h3>{{ $trainer->attandances()->count() }}</h3>
                            <span>@trans("attandances")</span>
                        </div>
                    </div>
                </div>

            </div>
            <br>
            <div class="w3-round w3-white row sb-shadow w3-padding">

                <ul class="nav nav-pills mb-3 setting-tabs w3-padding" id="pills-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#tab_1" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @trans("sessions")
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#tab_4" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @trans("calendar")
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#tab_2" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @trans("rates")
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#tab_5" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @trans("members")
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    
                    <div class="tab-pane fade show active in" id="tab_1" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive w3-light-gray">
                            <table data-title="@trans('sessions')" class="datatable table table-bordered table-striped" >
                                <thead>
                                    <th>@trans('name')</th>
                                    <th>@trans('class type')</th>
                                </thead>
                                <tbody>
                                    @foreach($trainer->sessions()->get() as $item)
                                        <tr>
                                            <td>
                                                <a href="#" onclick="showSession('{{ $item->id }}')" >{{ $item->name }}</a>
                                            </td>
                                            <td>
                                                {{ optional($item->classType)->name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive">
                            @include("subscription::calendar.index", ["trainer" => $trainer])
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="tab_5" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive">
                            <table data-title="@trans('members')" class="datatable table table-bordered table-striped" >
                                <thead>
                                    <th>#</th>
                                    <th>@trans('name')</th>
                                    <th>@trans('phone')</th>
                                    <th>@trans('email')</th> 
                                    <th>@trans('session')</th> 
                                </thead>
                                <tbody>
                                    @foreach($trainer->members()->get() as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }} <img class="w3-circle" style="width: 30px;height: 30px;" src="{{ url('/images/avatar.png') }}" alt="">
                                            </td>
                                            <td>
                                                <a href="{{ url('/sub/member/show/') }}/{{ $item->id }}">
                                                    {{ $item->name }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $item->mobile }}
                                            </td>
                                            <td>
                                                {{ $item->email }}  
                                            </td>
                                            <td>
                                                <a href="#" onclick="showSession('{{ $item->session_id }}')" >{{ $item->session_name }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade " id="tab_2" role="tabpanel" aria-labelledby="pills-profile-tab">
                        
                        <div class="w3-round-xlarge w3-light-gray text-center sb-shadow">
                            <br>
                            <div 
                            class="qrcode" 
                            style="width: 200px;margin: auto"
                            data-text="{{ $trainer->rate_link }}" data-height="150" data-width="150" ></div>
                            <h3 class="text-capitalize w3-text-dark-gray text-center" >@trans("rate qrcode")</h3>
                            <br>
                        </div>
                        <br>
                        
                        <div class="table-responsive w3-light-gray">
                            <table data-title="@trans('rates')" class="datatable table table-bordered table-striped" >
                                <thead>
                                    <th>#</th>
                                    <th>@trans('ip')</th>
                                    <th>@trans('date')</th>
                                    <th>@trans('time')</th>
                                    <th>@trans('comment')</th>
                                    <th>@trans('user')</th>
                                    <th>@trans('rate')</th>
                                </thead>
                                <tbody>
                                    @foreach($trainer->rates()->get() as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->ip }}
                                            </td>
                                            <td>
                                                {{ $item->date }}
                                            </td>
                                            <td>
                                                {{ date('H:i:s', strtotime($item->created_at)) }}
                                            </td>
                                            <td>
                                                {{ $item->comment }}
                                            </td>
                                            <td>
                                                {{ $item->user }}
                                            </td>
                                            <td>
                                                {{ $item->rate }} <i class="fa fa-star w3-text-green"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab__" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive w3-light-gray">
                            <table data-title="@trans('attandances')" class="datatable table table-bordered table-striped" >
                                <thead>
                                    <th>#</th>
                                    <th>@trans('session')</th>
                                    <th>@trans('date')</th>
                                    <th>@trans('time')</th>
                                </thead>
                                <tbody>
                                    @foreach($trainer->attandances()->get() as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <a href="#" onclick="showSession('{{ $item->session_id }}')" >{{ optional($item->session)->name }}</a>
                                            </td>
                                            <td>
                                                {{ $item->date }}
                                            </td>
                                            <td>
                                                {{ date('H:i:s', strtotime($item->created_at)) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                

            </div>



        </section>
 


        @include('subscription::session.show')


    </div>

@endsection

@section('javascript')
    <script>
        $('.datatable').DataTable({
            @include("layouts.partials.datatable_plugin")
        }); 

        setTimeout(function(){ 
            reload_calendar();
        }, 2000);
 
        
        var app = new Vue({
            el: '#app-sub',
            data: {
                class_types: [],
                trainers: [],
                class_type_resource: {},
                trainer_resource: {},
                trainer_resource: {},
                session_resource: {},
            }
        });
    </script>
    @include('subscription::session.scripts') 
    @include("subscription::calendar.scripts")
@endsection
