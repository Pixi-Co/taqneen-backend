<div class="modal fade copy-trans-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form class="form" action="/translations/copy" method="post">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@trans("copy translation")</h4>
                </div>
                <div class="modal-body">
                    <div class="modal-body">


                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('from language') }} </b>
                            </div>
                            <div class="col-md-9">
                                <select name="language_from" required class="form-control w3-block w3-light-gray">
                                    <option value=""></option>
                                    @foreach (App\Language::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('from business type') }} </b>
                            </div>
                            <div class="col-md-9">
                                <select name="business_type_from" required class="form-control w3-block w3-light-gray">
                                    <option value=""></option>
                                    @foreach (App\BusinessType::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('to language') }} </b>
                            </div>
                            <div class="col-md-9">
                                <select name="language_to" required class="form-control w3-block w3-light-gray">
                                    <option value=""></option>
                                    @foreach (App\Language::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-3">
                                <b> {{ __('to business type') }} </b>
                            </div>
                            <div class="col-md-9">
                                <select name="business_type_to" required class="form-control w3-block w3-light-gray">
                                    <option value=""></option>
                                    @foreach (App\BusinessType::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@trans('Close')</button>
                    <button type="submit" class="btn btn-primary">@trans('copy')</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
