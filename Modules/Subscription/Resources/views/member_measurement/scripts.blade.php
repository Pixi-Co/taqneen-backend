<!-- user scripts -->
<script type="text/javascript">
       
</script>

<script>
    function createMemberMeasurement(member_id) {

        app.member_measurement_resource = {}; 
        app.member_measurement_resource.member_id = member_id;
        $('.member_measurement-modal').modal('show');
    }

    function showMemberMeasurement(id) {
        app.member_measurement_resource = {};

        $.get("{{ url('/sub/member-measurement/show/') }}/"+id, function(r){
            app.member_measurement_resource = r;
            $('.member_measurement-show-modal').modal('show');
        });
    }

    function editMemberMeasurement(resource) { 
        app.member_measurement_resource = resource; 
        $('.member_measurement-modal').modal('show');
    }
    
    function removeMemberMeasurement(id) {
        swal({
            title: '{{ __("warning") }}',
            text: '{{ __("are your sure") }}',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.post("{{ url('/sub/member-measurement/') }}/" + id, "", function(res){
                    if (res.status == 1) {
                        toastr.success(res.message);
                        sessionTable.ajax.reload();
                    } else {
                        toastr.error(res.message);
                    }
                });
            }
        });
    }

    $(document).ready(function() { 
        formAjax(true, function(res) { 
            if (!app.member_measurement_resource.id) { 
                if (reset)
                    reset();
                else
                    app.member_measurement_resource = {};
            }

            // reload calendar if change class type
            reload_calendar();
        }, ".member_measurement-form"); 
    });
</script>
