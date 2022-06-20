@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
@endsection

@section('style')
    <style>
        .select2-container--open{
            z-index:9999999
        }
        .card {

            border: none !important;
            box-shadow: 5px 6px 6px 2px #e9ecef;
            border-radius: 4px;
        }


        .dots{

            height: 4px;
            width: 4px;
            margin-bottom: 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
        }

        .badge{

            padding: 7px;
            padding-right: 9px;
            padding-left: 16px;
            box-shadow: 5px 6px 6px 2px #e9ecef;
        }

        .user-img{

            margin-top: 4px;
        }

        .check-icon{

            font-size: 17px;
            color: #c3bfbf;
            top: 1px;
            position: relative;
            margin-left: 3px;
        }

        .form-check-input{
            margin-top: 6px;
            margin-left: -24px !important;
            cursor: pointer;
        }


        .form-check-input:focus{
            box-shadow: none;
        }


        .icons i{

            margin-left: 8px;
        }
        .reply{

            margin-left: 12px;
        }

        .reply small{

            color: #b7b4b4;

        }


        .reply small:hover{

            color: green;
            cursor: pointer;

        }
    </style>
@endsection


@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item">
        <a href="{{route('tickets.statues')}}">@lang('support.ticket_statues')</a>
    </li>
    <li class="breadcrumb-item active">@lang('support.add_ticket_statuses')</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">

                        </div><!-- /.container-fluid -->
                    </section>
                    <section class="content">
                        <div class="row">
                            <div class="col-md-7 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-12">
                                                <a role="button" href="#reply" class="btn btn-primary btn-sm">Reply</a>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="w3-dropdown-hover">
                                                    <button class="btn btn-primary btn-sm">@lang('support.ticket_statues')</button>
                                                    <div class="w3-dropdown-content w3-bar-block w3-border">
                                                        @foreach($ticketStatuses as $ticketStatus)
                                                            <a href="{{route('tickets.status.change',[$ticket['id'],$ticketStatus->id])}}" class="w3-bar-item w3-button">{{$ticketStatus->name}}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4" style="font-size: 13px; font-weight: bold">
                                                #{{$ticket['description']}}
                                            </div>
                                        </div><hr>

{{--                                        replies --}}


                                        <div class="container mt-5">
                                            <div class="headings d-flex justify-content-between align-items-center mb-3">
                                                <h5>comments(6)</h5>
                                            </div>

                                            @foreach($ticketsReplies as $ticketReply)
                                                <div class="row  d-flex justify-content-center">
                                                    <div class="card p-3 mt-2">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="user d-flex flex-row align-items-center">

                                                                <img src="{{ asset('images/avatar.png') }}" width="30" class="user-img rounded-circle mr-2">
                                                                <span><small class="font-weight-bold text-primary">{{$ticketReply->user->first_name." ".$ticketReply->user->last_name}}</small><small class="font-weight-bold">{{$ticketReply->reply}}</small></span>

                                                            </div>
                                                            <small>{{$ticketReply->created_at->diffForHumans()}}</small>
                                                        </div>

                                                        <div class="action d-flex justify-content-between mt-2 align-items-center">

                                                            <div class="reply px-4">
                                                                <a href="{{route('tickets.reply.delete',$ticketReply->id)}}">
                                                                    <small class="w3-btn w3-border w3-round"><i class="fa fa-trash"></i></small>
                                                                </a>
                                                               <a href="{{route('tickets.reply.edit',$ticketReply->id)}}">
                                                                   <small class="w3-btn w3-border w3-round"><i class="fa fa-edit"></i></small>
                                                               </a>
                                                            </div>

                                                            <div class="icons align-items-center">
                                                                <i class="fa fa-check-circle-o check-icon text-primary"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>


{{--                                        end replies--}}
                                    </div>
                                </div>

                                <div id="reply" class="card card-primary">
                                   <form action="{{route('tickets.reply.store')}}" method="post" enctype="multipart/form-data">
                                     @csrf
                                      <input type="hidden" name="ticket_id" value="{{$ticket['id']}}">
                                       <div class="card-body">
                                           <div class="row">
                                               <div class="form-group mb-3">
                                                   <div class="mb-3">
                                                       <label for="formFile" class="form-label">@lang('support.upload_file')</label>
                                                       <input class="form-control" name="file" type="file" id="formFile">
                                                   </div>
                                               </div>
                                               <div class="form-group mb-3">
                                                   <select class="form-control" id="canned_reply">
                                                       <option disabled selected>@lang('support.canned_reply')</option>
                                                       @foreach($cannedReplies as $canned_reply)
                                                           <option value="{{$canned_reply->message}}">{{$canned_reply->title}}</option>
                                                       @endforeach
                                                   </select>
                                               </div>

                                               <div class="form-group mb-3">
                                                   <label for="color" class="form-label">@lang('support.status_desc')</label>
                                                   <textarea  cols="6" rows="6" id="message" name="reply" required="required" class="form-control">{{old('reply')}}</textarea>
                                                   @if($errors->has('reply'))
                                                       <p class="text text-danger">
                                                           {{$errors->first('reply')}}
                                                       </p>
                                                   @endif
                                               </div>

                                               <div class="form-group mb-3">
                                                   <label for="status" class="form-label">@lang('support.status')</label>
                                                   @foreach($ticketStatuses as $key=>$ticketStatus)
                                                       <div class="form-check">
                                                           <input class="form-check-input" value="{{$ticketStatus->id}}" type="radio" name="status_id" id="flexRadioDefault{{$key}}">
                                                           <label class="form-check-label" for="flexRadioDefault{{$key}}">
                                                               {{$ticketStatus->name}}
                                                           </label>
                                                       </div>
                                                   @endforeach
                                               </div>

                                               <div class="form-group mb-3">
                                                   <button type="submit" class="btn btn-primary btn-sm">@lang('save')</button>
                                               </div>
                                           </div>
                                       </div>
                                   </form>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">

                                <div class="card card-primary">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">@lang('support.customer')</div>
                                            <div class="col-md-6 col-sm-12">
                                                <a role="button" class="btn btn-primary btn-sm">all-tickets</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <div>
                                                    <img class="img-fluid img-sm" style="width: 40px;height: 40px;border-radius: 50%"
                                                         src="{{ asset('images/avatar.png') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-sm-12">{{$ticket['customer_email']}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-primary">
                                    <div class="card-header">
                                        @lang('support.ticket_desc')
                                    </div>
                                    <div class="card-body">
                                        <span class="text-bold">#{{$ticket['id']}}</span>{{" ".$ticket['description']}}
                                    </div>
                                </div>

                                <div class="card card-primary">
                                    <div class="card-header">
                                        @lang('support.ticket_details')
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">@lang('support.department')</div>
                                            <div class="col-md-6 col-sm-6">{{$ticket['department']}}</div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">@lang('support.sub_department')</div>
                                            <div class="col-md-6 col-sm-6">{{$ticket['title']}}</div>
                                        </div>
                                        <hr>

                                        <div class="row bg-gray-active">
                                            <div class="col-md-6 col-sm-6">@lang('support.status')</div>
                                            <div class="col-md-6 col-sm-6">{{$ticket['status']}}</div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">@lang('support.priority')</div>
                                            <div class="col-md-6 col-sm-6"><span class="badge" style="background-color: {{$ticket['priority_color']}}">{{$ticket['priority']}}</span></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">@lang('support.created_at')</div>
                                            <div class="col-md-6 col-sm-6">{{$ticket['created_at']}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">@lang('support.assigned_agent')</div>
                                            <div class="col-md-6 col-sm-12">
                                                <button id="reassign_user" role="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-repeat"></i>@lang('support.re_assign')</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <div>
                                                    <img class="img-fluid img-sm" style="width: 40px;height: 40px;border-radius: 50%"
                                                         src="{{ asset('images/avatar.png') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-sm-12">{{$ticket['customer_email']}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('support.re_assign')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                   <form method="post" action="{{route('tickets.changeTicketUser')}}">
                       @csrf
                       <input type="hidden" name="ticket_id" value="{{$ticket['id']}}">
                       <div class="modal-body">
                           <label for="name" class="form-label">@lang('support.users')</label>
                           <div class="form-group">
                               <select class="form-control select2" name="user_id">
                                   @if(count($users))
                                       @foreach($users as $user)
                                           <option value="{{$user->id}}">{{$user->first_name}}</option>
                                       @endforeach
                                   @else
                                       <option>please select user</option>
                                   @endif

                               </select>
                               @if($errors->has('user_id'))
                                   <p class="text text-danger">
                                       {{$errors->first('user_id')}}
                                   </p>
                               @endif
                           </div>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">@lang('support.save')</button>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        import Init from "../../../../../public/js/init";
        var session_layout = '{{ session()->get('layout') }}';
        export default {
            components: {Init}
        }
    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script>
        $(document).ready(function (){

            $("#canned_reply").change(function () {
                var message =  $(this).val();
                $("#message").val(message);
            });
        });
    </script>
@endsection
