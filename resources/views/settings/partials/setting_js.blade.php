
<!-- user scripts -->
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var users_table = $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/users', 
                    @include("layouts.partials.datatable_plugin")
                    "columns":[
                        {"data":"username"},
                        {"data":"full_name"},
                        {"data":"role"},
                        {"data":"email"},
                        {"data":"action"}
                    ]
                });
        $(document).on('click', 'button.delete_user_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_user,
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success == true){
                                toastr.success(result.msg);
                                users_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
             });
        });
        
    });
    
    
</script> 

<!-- roles scripts --> 
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var roles_table = $('#roles_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/roles', 
                    @include("layouts.partials.datatable_plugin")
                    columnDefs: [ {
                        "targets": 1,
                        "orderable": false,
                        "searchable": false
                    } ]
                });
        $(document).on('click', 'button.delete_role_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_role,
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();

                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success == true){
                                toastr.success(result.msg);
                                roles_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });
    });
</script> 

<!-- sales commission script --> 
<script>
    
    formAjax(false, function(){
        sales_commission_agent_table.ajax.reload();
    }, "#form_sale_commission_agent_form");

    // add button action
    $('.add_btn').click(function(){
        // reset form first
        $($(this).attr('data-container')).html($('.create_content').html());

        // show modal
        $($(this).attr('data-container')).modal('show');
    }); 

    //Sales commission agent
    var sales_commission_agent_table = $('#sales_commission_agent_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/sales-commission-agents', 
        @include("layouts.partials.datatable_plugin") 
        columns: [
            {
                data: 'full_name'
            },
            {
                data: 'email'
            },
            {
                data: 'contact_no'
            },
            {
                data: 'address'
            },
            {
                data: 'cmmsn_percent'
            },
            {
                data: 'action'
            },
        ],
    });
    $('div.commission_agent_modal').on('shown.bs.modal', function(e) {
                
        formAjax(false, function(){
            sales_commission_agent_table.ajax.reload();
        }, "#form_sale_commission_agent_form");
        
        $('form#sale_commission_agent_form')
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                submitHandler: function(form) {
                    e.preventDefault();
                    var data = $(form).serialize();

                    $.ajax({
                        method: $(form).attr('method'),
                        url: $(form).attr('action'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                $('div.commission_agent_modal').modal('hide');
                                toastr.success(result.msg);
                                sales_commission_agent_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                },
            });
    });
    $(document).on('click', 'button.delete_commsn_agnt_button', function() {
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
                            sales_commission_agent_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

    $('button#full_screen').click(function(e) {
        element = document.documentElement;
        if (screenfull.isEnabled) {
            screenfull.toggle(element);
        }
    });


</script>

<script type="text/javascript"> 
    $('table').css('width', '100%');
</script>


<script type="text/javascript">

    function loadSetting(url) {
        url += url.indexOf('?') >= 0? "&content_type=html" : "?content_type=html";
        $.get(url, function(res){
            var scriptLoaded = false;
            // remove old nodes
              
            $('.current-setting-element').remove();

            // receive html 
            var container = document.createElement('div');
            container.className = "current-setting-container";
 
            // reset submit form
            $(".current-setting-container form").each(function(){
                this.onsubmit = null;
            });
            $(".current-setting-container form").off();

            container.innerHTML = res;

            // replace add btn
            //$('#settingAddBtn')[0].className = $(container).find('.add_btn')[0].className;
            // $(container).find('.add_btn').addClass('hidden'); 

            // set class to every element in container
            $(container).children('*').addClass('current-setting-element');
            $(container).children('div').addClass('current-setting-element');
            $(".current-setting-container *").children('div').addClass('current-setting-element');
            $(".current-setting-container div").children('div').addClass('current-setting-element'); 
            $(container).find('div').addClass('current-setting-element');
            //$(container).find('.add_btn').parent().hide(); 
            
            // check if script loaded
            $(container).find("script").addClass('current-setting-script'); 
            $(container).find("script").attr('data-url', url); 
              

            // change title
            $('#settingModal').find('.modal-title').text($(container).find('.page-title').text());

            // set html content to modal
            $('#settingModal').find('.setting-content').html(container.innerHTML);

            // display modal
            $('#settingModal').modal('show');

            // edit data table
            editDatatable();

            // load form ajax
            formAjax(true);

            // activate Icheck 
            $('input[type=checkbox]').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            }); 
        });
    }

    function loadAddSetting(url) {
        url += url.indexOf('?') >= 0? "&content_type=html" : "?content_type=html";
        $.get(url, function(res){ 
            // remove old nodes
            $('.current-setting-element').remove();

            // receive html 
            var container = document.createElement('div');
            container.className = "current-setting-container";
 
            // reset submit form
            $(".current-setting-container form").each(function(){
                this.onsubmit = null;
            }); 

            container.innerHTML = res;

            // replace add btn
            //$('#settingAddBtn')[0].className = $(container).find('.add_btn')[0].className;
            // $(container).find('.add_btn').addClass('hidden'); 

            // set class to every element in container
            $(container).children('*').addClass('current-setting-element');
            $(container).children('div').addClass('current-setting-element');
            $(".setting-content *").children('div').addClass('current-setting-element');
            $(".setting-content div").children('div').addClass('current-setting-element'); 
            $(container).find('div').addClass('current-setting-element');
            $(container).find('.page-title').css('display', 'none');
             
            // check if script loaded 
            $(container).find("script").addClass('current-setting-script'); 
            $(container).find("script").attr('data-url', url);  

            // change title
            $('#settingModal').find('.modal-title').text($(container).find('.page-title').text());


            // set html content to modal
            $('#settingModal').find('.setting-content').html(container.innerHTML);

            // display modal
            //$('#settingModal').modal('show');

            // edit data table
            //editDatatable();

            // load form ajax
            //formAjax(true);

            // click on add btn
            $('#settingModal').find('.add_btn').click();
        });
    }

    function loadSettingWithoutPreview(url, action=null) {
        url += url.indexOf('?') >= 0? "&content_type=html" : "?content_type=html";
        $.get(url, function(res){
            // receive html 
            var container = document.createElement('div');

            // remove old nodes
            $('.current-setting-element').remove();

            container.innerHTML = res;

            // replace add btn
            //$('#settingAddBtn')[0].className = $(container).find('.add_btn')[0].className;
            // $(container).find('.add_btn').addClass('hidden'); 

            // set class to every element in container
            $(container).children('*').addClass('current-setting-element');
            $(container).children('div').addClass('current-setting-element');
            $(".current-setting-container *").children('div').addClass('current-setting-element');
            $(".current-setting-container div").children('div').addClass('current-setting-element'); 
            $(container).find('div').addClass('current-setting-element');
            $(container).find('.add_btn').parent().hide(); 
            
            // change title
            $('#settingModal').find('.modal-title').text($(container).find('.page-title').text());

            // set html content to modal
            $('#settingModal').find('.setting-content').html(container.innerHTML);

            // display modal
            //$('#settingModal').modal('show');

            // edit data table
            editDatatable();

            // load form ajax
            formAjax(true, null, ".fist-location-form", true);
            formAjax(true);

            // activate Icheck 
            $('input[type=checkbox]').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            }); 
            if (action) { 
                $(document).ready(function(){
                    action(res);
                });
            }
        });
    }

    $(document).ready(function(){
        $('#companyDetailLink').click();
        $('#user-page-tab').click();

        // load subscription content 
        $.get("{{ url('/subscription') }}", function(r){
            $('#tab_3').html(r);
        });

        // load subscription content 
        $.get("{{ url('/business/settings') }}", function(r){
            $('#tab_6').html(r);
            // load form ajax
            formAjax(true);
            //
            // edit data table
            editDatatable(); 

            // activate Icheck 
            $('input[type=checkbox]').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            }); 
            
            $('div.pos-tab-menu>div.list-group>a').click(function(e) {
                e.preventDefault();
                $(this)
                    .siblings('a.active')
                    .removeClass('active');
                $(this).addClass('active');
                var index = $(this).index();
                $('div.pos-tab>div.pos-tab-content').removeClass('active');
                $('div.pos-tab>div.pos-tab-content')
                    .eq(index)
                    .addClass('active');
            });
        });
    });

</script>

