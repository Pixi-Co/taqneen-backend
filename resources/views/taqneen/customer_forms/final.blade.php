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
            <div class="card__">
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


        
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return false;
})

    </script>
@endsection
