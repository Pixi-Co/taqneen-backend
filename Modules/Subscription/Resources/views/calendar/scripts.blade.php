<script type="text/javascript">
    var subcalendar = {};
    $(document).ready(function() {
        var events = [];
        $.each($("input[name='events']:checked"), function() {
            events.push($(this).val());
        });

        subcalendar = $('#calendarSub').fullCalendar({
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
                    is_football: '{{ request()->is_football == 1? "1" : "0" }}'
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
            @if (request()->is_football == 1)
            initialView: 'dayGridMonth',
            @endif 
            //editable: true,
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent, jsEvent, view);
                //window.location.href='/schedule/appointments/'+calEvent.id+'/detail';            
            }
        });
    });

    $(document).on('change', '#user_id, #location_id', function() {
        reload_calendar();
    });

    $(document).on('ifChanged', '.event_check', function() {
        reload_calendar();
    })

    function reload_calendar() {
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
        data.is_football = '{{ request()->is_football == 1? "1" : "0" }}';

        var events_source = {
            url: '/sub/calendar/get',
            type: 'get',
            data: data,
        }
        $('#calendarSub').fullCalendar('removeEventSource', events_source);
        $('#calendarSub').fullCalendar('addEventSource', events_source);
    }

</script>
