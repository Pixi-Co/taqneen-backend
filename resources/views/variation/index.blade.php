 
<div class="page-title hidden">
{{ __('product.variations') }}
</div>

<!-- Content Header (Page header) -->
<section class="content-header hidden">
    <h1>@trans('product.variations')
        <small>@trans('lang_v1.manage_product_variations')</small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <div class="">
        <button type="button" class="add_btn btn-modal" 
        data-href="{{action('VariationTemplateController@create')}}" 
        data-container=".variation_modal">
        <i class="fa fa-plus"></i> @trans('messages.add')</button>
    </div> 
    <div class="display-container"> 
        <div class="table-responsive">
            <table data-title="{{ __('product.variations') }}" class="table table-bordered table-striped" id="variation_table">
                <thead>
                    <tr>
                        <th>@trans('product.variations')</th>
                        <th>@trans('lang_v1.values')</th>
                        <th>@trans('messages.action')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade variation_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
 
<script>
    //Start: CRUD for product variations
    //Variations table
    var variation_table = $('#variation_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/variation-templates',
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
            targets: 2,
            orderable: false,
            searchable: false,
        }, ],
    });
    $(document).on('click', '#add_variation_values', function() {
        var html =
            '<div class="form-group"><div class="col-sm-7 col-sm-offset-3"><input type="text" name="variation_values[]" class="form-control" required></div><div class="col-sm-2"><button type="button" class="btn btn-danger delete_variation_value">-</button></div></div>';
        $('#variation_values').append(html);
    });
    $(document).on('click', '.delete_variation_value', function() {
        $(this)
            .closest('.form-group')
            .remove();
    });
    $(document).on('submit', 'form#variation_add_form', function(e) {

        if ($(this).attr('listnered') == 1) 
            return 0;
        else {
            $(this).attr('listnered', 1);
        }
        e.preventDefault();
        $(this)
            .find('button[type="submit"]')
            .attr('disabled', true);
        var data = $(this).serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success === true) {
                    $('div.variation_modal').modal('hide');
                    toastr.success(result.msg);
                    variation_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.edit_variation_button', function() {
        $('div.variation_modal').load($(this).data('href'), function() {
            $(this).modal('show');

            $('form#variation_edit_form').submit(function(e) {
                $(this)
                    .find('button[type="submit"]')
                    .attr('disabled', true);
                e.preventDefault();

                if ($(this).attr('listnered') == 1) 
                    return 0;
                else {
                    $(this).attr('listnered', 1);
                }
                var data = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success === true) {
                            $('div.variation_modal').modal('hide');
                            toastr.success(result.msg);
                            variation_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
        });
    });

    $(document).on('click', 'button.delete_variation_button', function() {
        swal({
            title: LANG.sure,
            text: LANG.confirm_delete_variation,
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
                        if (result.success === true) {
                            toastr.success(result.msg);
                            variation_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

    var active = false;
    $(document).on('mousedown', '.drag-select', function(ev) {
        active = true;
        $('.active-cell').removeClass('active-cell'); // clear previous selection

        $(this).addClass('active-cell');
        cell_value = $(this)
            .find('input')
            .val();
    });
    $(document).on('mousemove', '.drag-select', function(ev) {
        if (active) {
            $(this).addClass('active-cell');
            $(this)
                .find('input')
                .val(cell_value);
        }
    });

    $(document).mouseup(function(ev) {
        active = false;
        if (!$(ev.target).hasClass('drag-select') &&
            !$(ev.target).hasClass('dpp') &&
            !$(ev.target).hasClass('dsp')
        ) {
            $('.active-cell').each(function() {
                $(this).removeClass('active-cell');
            });
        }
    });
</script>
