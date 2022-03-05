
<script> 
    function createClassType() {
        app.class_type_resource = {};
        $('.class-type-modal').modal('show');  
    }

    function editClassType(resource) {
        console.log(resource); 
        app.class_type_resource = resource;
        $('.class-type-modal').modal('show');
    }

    function removeClassType(id) {
        swal({
            title: '{{ __("warning") }}',
            text: '{{ __("are your sure") }}',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.post("{{ url('/sub/class-type/') }}/" + id, "", function(res){
                    if (res.status == 1) {
                        toastr.success(res.message);
                        loadClassType();
                    } else {
                        toastr.error(res.message);
                    }
                });
            }
        });
    }

    function loadClassType() {
        $.get("{{ url('/sub/class-type') }}", function(res){
            app.class_types = res;

            // reload calendar if change class type
            reload_calendar();
        });
    }

    $(document).ready(function(){ 
        formAjax(true, function(res){
            loadClassType();

            if (!app.class_type_resource.id)
                app.class_type_resource = {};
        }, '.class-type-form');

        loadClassType();
    });
</script>
