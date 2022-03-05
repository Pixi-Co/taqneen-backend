
<script> 
    function createMeasurment() {
        app.measurment_resource = {};
        $('.measurment-modal').modal('show');
    }

    function editMeasurment(resource) {
        console.log(resource); 
        app.measurment_resource = resource;
        $('.measurment-modal').modal('show');
    }

    function removeMeasurment(id) {
        swal({
            title: '{{ __("warning") }}',
            text: '{{ __("are your sure") }}',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.post("{{ url('/sub/measurment/') }}/" + id, "", function(res){
                    if (res.status == 1) {
                        toastr.success(res.message);
                        loadMeasurment();
                    } else {
                        toastr.error(res.message);
                    }
                });
            }
        });
    }

    function loadMeasurment() {
        $.get("{{ url('/sub/measurment') }}", function(res){
            app.measurments = res;

            // reload calendar if change class type
            reload_calendar();
        });
    }

    $(document).ready(function(){ 
        formAjax(true, function(res){
            loadMeasurment();

            if (!app.measurment_resource.id)
                app.measurment_resource = {};
        }, '.measurment-form');

        loadMeasurment();
    });
</script>
