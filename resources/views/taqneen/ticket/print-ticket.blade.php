
<style>
    body{
        direction: rtl;
    }
    .card {
        margin-bottom: 1.5rem;
    }

    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #c8ced3;
        border-radius: .25rem;
    }

    .card-header:first-child {
        border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
    }

    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: #f0f3f5;
        border-bottom: 1px solid #c8ced3;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">

<div class="container-fluid">
    <div id="ui-view" data-select2-id="ui-view">
        <div>
            <div class="d-flex justify-content-center bg-danger" >
                <img class="pn" style="width: 100%;margin-bottom: 0px;" src="{{ url('/images/header.jpg') }}" alt="">
            </div>
            <div class="card">
                <div class="card-header">
                    <div style="float: right">
                        @lang('support.ticket_num')
                        <strong>#{{$ticket['id']." | ".$ticket['description']}}</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6 col-sm-6">
                           <div class="row">
                               <div class="col-md-3 col-sm-3">@lang('support.department')</div>
                               <div class="col-md-4 col-sm-4">{{$ticket['department']}}</div>
                           </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-3">@lang('support.sub_department')</div>
                                <div class="col-md-4 col-sm-4">{{$ticket['title']}}</div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-3">@lang('support.status')</div>
                                <div class="col-md-4 col-sm-4">{{$ticket['status']}}</div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-3">@lang('support.priority')</div>
                                <div class="col-md-4 col-sm-4"><span class="badge" style="background-color: {{$ticket['priority_color']}}">{{$ticket['priority']}}</span></div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-3">@lang('support.created_at')</div>
                                <div class="col-md-4 col-sm-4">{{$ticket['created_at']}}</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <table class="table table-striped">
                                <tr>
                                    <td>@lang('support.customer')</td>
                                    <td>{{$ticket['customer']}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('support.computer_num')</td>
                                    <td>{{$ticket['computer_num']??"لا يوجد"}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('support.customer_email')</td>
                                    <td>{{$ticket['customer_email']}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('support.user')</td>
                                    <td>{{$ticket['user']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="center">@lang('support.name')</th>
                                <th>@lang('support.reply')</th>
                                <th>@lang('support.date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ticketsReplies as $ticketReply)
                                <tr>
                                    <td><strong>{{$ticketReply->user->full_name}}</strong></td>
                                    <td><small>{{$ticketReply->reply}}</small></td>
                                    <td><small>{{$ticketReply->created_at}}</small></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
       window.print();
    });
</script>
