 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     <h1>@trans( 'brand.brands' )
         <small>@trans( 'brand.manage_your_brands' )</small>
     </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
 </section>

 <div class="page-title hidden">
     {{ __('brand.all_your_brands') }}
 </div>

 <!-- Main content -->
 <section class="content">
     @can('brand.create')
         <div class="">
             <button type="button" class="add_btn btn-modal" data-href="{{ action('BrandController@create') }}"
                 data-container=".brands_modal">
                 <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
         </div>
     @endcan
     @can('brand.view')
         <div class="table-responsive w3-light-gray">
             <table data-title="{{ __('brand.all_your_brands') }}" class="table table-bordered table-striped" id="brands_table">
                 <thead>
                     <tr>
                         <th>@trans( 'brand.brands' )</th>
                         <th>@trans( 'brand.note' )</th>
                         <th>@trans( 'messages.action' )</th>
                     </tr>
                 </thead>
             </table>
         </div>
     @endcan

     <div class="modal fade brands_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>

 </section>
 <!-- /.content -->
 
<script>
    
    //Brands table
    var brands_table = $('#brands_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/brands',
        @include("layouts.partials.datatable_plugin")
        columnDefs: [{
            targets: 2,
            orderable: false,
            searchable: false,
        }, ],
    });

    $(document).on('click', 'button.edit_brand_button', function() {
        $('div.brands_modal').load($(this).data('href'), function() {
            $(this).modal('show');

            $('form#brand_edit_form').submit(function(e) {

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
                        if (result.success == true) {
                            $('div.brands_modal').modal('hide');
                            toastr.success(result.msg);
                            brands_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
        });
    });

    $(document).on('click', 'button.delete_brand_button', function() {
        swal({
            title: LANG.sure,
            text: LANG.confirm_delete_brand,
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
                            brands_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
</script>
