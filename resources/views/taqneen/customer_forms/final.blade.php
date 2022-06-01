@extends('taqneen.layouts.master')


@php
if (request()->test != 1) {
    exit();
}
@endphp

@section("css")

@include('taqneen.customer_forms.final_css')
@endsection

@section('content')
    <div class="w3-block  ">
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
				<div class="card-body">
					<div class="stepwizard">
						<div class="stepwizard-row setup-panel">
							<div class="stepwizard-step">
								<a class="btn-primary btn btn-light step1" href="#step-1" data-bs-original-title="" title="">1</a>
								<p>{{ __('customer_form_step1') }}</p>
							</div>
							<div class="stepwizard-step">
								<a class="btn-primary btn" href="#step-2" data-bs-original-title="" title="">2</a>
								<p>{{ __('customer_form_step2') }}</p>
							</div>
							<div class="stepwizard-step">
								<a class="btn-primary btn" href="#step-3" data-bs-original-title="" title="">3</a>
								<p>{{ __('customer_form_step3') }}</p>
							</div> 
						</div>
					</div>
                    <form method="post" class="form" action="/customer-form-upload" enctype="multipart/form-data">
    
                        <input type="hidden" name="id" value="{{ $resource->id }}">
                        @csrf
						<div class="setup-content" id="step-1" >
							<div class="col-xs-12">
								<div class="col-md-12">
									<div class="w3-center w3-large">
                                        {{ __('please_download_pdf_file_and_fill_it') }}
                                    </div>
                                    <br>
									<div class="w3-center">
                                        <button class="btn btn-primary nextBtn pull-" type="button" data-bs-original-title="" title="">{{ __('next') }}</button>
                                    </div>
								</div>
							</div>
						</div>
						<div class="setup-content" id="step-2" style="display: none;">
							<div class="col-xs-12">
								<div class="col-md-12">
									<div class="w3-block w3-center">
                                        <a href="{{ url('/customer-pdf-download') }}/{{ $resource->id }}">
                                            <div class="btn-primary w3-padding btn"
                                                style="width: 200px;border-radius: 5em;margin: auto">
                                                <i class="fa fa-cloud-download"></i> {{ __('download_pdf') }}
                                            </div>
                                        </a>
                                    </div>
                                    <br>
									<div class="w3-center">
                                        <button class="btn btn-primary pull-" type="button" onclick="gotoStep(1)" data-bs-original-title="" title="">{{ __('back') }}</button>
									    <button class="btn btn-primary nextBtn pull-" type="button" data-bs-original-title="" title="">Next</button>
                                    </div>
								</div>
							</div>
						</div>
						<div class="setup-content" id="step-3" style="display: none;">
							<div class="col-xs-12">
								<div class="col-md-12">
									<div class="mb-12">
										<label class="labels">@trans('upload_pdf')</label>
                                        <input type="file" name="file" class="form-control" id="">
									</div> 
                                    <br>
									<div class="w3-center">
                                        <button class="btn btn-primary pull-" type="button" onclick="gotoStep(2)" data-bs-original-title="" title="">{{ __('back') }}</button>
									    <button class="btn btn-primary nextBtn pull-" type="submit" data-bs-original-title="" title="">{{ __('submit') }}</button>
                                    </div>
								</div>
							</div>
						</div> 
					</form>
				</div>
			</div> 
        </div>
        <br>

    </div>
@endsection

@section('script')
<script src="{{ url('/') }}/assets/js/form-wizard/form-wizard-two.js"></script>
    <script>

        $('.step1').click();

        function gotoStep(step) {
            $('.setup-content').hide();
            $('#step-' + step).show();
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



        $(document).ready(function() {
            $('.step1').click();
            formAjax(false, function(res) {
                if (res.status == 1)
                    window.location.reload();
            });
        });


        
    </script>
@endsection
