<script type="text/javascript">
    //Roles table 
    var footballTable = {};
    if ($('#footballOrderTable').length > 0)
    footballTable = $('#footballOrderTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/sub/football-order',
        @include("layouts.partials.datatable_plugin")
        "columns": [{
                "data": "name"
            },
            {
                "data": "description"
            },
            {
                "data": "group_number"
            },
            {
                "data": "contact_id"
            },
            {
                "data": "date"
            },
            {
                "data": "start_time"
            },
            {
                "data": "end_time"
            }, 
            {
                "data": "class_type_id"
            }, 
            {
                "data": "action"
            }
        ]
    });  
</script>
<script> 
    function createFootballOrder() {
        app.class_type_resource = {};
        $('.football-order-modal').modal('show');  
    }

    function editFootballOrder(resource) {
        console.log(resource); 
        app.class_type_resource = resource;
        $('.football-order-modal').modal('show');
    }

    function removeFootballOrder(id) {
        swal({
            title: '{{ __("warning") }}',
            text: '{{ __("are your sure") }}',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.post("{{ url('/sub/football-order/') }}/" + id, "", function(res){
                    if (res.status == 1) {
                        toastr.success(res.message);
                        loadFootballOrder();
                    } else {
                        toastr.error(res.message);
                    }
                });
            }
        });
    }

    function loadFootballOrder() {
        $.get("{{ url('/sub/football-order') }}", function(res){
            footballTable.ajax.reload();

            // reload calendar if change class type
            reload_calendar();
        });
    }

    function searchAboutContact() {
        //contact_id
    }

    $(document).ready(function(){ 
        formAjax(true, function(res){
            loadFootballOrder();

            if (!app.football_order_resource.id && res.status != 0)
                app.football_order_resource = {};

            if (res.status == 1) {
                reload_calendarFoot();
                $('.football-order-modal').modal('hide');  
            }
        }, '.football-order-form');

        loadFootballOrder();
    });
</script>
