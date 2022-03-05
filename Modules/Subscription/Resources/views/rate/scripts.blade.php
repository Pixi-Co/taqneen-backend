<!-- user scripts -->
<script type="text/javascript">
    //Roles table 
    var rateTable = {};
    if ($('#ratetable').length > 0)
    rateTable = $('#ratetable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/sub/rate',
        @include("layouts.partials.datatable_plugin")
        "columns": [
            {
                "data": "name"
            },
            {
                "data": "description"
            },
            {
                "data": "active"
            },
            {
                "data": "rate"
            },
            {
                "data": "action"
            }
        ]
    });  
</script>

<script>
    function createRate() {
        app.rate_resource = {};
        $('.active_rate').iCheck('uncheck');
        $('.active_rate').val(0);
        $('.rate-modal').modal('show');
    }

    function rateLink(url) {
        console.log(url);  
        $('#rateLink').val(url);
        $('.rater-link-modal').modal('show');
    }

    function editRate(resource) {
        console.log(resource); 
        app.rate_resource = resource; 

        if (app.rate_resource.active == 1) {
            $('.active_rate').iCheck('check'); 
            $('.active_rate').val(1);
        }

        $('.rate-modal').modal('show');
    }
    
    function removeRate(id) {
        swal({
            title: '{{ __("warning") }}',
            text: '{{ __("are your sure") }}',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.post("{{ url('/sub/rate/') }}/" + id, "", function(res){
                    if (res.status == 1) {
                        toastr.success(res.message);
                        rateTable.ajax.reload();
                    } else {
                        toastr.error(res.message);
                    }
                });
            }
        });
    }

    $(document).ready(function() { 
        formAjax(true, function(res) {
            rateTable.ajax.reload();


            if (!app.rate_resource.id) { 
                app.rate_resource = {};
            }

            // reload calendar if change class type
            reload_calendar();
        }, ".rate-form"); 
    });
</script>
