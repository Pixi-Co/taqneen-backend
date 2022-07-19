<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"/>

<style>
    .link-grey { color: #aaa; } .link-grey:hover { color: #00913b; }
</style>
<div class="card">
    <div class="card-body">
        <div class="row mt-5">
            <div class="col-md-3">
                <p class="pull-right">الحالة</p>
                <p class="pull-right" style="padding-right: 40px;">{{$ticket->status->name}}</p>
            </div>
            <div class="col-md-4">
                <p class="pull-right">النوع</p>
                <p class="pull-right" style="padding-right: 40px;">{{$ticket->department->name}}</p>
            </div>
            <div class="col-md-4">
                <p class="pull-right">التاريخ</p>
                <p class="pull-right" style="padding-right: 40px;">{{$ticket->created_at->format('Y-m-d h:i:s a')}}</p>
            </div>
        </div>
        <hr>
        <section style="background-color: #f7f6f6;">
            <div class="container py-5 text-dark">
                <div class="row d-flex justify-content-end">
                    <div class="col-md-10 col-lg-10 col-xl-10">
                        @if(count($ticketsReplies))
                            @foreach($ticketsReplies as $ticketReply)

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex flex-start">
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <p class="mb-0">{{$ticketReply->created_at->diffForHumans()}}</p>
                                                    <h6 class="text-primary fw-bold mb-0">
                                                        <span class="text-dark ms-2">{{$ticketReply->reply}}</span>
                                                        {{isset($ticketReply->user)?$ticketReply->user->full_name:$ticketReply->ticket->client_name??$ticketReply->ticket->agent->full_name}} <img class="rounded-circle shadow-1-strong" style="margin-left: 8px"
                                                                          src="{{url('/images/reply_avatar.png')}}" alt="avatar" width="40"
                                                                          height="40" />
                                                    </h6>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
{{--                                                    <p class="small mb-0" style="color: #aaa;">--}}
{{--                                                        <a href="#!" class="link-grey">Remove</a> •--}}
{{--                                                        <a href="#!" class="link-grey">Reply</a> •--}}
{{--                                                        <a href="#!" class="link-grey">Translate</a>--}}
{{--                                                    </p>--}}

                                                    @if(isset($ticketReply->file))
                                                        <div class="d-flex flex-row">
                                                            <a role="button" class="btn btn-sm" href="{{route('tickets.reply.download.files',$ticketReply->id)}}"><i class="fa fa-download text-info"></i><small> @trans('download')</small></a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h6 class="alert alert-danger">@trans('support.no_replies')</h6>
                        @endif
                        <br>
                        <hr>
                            @if(session('status'))
                                <h6 class="alert alert-info">{{session('status')}}</h6>
                            @endif
                        <hr>

                        <form action="{{route('tickets.guest.reply',$ticket['id'])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <textarea name="reply" class="form-control form-control-rounded" id="review_text" rows="8" placeholder="Write your message here..." required=""></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label pull-right">@trans('support.upload_file')</label>
                                        <input class="form-control" name="files[]" type="file" id="formFile" multiple>
                                    </div>
                                </div>
                                <div class="text-right mb-3 pull-right">
                                    <button class="btn btn-outline-primary" type="submit">@trans('support.send')</button>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
