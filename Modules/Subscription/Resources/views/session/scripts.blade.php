<!-- user scripts -->
<script type="text/javascript">
    //Roles table 
    var sessionTable = {};
    if ($('#sessiontable').length > 0)
    sessionTable = $('#sessiontable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/sub/session',
        @include("layouts.partials.datatable_plugin")
        "columns": [{
                "data": "name"
            },
            {
                "data": "class_type_id"
            },
            {
                "data": "totals"
            },
            {
                "data": "trainer_id"
            },
            {
                "data": "date_from"
            },
            {
                "data": "date_to"
            }, 
            {
                "data": "group_number"
            },
            @can_bt(['customer_group'])
            {
                "data": "customer_group_id"
            },
            @endcan_bt
            {
                "data": "action"
            }
        ]
    });  
</script>

<script>
    function showTabSession(name) {
        $('.session-form-tab').hide();
        $('.tab-' + name).show();
    }

    function createSession() {
        showTabSession('session-info');
        app.session_resource = {};
        $('.session-modal').modal('show');
    }

    function showSession(id) {
        app.session_resource = {};

        $.get("{{ url('/sub/session/show/') }}/"+id, function(r){
            app.session_resource = r;
            $('.session-show-modal').modal('show');
        });
    }

    function editSession(resource) {
        console.log(resource);
        $(".session-form input[type=checkbox]").iCheck('uncheck');
        $(".session-form input[type=checkbox]").val(0);
        var checkInputs = [
            'sat', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri'
        ];

        app.session_resource = resource;
        
        for(var i = 0; i < checkInputs.length; i ++) { 
            if (app.session_resource[checkInputs[i]] == 1) {
                $(".session-form input[name="+checkInputs[i]+"]").attr("checked", "checked");
                $(".session-form input[name="+checkInputs[i]+"]").iCheck('check');
                $(".session-form input[name="+checkInputs[i]+"]").val('1');

                console.log($(".session-form input[name="+checkInputs[i]+"]"));
            }
        }
 
        $('.session-modal').modal('show');
    }
    
    function removeSession(id) {
        swal({
            title: '{{ __("warning") }}',
            text: '{{ __("are your sure") }}',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.post("{{ url('/sub/session/') }}/" + id, "", function(res){
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
            sessionTable.ajax.reload();


            if (!app.session_resource.id) {
                $(".session-form input[type=checkbox]").iCheck('uncheck');
                $(".session-form input[type=checkbox]").val(0);

                app.session_resource = {};
            }

            // reload calendar if change class type
            reload_calendar();
        }, ".session-form"); 
    });
</script>
