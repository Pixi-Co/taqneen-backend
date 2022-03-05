@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages'))

@section('content')
    @include('superadmin::layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@trans('superadmin::lang.packages') <small>@trans('superadmin::lang.all_packages')</small></h1>
        <!-- <ol class="breadcrumb">
                <a href="#"><i class="fa fa-dashboard"></i> Level</a><br/>
                <li class="active">Here<br/>
            </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        @include('superadmin::layouts.partials.currency')

        <div class="w3-block">
            <div class="w3-block w3-round w3-white material-shadow" style="padding: 5px">
                <div class="">
                    <a href="{{ action('\Modules\Superadmin\Http\Controllers\PackagesController@create') }}"
                        class="add_btn">
                        <i class="fa fa-plus"></i> @trans( 'messages.add' )</a>
                </div>
            </div>
            <br>

            <div class="w3-block w3-padding">
                <div class="owl-carousel owl-theme notes slider">
                    @foreach ($packages as $package)
                        <div class="item w3-padding">

                            <div class="material-shadow w3-white w3-round-xlarge w3-padding w3-center w3-display-container">
                                <div class="w3-display-topleft w3-padding">
                                    @if ($package->businessType)
                                        <span class="label w3-green">
                                            {{ optional($package->businessType)->name }}
                                        </span>
                                    @endif
                                </div>
                                <div class="">
                                    <img src="{{ $package->image_url }}" style="width: 70%;margin: auto" alt="">


                                    <h2 class="w3-large">{{ $package->name }}</h2>

                                    <div class="row">
                                        @if ($package->is_active == 1)
                                            <span class="badge bg-green">
                                                @trans('superadmin::lang.active')
                                            </span>
                                        @else
                                            <span class="badge bg-red">
                                                @trans('superadmin::lang.inactive')
                                            </span>
                                        @endif

                                        <a href="{{ action('\Modules\Superadmin\Http\Controllers\PackagesController@edit', [$package->id]) }}"
                                            class="btn btn-box-tool" title="edit"><i class="fa fa-edit"></i></a>
                                        <a href="{{ action('\Modules\Superadmin\Http\Controllers\PackagesController@destroy', [$package->id]) }}"
                                            class="btn btn-box-tool link_confirmation" title="delete"><i
                                                class="fa fa-trash"></i></a>

                                        <a href="{{ url('/packages/permissions/') }}/{{ $package->id }}"
                                            class="btn btn-box-tool" title="edit permissions"><i class="fa fa-list"></i></a>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <hr>
                                <div
                                    class="box-body w3-text-gray {{ auth()->user()->language == 'ar' ? 'text-right' : 'text-left' }}">

                                    <span class="plus-icon-list-icon w3-text-green"><i class="fa fa-check"
                                            aria-hidden="true"></i></span>

                                    @if ($package->location_count == 0)
                                        @trans('superadmin::lang.unlimited')
                                    @else
                                        {{ $package->location_count }}
                                    @endif

                                    @trans('business.business_locations')
                                    <br />

                                    <span class="plus-icon-list-icon w3-text-green"><i class="fa fa-check"
                                            aria-hidden="true"></i></span>

                                    @if ($package->user_count == 0)
                                        @trans('superadmin::lang.unlimited')
                                    @else
                                        {{ $package->user_count }}
                                    @endif

                                    @trans('superadmin::lang.users')
                                    <br />

                                    <span class="plus-icon-list-icon w3-text-green"><i class="fa fa-check"
                                            aria-hidden="true"></i></span>

                                    @if ($package->product_count == 0)
                                        @trans('superadmin::lang.unlimited')
                                    @else
                                        {{ $package->product_count }}
                                    @endif

                                    @trans('superadmin::lang.products')
                                    <br />

                                    <span class="plus-icon-list-icon w3-text-green"><i class="fa fa-check"
                                            aria-hidden="true"></i></span>

                                    @if ($package->invoice_count == 0)
                                        @trans('superadmin::lang.unlimited')
                                    @else
                                        {{ $package->invoice_count }}
                                    @endif

                                    @trans('superadmin::lang.invoices')
                                    <br />

                                    @if ($package->trial_days != 0)

                                        <span class="plus-icon-list-icon w3-text-green"><i class="fa fa-check"
                                                aria-hidden="true"></i></span>

                                        {{ $package->trial_days }} @trans('superadmin::lang.trial_days')
                                        <br />
                                    @endif

                                    @if (!empty($package->custom_permissions))
                                        @foreach ($package->custom_permissions as $permission => $value)
                                            @isset($permission_formatted[$permission])

                                                <span class="plus-icon-list-icon w3-text-green"><i class="fa fa-check"
                                                        aria-hidden="true"></i></span>

                                                {{ $permission_formatted[$permission] }}
                                                <br />
                                            @endisset
                                        @endforeach
                                    @endif

                                    <hr>
                                    <h3 class="text-center w3-large w3-text-deep-orange">
                                        @if ($package->price != 0)
                                            <span class="display_currency" data-currency_symbol="true">
                                                {{ $package->price }}
                                            </span>

                                            <small>
                                                / {{ $package->interval_count }}
                                                {{ __('lang_v1.' . $package->interval) }}
                                            </small>
                                        @else
                                            @trans('superadmin::lang.free_for_duration', ['duration' =>
                                            $package->interval_count . ' ' . __('lang_v1.' . $package->interval)])
                                        @endif
                                    </h3>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer text-center">
                                    {{ $package->description }}
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                    @endforeach
                </div>

                <div class="col-md-12">
                    {{ $packages->links() }}
                </div>
            </div>

        </div>

        <div class="modal fade brands_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->

@endsection

@section('javascript')
    <script>
        $('.slider').owlCarousel({
            loop: true,
            rtl: {{ auth()->user()->language == 'ar' ? 'true' : 'false' }},
            margin: 10,
            center: false,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    </script>
@endsection
