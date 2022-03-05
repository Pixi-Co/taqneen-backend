 

<style>

    .modal input[type=text], .modal input[type=number] {
        background-color: #f1f5f8;
    }

    .modal .col-sm-6 {
        height: auto;
    }
</style>

  
 
<section class="content-header hidden">
    <h1>@trans( 'sale.discount' )
    </h1> 
</section>

<div class="page-title hidden">
{{ __('sale.discount') }}
</div>

<!-- Main content -->
<section class="content">

	<div class="w3-white" >
        <div class="">  
            <div class="row">
                <div class="col-sm-6 text-left"> 
                    <div style="display: flex; width: 100%;">
                        {!! Form::open(['url' => action('DiscountController@massDeactivate'), 'method' => 'post', 'id' => 'mass_deactivate_form' ]) !!}
                        {!! Form::hidden('selected_discounts', null, ['id' => 'selected_discounts']); !!}
                        {!! Form::submit(__('lang_v1.deactivate_selected'), array('class' => 'btn  btn-default w3-round-xlarge ', 'id' => 'deactivate-selected')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-sm-6 text-right">
                    @can('brand.create') 
                        <button type="button" class="add_btn btn-modal" 
                        data-href="{{action('DiscountController@create')}}" 
                        data-container=".discount_modal">
                        <i class="fa fa-plus"></i> @trans( 'messages.add' )</button> 
                    @endcan
                </div>
            </div>
        </div>
        <div class="">
            @can('brand.view')
                <div class="table-responsive w3-light-gray">
            	<table data-title="@trans('lang_v1.all_your_discounts')" class="table table-bordered table-striped" id="discounts_table">
            		<thead>
            			<tr>
                            <th><input type="checkbox" id="select-all-row" data-table-id="discounts_table"></th>
            				<th>@trans( 'unit.name' )</th>
            				<th>@trans( 'lang_v1.starts_at' )</th>
            				<th>@trans( 'lang_v1.ends_at' )</th>
                            <th>@trans( 'sale.discount_amount' )</th>
                            <th>@trans( 'lang_v1.priority' )</th>
                            <th>@trans( 'product.brand' )</th>
                            <th>@trans( 'product.category' )</th>
                            <th>@trans( 'report.products' )</th>
                            <th>@trans( 'sale.location' )</th>
                            <th>@trans( 'messages.action' )</th>
            			</tr>
            		</thead> 
            	</table>
                </div>
            @endcan
        </div>
    </div>

    <div class="modal fade discount_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content --> 
<script type="text/javascript">
    
    var discounts_table = $('#discounts_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: base_path + '/discount',
        "autoWidth": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        dom: 'RlBfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'colvis'
        ],
        columnDefs: [{
            targets: [0, 8, 10],
            orderable: false,
            searchable: false,
        }, ],
        aaSorting: [1, 'asc'],
        columns: [
            { data: 'row_select' },
            { data: 'name', name: 'discounts.name' },
            { data: 'starts_at', name: 'starts_at' },
            { data: 'ends_at', name: 'ends_at' },
            { data: 'discount_amount', name: 'discount_amount' },
            { data: 'priority', name: 'priority' },
            { data: 'brand', name: 'b.name' },
            { data: 'category', name: 'c.name' },
            { data: 'products' },
            { data: 'location', name: 'l.name' },
            { data: 'action', name: 'action' },
        ],
    });

    $(document).on('click', '#deactivate-selected', function(e){

        if ($(this).attr('listnered') == 1) 
            return 0;
        else {
            $(this).attr('listnered', 1);
        }
        e.preventDefault();
        var selected_rows = [];
        var i = 0;
        $('.row-select:checked').each(function () {
            selected_rows[i++] = $(this).val();
        }); 
        
        if(selected_rows.length > 0){
            $('input#selected_discounts').val(selected_rows);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('form#mass_deactivate_form').submit();
                }
            });
        } else{
            $('input#selected_discounts').val('');
            swal('@trans("lang_v1.no_row_selected")');
        }    
    });

    $(document).on('click', '.activate-discount', function(e){

        if ($(this).attr('listnered') == 1) 
            return 0;
        else {
            $(this).attr('listnered', 1);
        }
        e.preventDefault();
        var href = $(this).data('href');
        $.ajax({
            method: "get",
            url: href,
            dataType: "json",
            success: function(result){
                if(result.success == true){
                    toastr.success(result.msg);
                    discounts_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });

    $(document).on('shown.bs.modal', '.discount_modal', function(){
        $('#variation_ids').select2({
            ajax: {
                url: '/purchases/get_products?check_enable_stock=false&only_variations=true',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    var results = [];
                    for (var item in data) {
                        results.push(
                            {
                                id: data[item].variation_id,
                                text: data[item].text,
                            }
                        );
                    }
                    return {
                        results: results,
                    };
                },
            },
            minimumInputLength: 1,
            closeOnSelect: false
        });
    });

    $(document).on('change', '#variation_ids', function(){
        if ($(this).val().length) {
            $('#brand_input').addClass('hide');
            $('#category_input').addClass('hide');
        } else {
            $('#brand_input').removeClass('hide');
            $('#category_input').removeClass('hide');
        }
    });

    $(document).on('hidden.bs.modal', '.discount_modal', function(){
        $("#variation_ids").select2('destroy'); 
    });
    
$('.discount_modal').on('shown.bs.modal', function() {
    $('.discount_modal')
        .find('.select2')
        .each(function() {
            var $p = $(this).parent();
            $(this).select2({ dropdownParent: $p });
        });
    $('.discount_modal')
        .find('input[type="checkbox"].input-icheck')
        .each(function() {
            $(this).iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green',
            });
        });
    //Datetime picker
    $('.discount_modal .discount_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });
    $('form#discount_form').validate();
});

$(document).on('submit', 'form#discount_form', function(e) {

    if ($(this).attr('listnered') == 1) 
        return 0;
    else {
        $(this).attr('listnered', 1);
    }
    e.preventDefault();
    var data = $(this).serialize();

    $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        dataType: 'json',
        data: data,
        success: function(result) {
            if (result.success == true) {
                $('div.discount_modal').modal('hide');
                toastr.success(result.msg);
                discounts_table.ajax.reload();
            } else {
                toastr.error(result.msg);
            }
        },
    });
});

$(document).on('click', 'button.delete_discount_button', function() {
    swal({
        title: LANG.sure,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            var href = $(this).data('href');
            var data = $(this).serialize();

            $.ajax({
                method: 'DELETE',
                url: href,
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        toastr.success(result.msg);
                        discounts_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        }
    });
});

</script> 
