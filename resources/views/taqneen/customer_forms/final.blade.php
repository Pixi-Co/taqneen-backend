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
					<h5>Form Wizard And Validation</h5>
					<span>Validation Step Form Wizard</span>
				</div>
				<div class="card-body">
					<div class="stepwizard">
						<div class="stepwizard-row setup-panel">
							<div class="stepwizard-step">
								<a class="btn-primary btn" href="#step-1" data-bs-original-title="" title="">1</a>
								<p>Step 1</p>
							</div>
							<div class="stepwizard-step">
								<a class="btn-primary btn" href="#step-2" data-bs-original-title="" title="">2</a>
								<p>Step 2</p>
							</div>
							<div class="stepwizard-step">
								<a class="btn-primary btn btn-light" href="#step-3" data-bs-original-title="" title="">3</a>
								<p>Step 3</p>
							</div>
							<div class="stepwizard-step">
								<a class="btn-primary btn" href="#step-4" data-bs-original-title="" title="">4</a>
								<p>Step 4</p>
							</div>
						</div>
					</div>
					<form action="#" method="POST">
						<div class="setup-content" id="step-1" style="display: none;">
							<div class="col-xs-12">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="control-label">First Name</label>
										<input class="form-control" type="text" placeholder="Johan" required="required" data-bs-original-title="" title="">
									</div>
									<div class="mb-3">
										<label class="control-label">Last Name</label>
										<input class="form-control" type="text" placeholder="Deo" required="required" data-bs-original-title="" title="">
									</div>
									<button class="btn btn-primary nextBtn pull-right" type="button" data-bs-original-title="" title="">Next</button>
								</div>
							</div>
						</div>
						<div class="setup-content" id="step-2" style="display: none;">
							<div class="col-xs-12">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="control-label">Email</label>
										<input class="form-control" type="text" placeholder="name@example.com" required="required" data-bs-original-title="" title="">
									</div>
									<div class="mb-3">
										<label class="control-label">Password</label>
										<input class="form-control" type="password" placeholder="Password" required="required" data-bs-original-title="" title="">
									</div>
									<button class="btn btn-primary nextBtn pull-right" type="button" data-bs-original-title="" title="">Next</button>
								</div>
							</div>
						</div>
						<div class="setup-content" id="step-3" style="">
							<div class="col-xs-12">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="control-label">Birth date</label>
										<input class="form-control" type="date" required="required" data-bs-original-title="" title="">
									</div>
									<div class="mb-3">
										<label class="control-label">Have Passport</label>
										<input class="form-control" type="text" placeholder="yes/No" required="required" data-bs-original-title="" title="">
									</div>
									<button class="btn btn-primary nextBtn pull-right" type="button" data-bs-original-title="" title="">Next</button>
								</div>
							</div>
						</div>
						<div class="setup-content" id="step-4" style="display: none;">
							<div class="col-xs-12">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="control-label">State</label>
										<input class="form-control mt-1" type="text" placeholder="State" required="required" data-bs-original-title="" title="">
									</div>
									<div class="mb-3">
										<label class="control-label">City</label>
										<input class="form-control mt-1" type="text" placeholder="City" required="required" data-bs-original-title="" title="">
									</div>
									<button class="btn btn-success pull-right" type="submit" data-bs-original-title="" title="">Finish!</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
            
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('steps_of_customer_form_header') }}</h5>
                </div>
                <form method="post" class="form" action="/customer-form-upload" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="{{ $resource->id }}">
                    @csrf
                    <!-- multistep form -->
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">{{ __('customer_form_step1') }}</li>
                        <li>{{ __('customer_form_step2') }}</li>
                        <li>{{ __('customer_form_step3') }}</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <h2 class="fs-title">{{ __('customer_form_step1') }}</h2>
                        <h3 class="fs-subtitle">{{ __('step') }} 1</h3>
                        <div class="w3-center w3-large">
                            {{ __('please_download_pdf_file_and_fill_it') }}
                        </div>
                        <input type="button" name="next" class="next action-button" value="{{ __('next') }}" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">{{ __('customer_form_step2') }}</h2>
                        <h3 class="fs-subtitle">{{ __('step') }} 2</h3>
                        <div class="w3-block w3-center">
                            <a href="{{ url('/customer-pdf-download') }}/{{ $resource->id }}">
                                <div class="btn-primary w3-padding btn"
                                    style="width: 200px;border-radius: 5em;margin: auto">
                                    <i class="fa fa-cloud-download"></i> {{ __('download_pdf') }}
                                </div>
                            </a>
                        </div>
                        <input type="button" name="previous" class="previous action-button" value="{{ __('back') }}" />
                        <input type="button" name="next" class="next action-button" value="{{ __('next') }}" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">{{ __('customer_form_step3') }}</h2>
                        <h3 class="fs-subtitle">{{ __('step') }} 3</h3>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">@trans('upload_pdf')</label>
                                <input type="file" name="file" class="form-control" id="">
                            </div>
                        </div>
                        <input type="button" name="previous" class="previous action-button" value="{{ __('back') }}" />
                        <input type="submit" name="submit" class="submit action-button" value="{{ __('submit') }}" />
                    </fieldset>

                </form>
            </div>
        </div>
        <br>

    </div>
@endsection

@section('script')
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



        $(document).ready(function() {
            formAjax(false, function(res) {
                if (res.status == 1)
                    window.location.reload();
            });
        });


        
    </script>
@endsection
