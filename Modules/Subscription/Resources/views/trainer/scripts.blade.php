<!-- user scripts -->
<script type="text/javascript">
    //Roles table
    
    var trainerTable = {};
    if ($('#trainertable').length > 0)
    trainerTable = $('#trainertable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/sub/trainer',
        @include("layouts.partials.datatable_plugin")
        "columns": [{
                "data": "full_name"
            },
            {
                "data": "class_type_ids"
            },
            {
                "data": "username"
            },
            {
                "data": "email"
            },
            {
                "data": "rate"
            },
            {
                "data": "action"
            },
            {
                "data": "contacts"
            }
        ]
    });  
</script>

<script>
    function setClassTypes() {
        var ids = "["+ $('.class_type_ids_select').val().toString() +"]";
        app.trainer_resource.class_type_ids = ids;
        $('.class_type_ids').val(ids);
    }

    function createTrainer() {
        app.trainer_resource = {};
        $('.trainer-modal').modal('show');
    }

    function rateTrainerLink(link) {
        $('#trainerLink').val(link);
        $('.rate-link-modal').modal('show'); 
    }

    function editTrainer(resource) {
        console.log(resource);
        app.trainer_resource = resource;
        var ids = JSON.parse(app.trainer_resource.class_type_ids);
        console.log(ids);

        $('.class_type_ids_select').val(ids);
        $('.class_type_ids_select').select2()
        $('.trainer-modal').modal('show');
    }
    
    function removeTrainer(id) {
        swal({
            title: '{{ __("warning") }}',
            text: '{{ __("are your sure") }}',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.post("{{ url('/sub/trainer/') }}/" + id, "", function(res){
                    if (res.status == 1) {
                        toastr.success(res.message);
                        trainerTable.ajax.reload();
                    } else {
                        toastr.error(res.message);
                    }
                });
            }
        });
    }

    $(document).ready(function() { 
        $('.class_type_ids_select').select2();

        formAjax(true, function(res) {
            trainerTable.ajax.reload();

            if (!app.trainer_resource.id)
                app.trainer_resource = {};
        });

    });
</script>
