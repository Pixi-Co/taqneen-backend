@extends('taqneen.layouts.master')


@php
    if (request()->test != 1)
        exit();
@endphp

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
            <div class="card">
				<div class="card-header">
					<h5>{{ __('steps_of_customer_form_header') }}</h5>
				</div>
                <form method="post" class="form" action="/customer-form-upload" enctype="multipart/form-data">
                   
                    <input type="hidden" name="id" value="{{ $resource->id }}">
                    @csrf    
				<div class="card-body"> 
						<input type="hidden" name="_token" value="NGLaspTwL2Yg9JSoCchsb4S35JjP20yjeV43RGRR" data-bs-original-title="" title="">						<div class="f1-steps">
							<div class="f1-progress">
								<div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
							</div>
							<div class="f1-step active">
								<div class="f1-step-icon">
                                    <b>1</b>
                                </div>
								<p>{{ __('customer_form_step1') }}</p>
							</div>
							<div class="f1-step">
								<div class="f1-step-icon">
                                    <b>2</b>
                                </div>
								<p>{{ __('customer_form_step2') }}</p>
							</div>
							<div class="f1-step">
								<div class="f1-step-icon">
                                    <b>3</b>
                                </div>
								<p>{{ __('customer_form_step3') }}</p>
							</div>
						</div>
						<fieldset class="form-step form-step1" style="display: block;">
							<div class="w3-center w3-large">
                                {{ __('please_download_pdf_file_and_fill_it') }}
							</div> 
							<div class="f1-buttons">
								<button class="btn btn-primary btn-next" onclick="gotoStep(2)" type="button" data-bs-original-title="" title="">{{ __("next") }}</button>
							</div>
						</fieldset>
						<fieldset class="form-step form-step2" style="display: none;">
							<div class="w3-block w3-center"> 
                                <a href="{{ url('/customer-pdf-download') }}/{{ $resource->id }}">
                                    <div class="btn-primary w3-padding btn" style="width: 200px;border-radius: 5em;margin: auto" >
                                        <i class="fa fa-cloud-download"></i> {{ __('download_pdf') }}
                                     </div>
                                </a>
							</div> 
							<div class="f1-buttons">
								<button class="btn btn-primary btn-previous" type="button" onclick="gotoStep(1)" data-bs-original-title="" title="">{{ __("back") }}</button>
								<button class="btn btn-primary btn-next" onclick="gotoStep(3)" type="button" data-bs-original-title="" title="">{{ __("next") }}</button>
							</div>
						</fieldset>
						<fieldset class="form-step form-step3" style="display: none;">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">@trans('upload_pdf')</label>
                                    <input type="file" name="file" class="form-control" id="">
                                </div>
                            </div>
							<div class="f1-buttons">
								<button class="btn btn-primary btn-previous" onclick="gotoStep(2)" type="button" data-bs-original-title="" title="">{{ __("back") }}</button>
								<button class="btn btn-primary btn-submit" type="submit" data-bs-original-title="" title="">{{ __("submit") }}</button>
							</div>
						</fieldset>
					</form>
				</div>
            </form>
			</div> 
        </div>
        <br>

    </div>
@endsection

@section('script')
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/style.css">
<script src="{{ url('/') }}/assets/js/form-wizard/form-wizard-three.js"></script>
<script src="{{ url('/') }}/assets/js/form-wizard/jquery.backstretch.min.js"></script>
    <script>
        function gotoStep(step) {
            $('.form-step').hide();
            $('.form-step' + step).show();
        }

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
