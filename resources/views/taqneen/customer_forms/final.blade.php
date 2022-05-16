@extends('taqneen.layouts.master')

@section('content')
    <div class="w3-block card">
        <br>
        <style>
            * {
                font-family: 'Tajawal', sans-serif;
                direction: rtl;
            }

            .gfield_checkbox {
                display: grid;
                -ms-grid-columns: (1fr) [ 3];
                grid-template-columns: repeat(5, 1fr);
                grid-column-gap: 32px;
            }

            input[type='text'],
            input[type="text"]:focus {
                border-color: #ebebeb;
                background-color: #f8f8f8;
                color: #969696;
            }

            input[type="text"]:focus {
                box-shadow: 0px 0px 2px 0px rgb(0 0 0 / 20%);
            }

            label {
                font-weight: bold;
                font-size: 0.92em;
            }

            .gform_wrapper.gravity-theme .ginput_container_date {
                display: flex;
                align-items: center;
                align-content: flex-start;
            }

            html[dir=rtl] .gform_wrapper.gravity-theme .ginput_container_date img.ui-datepicker-trigger {
                margin-right: 12.8px px;
                margin-left: 0;
                order: 1;
            }

            input[type=submit] {
                color: #FFFFFF;
                background: #d45b24;
                font-size: 19px;
                letter-spacing: 1px;
                text-transform: uppercase;
                float: right;
                height: 50px;
                border: none;
                border-radius: 5px;
                margin-left: 12px;
                transition: 0.3s;
            }

            input[type=submit]:hover {
                background: #134474;
                color: #FFFFFF
            }

            .subscribe-model {
                background: #fff;
            }

            checkbox,
            input[type=checkbox] {
                width: 24px;
                height: 24px;
                position: relative;
                top: 6px;
            }

        </style>
        <div class="container" id="form">
            <div class="modal-dialog" style="margin: auto">
                <div class="modal-content  w3-center text-center">
                    <div class="modal-title">

                    </div>

                    <div class="w3-gray w3-padding btn" style="width: 100px;border-radius: 5em;margin: auto" >
                       <i class="fa fa-cloud-download"></i> {{ __('download_pdf') }}
                    </div>
                    <br>
                    <br>


                    <div class="modal-body">
                        <form method="post" class="form" action="/customer-form-upload" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{ $resource->id }}">
                                @csrf
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="labels">@trans('upload_pdf')</label>
                                        <input type="file" name="file" class="form-control" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">@trans('submit')</button>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <br>

    </div>
@endsection

@section('script')
    <script>
        $('input').each(function() {
            if ($(this).attr('maxlength') > 0) {
                $(this).attr("pattern", "[0-9]+");
                //$(this).attr("data-toggle", "tooltip");
                //$(this).attr("title", "{{ __('only_numbers_available') }}");
                $(this).on('input', function(e) {
                    $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
            }
        });

        var resource = <?php echo json_encode($resource); ?>;
        $(".related").each(function() {
            var self = this;
            var related = $(self).attr('data-related');
            $("." + related).val(self.value);

            $(this).change(function() {
                $("." + related).val(self.value);
            });
            $(this).keyup(function() {
                $("." + related).val(self.value);
            });
        });

        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }


        
        $(document).ready(function(){
            formAjax(false, function(res){
                if (res.status == 1)
                    window.location.reload();
            });
        });
    </script>
@endsection
