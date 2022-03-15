<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- feather icon js-->
<script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- scrollbar js-->
<script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('assets/js/config.js') }}"></script>


<script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
<!-- Plugins JS start-->
<script id="menu" src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script id="menu" src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
@yield('script')

@if (Route::current()->getName() != 'popover')
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endif

<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('js/formajax.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script>


<script>
    $(document).ready(function() {
        setActiveForSidebarList();

        // 
        $('.select2').select2();
    });

    function message(message) {
        var msg = '<i class="fa fa-bell-o"></i><strong></strong> ' + message;
        var notify = $.notify(msg, {
            type: 'theme',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: true,
            timer: 300,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            }
        });
    }

    function setActiveForSidebarList() {
        $('.sidebar-link').click();
        var link = window.location.href
            .replace(window.location.origin, '')
            .replace('#', '')
            .replace('/', '');

        if (link == '')
            link = "home";

        $('.sidebar-list').each(function() {
            var currentLink = $(this).find('a').attr('href')
                .replace(window.location.origin, '')
                .replace('#', '')
                .replace('/', '');

            if (currentLink == link) {
                $(this).addClass('active');
                console.log($(this).parent().parent());

                if ($(this).parent().parent()[0].className.indexOf('sidebar-submenu') >= 0) {
                    $(this).parent().parent().find('.sidebar-link').click();
                }
            }
        });
    }

    function destroy(link) {
        swal({
                title: "@trans('Are you sure?')",
                text: "@trans('Once deleted, you will not be able to recover this imaginary file!')",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var data = {
                        _token: '{{ csrf_token() }}',
                        method: 'DELETE',
                        _method: 'DELETE',
                    };
                    $.post(link, $.param(data), function(res) {
                        message(res.msg);
                        if (res.success == 1) {
                            window.location.reload();
                        }
                    });
                } else {
                    // nothing
                }
            })
    }

    function initDateRanger() {
        $('.dateranger').each(function(){
            var self = this;
            $(this).daterangepicker({
                opens: 'left',
                ranges: {
                    "Today": [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
                        .subtract(1, 'month').endOf('month')
                    ]
                }
            }, function(start, end, label) {
                var start_date = start.format('YYYY-MM-DD');
                var end_date = end.format('YYYY-MM-DD');
                
                $(self).attr('data-start', start_date);
                $(self).attr('data-end', end_date);
            });
        }); 
    }

    @if (session('status'))
        @if (session('status')['success'] == 1)
            var message = '<i class="fa fa-bell-o"></i><strong>success</strong> {{ session('status')['msg'] }}';
            var notify = $.notify(message, {
            type: 'theme',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: true,
            timer: 300,
            animate:{
            enter:'animated fadeInDown',
            exit:'animated fadeOutUp'
            }
            });
        @else
            var message = '<i class="fa fa-bell-o"></i><strong>error</strong> {{ session('status')['msg'] }}';
            var notify = $.notify(message, {
            type: 'theme',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: true,
            timer: 300,
            animate:{
            enter:'animated fadeInDown',
            exit:'animated fadeOutUp'
            }
            });
        @endif
    @endif


    var toastr = {
        success: message,
        error: message
    };
    
    //setActiveForSidebarList();
</script>
