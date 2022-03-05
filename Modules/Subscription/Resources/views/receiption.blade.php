@extends("layouts.app")

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="w3-padding" id="app-sub" >

        <section class=" w3-padding">
             
            <div class="w3-round w3-padding">

                <ul class="nav nav-pills mb-3 setting-tabs w3-padding" id="pills-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#tab_1" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @trans("calendar") <i class="fa fa-calendar"></i>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#tab_2" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @trans("scan qrcodes") <i class="fa fa-barcode"></i>
                        </a>
                    </li> 
                </ul>

                <div class="tab-content">
                    
                    <div class="tab-pane fade show active in" id="tab_1" role="tabpanel" aria-labelledby="pills-profile-tab">
                         @include("subscription::calendar.index")
                    </div>
                     
                    <div class="tab-pane fade " id="tab_2" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="w3-white w3-round-xlarge sb-shadow w3-padding">
                                    <img src="{{ url('/images/avatar.png') }}" class="w3-circle" style="width: 100px;height: 100px;" alt="">
                                    <br>
                                    <ul class="w3-ul">
                                        <li>
                                            <i class="fa fa-user"></i> <span id="memberName" ></span>
                                        </li>
                                        <li>
                                            <i class="fa fa-clock"></i> <span id="clock" ></span>
                                        </li>
                                    </ul> 
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="w3-white w3-round-xlarge sb-shadow table-responsive">
                                    <br>
                                    <br>
                                    @include("subscription::qrcode.scan")
                                    <br>
                                </div>
                            </div>
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

        function checkIn() {
            var member = $('#member_id').val();
            var session = $('#session_id').val();

            if ($("#session_id option").length > 2) {
                $('.checkin-modal').modal('show');
            } else {
                session = $($("#session_id option")[1]).attr('value');
                submitCheckIn(member, session);
            }
        }

        function submitCheckIn(member_id, session_id) {
            var data = {
                session_id: session_id,
                _token: '{{ csrf_token() }}'
            };
            $.post("{{ url('/sub/member/check-in') }}/" + member_id + "?", function(r) {
                if (r.status == 1) {
                    toastr.success(r.message);
                } else {
                    toastr.error(r.message);
                }
            });
        }

        function scanAction(decodedText, decodedResult) {

            //alert(decodedResult);
            //alert(decodedText);

            var data = {
                _token: '{{ csrf_token() }}'
            };

            try {
                $.post(decodedText, $.param(data), function(res){
                    //alert(JSON.stringify(res));
                    if (res.status == 1) {
                        toastr.success(res.message);
                        if (res.data) {
                            if (res.data.member)
                                $('#memberName').html(res.data.member.name); 
                            $('#clock').html(res.data.time); 
                        }
                    } else {
                        toastr.error(res.message);
                        if (res.data) {
                            if (res.data.member)
                                $('#memberName').html(res.data.member.name); 
                            $('#clock').html(res.data.time); 
                        }
                    }
                });
            }catch(e){
                //alert(JSON.stringify(e));
            }
        }
        
        var app = new Vue({
            el: '#app-sub',
            data: {
                class_types: [],
                members: [],
                class_type_resource: {},
                member_resource: {},
                trainer_resource: {},
                session_resource: {},
            }
        });
    </script>
    @include('subscription::session.scripts') 
    @include('subscription::calendar.scripts') 
    @include("subscription::qrcode.scripts")
@endsection
