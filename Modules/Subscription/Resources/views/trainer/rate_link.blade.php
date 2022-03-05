<div class="modal fade rate-link-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-capitalize">@trans('trainer rate link')</h4>
            </div>
            <div class="modal-body">
                <label for="">
                    @trans('link')
                </label>
                <input type="text" class="form-control" id="trainerLink" readonly data-url="{{ url('/sub/rate-trainer/') }}/">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@trans('Close')</button>
            </div>
        </div>
    </div>
</div>
