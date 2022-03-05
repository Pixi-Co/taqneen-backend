@php
$packages = Modules\Superadmin\Entities\Package::where('is_active', '1')
    ->orderby('sort_order', 'asc')
    ->get();
@endphp
<div class="step step4 w3-modal w3-light-gray">

    <div class="modal-dialog modal-lg">

        <div class="modal-content" style="background: transparent!important;box-shadow: none">
            <div class="row">
                @foreach ($packages as $package)
                    <div class="col-md-4 w3-padding business-type business-type-{{ $package->business_type_id }}">

                        <div class="material-shadow w3-white w3-round-xlarge w3-padding w3-center">
                            <div class=""> 
                                <img src="{{ $package->image_url }}" style="width: 70%;margin: auto" alt=""> 
                                <h2 class="w3-large">{{ $package->name }}</h2>
                            </div>
                            <!-- /.box-header -->
                            <hr>
                            <div class="box-body w3-text-gray text-left">

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

                            <div class="w3-center">
                                <button type="button" onclick="choosePackage('{{ $package->id }}')"
                                    class="btn-package btn-package-{{ $package->id }} btn w3-round-xxlarge btn-default material-shadow">
                                    @trans('lang_v1.subscribe')
                                </button>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    @if ($loop->iteration % 3 == 0)
                        <div class="clearfix"></div>
                    @endif
                @endforeach
            </div>

            <br>
            <br>
            <div class="text-center">

                <button class="add_btn" onclick="$('#register_form')[0].submit()" >
                    @trans('Submit')
                </button>

            </div>
        </div>

    </div>

</div>
