<script type="text/javascript">
    var footsubcalendar = {};
    $(document).ready(function() {
        var events = [];
        $.each($("input[name='events']:checked"), function() {
            events.push($(this).val());
        });

        footsubcalendar = $('#footballcalendarSub').fullCalendar({
            header: {
                left: 'prev,next,today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            contentHeight: 'auto',
            eventLimit: 2,
            eventSources: [{
                url: '/sub/calendar/get',
                type: 'get',
                data: {
                    events: events,
                    is_football: 1
                } 
            }],
            eventRender: function(event, element) {
                if (event.title_html) {
                    element.find('.fc-title').html(event.title_html);
                }
                if (event.event_url) {
                    element.attr('href', event.event_url);
                }
            },  
            initialView: 'dayGridMonth', 
            //editable: true,
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent, jsEvent, view);
                //window.location.href='/schedule/appointments/'+calEvent.id+'/detail';            
            }
        });
        
        setTimeout(function(){
            $('.fc-agendaWeek-button').click();
        }, 2000);
    });

    $(document).on('change', '#user_id, #location_id', function() {
        reload_calendarFoot();
    });

    $(document).on('ifChanged', '.event_check', function() {
        reload_calendarFoot();
    })

    function reload_calendarFoot() {
        data = [];
        if ($('select#location_id').length) {
            data.location_id = $('select#location_id').val();
        }
        if ($('select#user_id').length) {
            data.user_id = $('select#user_id').val();
        }

        data.session_id = $('#session_id').val();
        data.trainer_id = $('#trainer_id').val();

        var events = [];
        $.each($("input[name='events']:checked"), function() {
            if ($(this).iCheck('check'))
                events.push($(this).data('id'));
        });

        data.events = events; 
        data.is_football = 1;

        var events_source = {
            url: '/sub/calendar/get',
            type: 'get',
            data: data,
        }
        $('#footballcalendarSub').fullCalendar('removeEventSource', events_source);
        $('#footballcalendarSub').fullCalendar('addEventSource', events_source);

        setTimeout(function(){
            $('.fc-agendaWeek-button').click();
        }, 2000);
    }

    function selectTimeFromCalendar(date, time, end) {
        app.football_order_resource.date = date;
        app.football_order_resource.start_time = time;
        app.football_order_resource.end_time = end;

        $('.start_time').val(time); 
        $('.end_time').val(end); 
        $('.end_time').attr('min', end); 
        $('.date').val(date);


        console.log(date, time);
        $('.football-order-modal').modal('show');  
    }

</script>
