 
 <section class="content-header hidden">
     <h1>@trans( 'business.business_locations' )
         <small>@trans( 'business.manage_your_business_locations' )</small>
     </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
 </section>

 <div class="page-title hidden">
     {{ __('business.business_locations') }}
 </div>

 <!-- Main content -->
 <section class="content">
     <div class="text-right">
         <button type="button" class="add_btn btn-modal" data-href="{{ action('BusinessLocationController@create') }}"
             data-container=".location_add_modal">
             <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
     </div>
     <div class="table-responsive w3-light-gray">
         <table data-title="{{ __('business.all_your_business_locations') }}"
             class="table table-bordered table-striped" id="business_location_table">
             <thead>
                 <tr>
                     <th>@trans( 'invoice.name' )</th>
                     <th>@trans( 'lang_v1.location_id' )</th>
                     <th>@trans( 'business.landmark' )</th>
                     <th>@trans( 'business.city' )</th>
                     <th>@trans( 'business.zip_code' )</th>
                     <th>@trans( 'business.state' )</th>
                     <th>@trans( 'business.country' )</th>
                     <th>@trans( 'lang_v1.price_group' )</th>
                     <th>@trans( 'invoice.invoice_scheme' )</th>
                     <th>@trans('lang_v1.invoice_layout_for_pos')</th>
                     <th>@trans('lang_v1.invoice_layout_for_sale')</th>
                     <th>@trans( 'messages.action' )</th>
                 </tr>
             </thead>
         </table>
     </div>

     <div class="modal fade location_add_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>
     <div class="modal fade location_edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>

 </section>
 <!-- /.content -->
 
 
<script>
    
    //Business locations CRUD
    var business_locations = $('#business_location_table').DataTable({
        processing: true,
        serverSide: true,
        bPaginate: false, 
        @include("layouts.partials.datatable_plugin")
        ajax: '/business-location',
        columnDefs: [{
            targets: 11,
            orderable: false,
            searchable: false,
        }, ],
    });
    $('.location_add_modal, .location_edit_modal').on('shown.bs.modal', function(e) {
        $('form#business_location_add_form')
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                rules: {
                    location_id: {
                        remote: {
                            url: '/business-location/check-location-id',
                            type: 'post',
                            data: {
                                location_id: function() {
                                    return $('#location_id').val();
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
                    location_id: {
                        remote: LANG.location_id_already_exists,
                    },
                },
                submitHandler: function(form) {

                    if ($(this).attr('listnered') == 1) 
                        return 0;
                    else {
                        $(this).attr('listnered', 1);
                    }
                    e.preventDefault();
                    $(form)
                        .find('button[type="submit"]')
                        .attr('disabled', true);
                    var data = $(form).serialize();

                    $.ajax({
                        method: 'POST',
                        url: $(form).attr('action'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                $('div.location_add_modal').modal('hide');
                                $('div.location_edit_modal').modal('hide');
                                toastr.success(result.msg);

                                if (result.load == 1)
                                    window.location.reload();
                                    
                                business_locations.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                },
            });

        $('form#business_location_add_form').find('#featured_products').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: '',
            ajax: {
                url: '/products/list?not_for_selling=true',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term, // search term
                        page: params.page,
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            var string = obj.name;
                            if (obj.type == 'variable') {
                                string += '-' + obj.variation;
                            }

                            string += ' (' + obj.sub_sku + ')';
                            return { id: obj.variation_id, text: string };
                        })
                    };
                },
            },
        })
    });

    if ($('#header_text').length) {
        init_tinymce('header_text');
    }

    if ($('#footer_text').length) {
        init_tinymce('footer_text');
    }

</script>
