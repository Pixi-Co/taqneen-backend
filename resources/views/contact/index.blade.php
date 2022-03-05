@extends('layouts.app')
@section('title', __('lang_v1.' . $type . 's'))
@php
$api_key = env('GOOGLE_MAP_API_KEY');
@endphp
@if (!empty($api_key))
    @section('css')
        @include('contact.partials.google_map_styles')
    @endsection
@endif

@section("css")
<style>
    .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
        padding: 2px!important;
    }
</style>
@endsection
@section('content')

    <!-- Main content -->
    <section class="content new-content">

        <input type="hidden" value="{{ $type }}" id="contact_type">

        @component('components.widget', ['class' => 'box-primary', 'title_' => __('contact.all_your_contact', ['contacts' =>
            __('lang_v1.' . $type . 's')])])

            @if (auth()->user()->can('supplier.create') ||
            auth()->user()->can('customer.create') ||
            auth()->user()->can('supplier.view_own') ||
            auth()->user()->can('customer.view_own'))
                <div class="w3-block" style="height: 40px">
                    <button type="button" class="add_btn btn-modal"
                        data-href="{{ action('ContactController@create', ['type' => $type]) }}"
                        data-container=".contact_modal">
                        <i class="fa fa-plus"></i> @trans('messages.add')</button>
                </div>
                <br>

            @endif

            <div class="table-responsive light-gray w3-border w3-border-light-gray">

                @if (auth()->user()->can('supplier.view') ||
            auth()->user()->can('customer.view') ||
            auth()->user()->can('supplier.view_own') ||
            auth()->user()->can('customer.view_own'))
                    <table data-title="@trans('lang_v1.'.$type.'s')" class="table table-bordered table-striped"
                        id="contact_table">
                        <thead>
                            <tr>
                                <th>@trans('messages.action')</th> 
                                <th>@trans('contact.name')</th>
                                <th>@trans('gender')</th>
                                <th>@trans('contact.mobile')</th>
                                <th>@trans('business.email')</th>
                                <th>@trans('lang_v1.dob')</th>
                                <th>@trans('pay')</th>
                                <th>@trans('contacts')</th>
                            </tr>
                        </thead> 
                </table>
                @endif
            </div>
        @endcomponent

        <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade pay_contact_due_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

        @include("contact.pay_installment")

    </section>
    <!-- /.content -->
@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            @if (request()->action == 'create')
                $('.add_btn').click();
            @endif
        });
    </script>
    @if (!empty($api_key))
        <script>
            // This example adds a search box to a map, using the Google Place Autocomplete
            // feature. People can enter geographical searches. The search box will return a
            // pick list containing a mix of places and predicted search terms.

            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

            function initAutocomplete() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: -33.8688,
                        lng: 151.2195
                    },
                    zoom: 10,
                    mapTypeId: 'roadmap'
                });

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords
                            .longitude);
                        map.setCenter(initialLocation);
                    });
                }


                // Create the search box and link it to the UI element.
                var input = document.getElementById('shipping_address');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });

                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function(marker) {
                        marker.setMap(null);
                    });
                    markers = [];

                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        //set position field value
                        var lat_long = [place.geometry.location.lat(), place.geometry.location.lng()]
                        $('#position').val(lat_long);

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&libraries=places" async defer>
        </script>
        <script type="text/javascript">
            $(document).on('shown.bs.modal', '.contact_modal', function(e) {
                initAutocomplete();
            });
        </script>
    @endif

    <script>
        //Start: CRUD for Contacts
        //contacts table
        var contact_table_type = $('#contact_type').val();
        

        var contact_table = $('#contact_table').DataTable({
            processing: true,
            serverSide: true,
             
            "oLanguage": {
                "sUrl": "/js/ar.json"
            }, 
            "ajax": {
                "url": "/contacts",
                "data": function(d) {
                    d.type = $('#contact_type').val();
                    d = __datatable_ajax_callback(d);
                }
            },
            "autoWidth": true,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: 'RlBfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'colvis'
            ],
            aaSorting: [
                [1, 'desc']
            ],
            columns: [
                {
                    data: 'action',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'dob',
                    name: 'dob'
                },
                {
                    data: 'pay',
                    name: 'pay'
                },
                {
                    data: 'contacts',
                    name: 'contacts'
                },
            ],
            fnDrawCallback: function(oSettings) {
                var total_due = sum_table_col($('#contact_table'), 'contact_due');
                $('#footer_contact_due').text(total_due);

                var total_return_due = sum_table_col($('#contact_table'), 'return_due');
                $('#footer_contact_return_due').text(total_return_due);
                __currency_convert_recursively($('#contact_table'));
            },
        });

        //On display of add contact modal
        $('.contact_modal').on('shown.bs.modal', function(e) {

            $('.more_btn').click(function() {
                $($(this).attr('data-target')).toggleClass('hide');
            });
            $('div.lead_additional_div').hide();

            if ($('select#contact_type').val() == 'customer') {
                $('div.supplier_fields').hide();
                $('div.customer_fields').show();
            } else if ($('select#contact_type').val() == 'supplier') {
                $('div.supplier_fields').show();
                $('div.customer_fields').hide();
            } else if ($('select#contact_type').val() == 'lead') {
                $('div.supplier_fields').hide();
                $('div.customer_fields').hide();
                $('div.opening_balance').hide();
                $('div.pay_term').hide();
                $('div.lead_additional_div').show();
                $('div.shipping_addr_div').hide();
            }

            $('select#contact_type').change(function() {
                var t = $(this).val();

                if (t == 'supplier') {
                    $('div.supplier_fields').fadeIn();
                    $('div.customer_fields').fadeOut();
                } else if (t == 'both') {
                    $('div.supplier_fields').fadeIn();
                    $('div.customer_fields').fadeIn();
                } else if (t == 'customer') {
                    $('div.customer_fields').fadeIn();
                    $('div.supplier_fields').fadeOut();
                } else if (t == 'lead') {
                    $('div.customer_fields').fadeOut();
                    $('div.supplier_fields').fadeOut();
                    $('div.opening_balance').fadeOut();
                    $('div.pay_term').fadeOut();
                    $('div.lead_additional_div').fadeIn();
                    $('div.shipping_addr_div').hide();
                }
            });

            $(".contact_modal").find('.select2').each(function() {
                $(this).select2();
            });

            $('form#contact_add_form, form#contact_edit_form')
                .submit(function(e) {
                    e.preventDefault();
                })
                .validate({
                    rules: {
                        contact_id: {
                            remote: {
                                url: '/contacts/check-contact-id',
                                type: 'post',
                                data: {
                                    contact_id: function() {
                                        return $('#contact_id').val();
                                    },
                                    hidden_id: function() {
                                        if ($('#hidden_id').length) {
                                            return $('#hidden_id').val();
                                        } else {
                                            return '';
                                        }
                                    },
                                },
                            },
                        },
                    },
                    messages: {
                        contact_id: {
                            remote: LANG.contact_id_already_exists,
                        },
                    },
                    submitHandler: function(form) {
                        e.preventDefault();
                        var data = $(form).serialize();
                        $(form)
                            .find('button[type="submit"]')
                            .attr('disabled', true);
                        $.ajax({
                            method: 'POST',
                            url: $(form).attr('action'),
                            dataType: 'json',
                            data: data,
                            success: function(result) {
                                if (result.success == true) {
                                    $('div.contact_modal').modal('hide');
                                    toastr.success(result.msg);

                                    if (typeof(contact_table) != 'undefined') {
                                        contact_table.ajax.reload();
                                    }

                                    var lead_view = urlSearchParam('lead_view');
                                    if (lead_view == 'kanban') {
                                        initializeLeadKanbanBoard();
                                    } else if (lead_view == 'list_view' && typeof(
                                            leads_datatable) != 'undefined') {
                                        leads_datatable.ajax.reload();
                                    }

                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    },
                });
        });

        $(document).on('click', '.edit_contact_button', function(e) {
            e.preventDefault();
            $('div.contact_modal').load($(this).attr('href'), function() {
                $(this).modal('show');
            });
        });

        $(document).on('click', '.delete_contact_button', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: LANG.confirm_delete_contact,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).attr('href');
                    var data = $(this).serialize();

                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                contact_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
 
    </script>
@endsection
