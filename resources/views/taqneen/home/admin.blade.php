@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/css/css.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">

@endsection

@section('style')
@endsection

{{-- @section('breadcrumb-title')
<h3>@trans('dashboard_')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">@trans('dashboard_')</li>
    @endsection --}}

@section('content')
<div class="container-fluid">
	<div class="row second-chart-list third-news-update">
		<div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
			<div class="card o-hidden profile-greeting">
				<div class="card-body">
					<div class="media">
						<div class="badge-groups w-100">
							<div class="badge f-12"><i class="me-1" data-feather="clock"></i><span id="txt"></span></div>
							<div class="badge f-12"><i class="fa fa-spin fa-cog f-14"></i></div>
						</div>
					</div>
					<div class="greeting-user text-center bg-black">
						<div class="profile-vector"><img class="img-fluid" style="width: 100px;height: 100px;border-radius: 5em;" src="{{asset('/images/avatar.png')}}" alt=""></div>
						<h4 class="invisible f-w-600"><span id="greeting">@trans('welcome')</span> <span class="right-circle"><i class="fa fa-check-circle f-14 middle"></i></span></h4>
                        <h1 class="text-white f-w-600"><span id="greeting">@trans('welcome')</span> <span class="right-circle"><i class="fa fa-check-circle f-14 middle"></i></span></h1>

                        <p><span> @trans('todays subscriptions are') {{ round($todaySubscriptionTotal ,2)}} @trans('SR'), @trans('total of Expire Subscription is ') {{ $subscriptionsExpire }} </span></p>
						<div class="whatsnew-btn"><a href="/reports/subscriptions" class="btn btn-primary">@trans('subscriptions report')</a></div>
						<div class="left-icon"><i class="fa fa-bell"> </i></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-8 xl-100 dashboard-sec box-col-12">
			<div class="card earning-card">
				<div class="card-body p-0">
					<div class="row m-0">
						<div class="col-xl-3 earning-content p-0">
							<div class="row m-0 chart-left">
								<div class="col-xl-12 p-0 left_side_earning">
									<h5>@trans('subscription of view')</h5>
									<p class="font-roboto">@trans('Subscriptions totals')</p>
								</div>
								<div class="col-xl-12 p-0 left_side_earning">
									<h5>@trans('sar') {{ round($totalSalesMonth, 2) }} </h5>
									<p class="font-roboto">@trans('Subscriptions total this month')</p>
								</div>
								<div class="col-xl-12 p-0 left_side_earning">
									<h5>@trans('sar') {{ round($totalSaleslastMonth, 2) }}</h5>
									<p class="font-roboto">@trans('Subscriptions total last month')</p>
								</div>
								<div class="col-xl-12 p-0 left_side_earning">
									<h5>@trans('sar') {{ round($totalSalesYear, 2) }}</h5>
									<p class="font-roboto">@trans('Subscriptions total this year')</p>
								</div> 
							</div>
						</div>
						<div class="col-xl-9 p-0">
							<div class="chart-right">
								<div class="row m-0 p-tb">
									<div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
										<div class="inner-top-left">
										 
										</div>
									</div>
									<div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
										<div class="inner-top-right">
											<ul class="d-flex list-unstyled justify-content-end">
											 
											</ul>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="card-body p-0">
											<div class="current-sale-container">
												<div id="subscription_chart"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row border-top m-0">
								<div class="col-xl-4 ps-0 col-md-6 col-sm-6">
									<div class="media p-0">
										<div class="media-left"><i class="icofont icofont-cur-dollar"></i></div>
										<div class="media-body">
											<h6>@trans('Subscription total')</h6>
											<p> {{ round($totalSalesYear, 2) }}</p>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-md-6 col-sm-6">
									<div class="media p-0">
										<div class="media-left bg-secondary"><i class="icofont icofont-heart-alt"></i></div>
										<div class="media-body">
											<h6>@trans('Customer count') </h6>
											<p> {{ $customerTotal }}</p>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-md-12 pe-0">
									<div class="media p-0">
										<div class="media-left"><i class="icofont icofont-crown"></i></div>
										<div class="media-body">
											<h6>@trans('service count')</h6>
											<p> {{ $serviceCount }}     </p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 xl-100 chart_data_left box-col-12">
			<div class="card">
				<div class="card-body p-0">
					<div class="row m-0 chart-main">
						<div class="col-xl-4 col-md-6 col-sm-6 p-0 box-col-6">
							<div class="media align-items-center">
								<div class="hospital-small-chart">
									<div class="small-bar">
										<div class="small-chart flot-chart-container"></div>
									</div>
								</div>
								<div class="media-body">
									<div class="right-chart-content">
										<h4>{{ $subscriptions }}</h4>
										<span>@trans(' subscriptions total') </span>
									</div>
								</div>
							</div>
						</div>
						{{-- <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
							<div class="media align-items-center">
								<div class="hospital-small-chart">
									<div class="small-bar">
										<div class="small-chart1 flot-chart-container"></div>
									</div>
								</div>
								<div class="media-body">
									<div class="right-chart-content">
										<h4>1005</h4>
										<span>Sales</span>
									</div>
								</div>
							</div>
						</div> --}}
						<div class="col-xl-4 col-md-6 col-sm-6 p-0 box-col-6">
							<div class="media align-items-center">
								<div class="hospital-small-chart">
									<div class="small-bar">
										<div class="small-chart2 flot-chart-container"></div>
									</div>
								</div>
								<div class="media-body">
									<div class="right-chart-content">
										<h4>{{ $subscriptionsActive }}</h4>
										<span>@trans('active subscriptions ')</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-md-6 col-sm-6 p-0 box-col-6">
							<div class="media border-none align-items-center">
								<div class="hospital-small-chart">
									<div class="small-bar">
										<div class="small-chart3 flot-chart-container"></div>
									</div>
								</div>
								<div class="media-body">
									<div class="right-chart-content">
										<h4>{{ $subscriptionsExpire }}</h4>
										<span>@trans('expire subscriptions ')</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 xl-50 chart_data_right box-col-12">
			<div class="card">
				<div class="card-body">
					<div class="media align-items-center">
						<div class="media-body right-chart-content">
							<h4>@trans('sar') {{ round($totalSales,2) }}</h4>
							<span>@trans('subscriptions amount')</span>
						</div>
						<div class="knob-block text-center">
							{{-- <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#7366ff" data-bgcolor="#eef5fb" value="60"> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 xl-50 chart_data_right second d-none">
			<div class="card">
				<div class="card-body">
					<div class="media align-items-center">
						<div class="media-body right-chart-content">
							<h4>@trans('sar') 95,000<span class="new-box">New</span></h4>
							<span>Product Order Value</span>
						</div>
						<div class="knob-block text-center">
							{{-- <input class="knob1" data-width="50" data-height="70" data-thickness=".3" data-fgcolor="#7366ff" data-linecap="round" data-angleoffset="0" value="60"> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="col-xl-4 xl-50 news box-col-6">
			<div class="card">
				<div class="card-header">
					<div class="header-top">
						<h5 class="m-0">اخر التحديثات</h5>
						<div class="card-header-right-icon">
							<select class="button btn btn-primary">
								<option>اليوم</option>
								<option>غدا</option>
								<option>امس</option>
							</select>
						</div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="news-update">
						<h6>تم انتهاز الفرصة</h6>
						<span>...قامت الشركة بانتهاز فرصة هدمة عميل </span>
					</div>
					<div class="news-update">
						<h6>تم اضافة خدمة جديدة</h6>
						<span> ...قامت الشركة باضافة خدمة جديدة </span>
					</div>
					<div class="news-update">
						<h6>اشتراك جديد</h6>
						<span>...قام العميل بالاشتراك في خدمة  </span>
					</div>
				</div>
				<div class="card-footer">
					<div class="bottom-btn"><a href="#">More...</a></div>
				</div>
			</div>
		</div> --}}
		<div class="col-xl-6  appointment-sec box-col-6">
			<div class="row">
				{{-- <div class="col-xl-12 appointment">
					<div class="card">
						<div class="card-header card-no-border">
							<div class="header-top">
								<h5 class="m-0">الموعيد</h5>
								<div class="card-header-right-icon">
									<select class="button btn btn-primary">
										<option>اليوم</option>
										<option>غدا</option>
										<option>امس</option>
									</select>
								</div>
							</div>
						</div>
						<div class="card-body pt-0">
							<div class="appointment-table table-responsive">
								<table class="table table-bordernone">
									<tbody>
										<tr>
											<td>
												<img class="img-fluid img-40 rounded-circle mb-3" src="{{asset('assets/images/appointment/app-ent.jpg')}}" alt="Image description">
												<div class="status-circle bg-primary"></div>
											</td>
											<td class="img-content-box"><span class="d-block">Ahmed Ali</span><span class="font-roboto">Now</span></td>
											<td>
												<p class="m-0 font-primary">28 Sept</p>
											</td>
											<td class="text-end">
												<div class="button btn btn-primary">تم<i class="fa fa-check-circle ms-2"></i></div>
											</td>
										</tr>
										<tr>
											<td>
												<img class="img-fluid img-40 rounded-circle" src="{{asset('assets/images/appointment/app-ent.jpg')}}" alt="Image description">
												<div class="status-circle bg-primary"></div>
											</td>
											<td class="img-content-box"><span class="d-block">Mohamed ali</span><span class="font-roboto">11:00</span></td>
											<td>
												<p class="m-0 font-primary">22 Sept</p>
											</td>
											<td class="text-end">
												<div class="button btn btn-danger">معلق<i class="fa fa-check-circle ms-2"></i></div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div> --}}
				<div class="col-xl-12 alert-sec">
					<div class="card">
						<div class="card-header">
							<div class="header-top">

								<h5 class="m-0 w3-text-black">@trans('alert')</h5>
								<a href="{{url('mainreport')}}" class="btn btn-primary">@trans('show')</a>
							</div>
						</div>
						<div class="card-body">
							<div class="body-bottom">
								<h4>@trans('There is') {{ $subscriptionsExpire }} @trans('of customers whose subscription will expire soon')</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 notification box-col-6">
			<div class="card">
				<div class="card-header card-no-border">
					<div class="header-top">
						<h5 class="m-0">@trans('opportunities')</h5>
						<div class="card-header-right-icon">
							<select class="button btn btn-primary">
								<option>@trans('today')</option>
								<option>@trans('tomorrow')</option>
								<option>@trans('yesterday')</option>
							</select>
						</div>
					</div>
				</div>
				<div class="card-body pt-0">
					@foreach ($opportunities as $item)
						<div class="media">
							<div class="media-body">
								<p>{{ $item->created_at }} <span class="ps-1">@trans('day')</span></p>
								<div class="d-flex justify-content-between">
									<h6>{{ $item->name }}</h6>
									<a href="take-opportunity/{{ $item->id}}" class="btn btn-success">@trans('take opportunity')</a href="#">
								</div>
								<span>{{ $item->mobile }}</span>
							</div>
						</div>
					@endforeach
					
                    
				</div>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript">
	var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection

@section('script')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>

<script>
	// currently sale
	var options = {
		series: [
			{
			name: 'subscriptions',
			data: [
				@foreach ($data['chart'] as $key => $value)
					{{ $key }},
				@endforeach
			]
		} 
		],
		chart: {
			height: 240,
			type: 'area',
			toolbar: {
				show: false
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			curve: 'smooth'
		},
		xaxis: {
			type: 'category',
			low: 0,
			offsetX: 0,
			offsetY: 0,
			show: false,
			categories: [ 
				@foreach ($data['chart'] as $key => $value)
					'{{ $value }}',
				@endforeach
			],
			labels: {
				low: 0,
				offsetX: 0,
				show: false,
			},
			axisBorder: {
				low: 0,
				offsetX: 0,
				show: false,
			},
		},
		markers: {
			strokeWidth: 3,
			colors: "#ffffff",
			strokeColors: [CubaAdminConfig.primary, CubaAdminConfig.secondary],
			hover: {
				size: 6,
			}
		},
		yaxis: {
			low: 0,
			offsetX: 0,
			offsetY: 0,
			show: false,
			labels: {
				low: 0,
				offsetX: 0,
				show: false,
			},
			axisBorder: {
				low: 0,
				offsetX: 0,
				show: false,
			},
		},
		grid: {
			show: false,
			padding: {
				left: 0,
				right: 0,
				bottom: -15,
				top: -40
			}
		},
		colors: [CubaAdminConfig.primary, CubaAdminConfig.secondary],
		fill: {
			type: 'gradient',
			gradient: {
				shadeIntensity: 1,
				opacityFrom: 0.7,
				opacityTo: 0.5,
				stops: [0, 80, 100]
			}
		},
		legend: {
			show: false,
		},
		tooltip: {
			x: {
				format: 'MM'
			},
		},
	};

	var chart = new ApexCharts(document.querySelector("#subscription_chart"), options);
	chart.render();
</script>

@endsection

