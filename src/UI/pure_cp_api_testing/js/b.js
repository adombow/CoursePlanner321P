var hi = function() {
    $(document).ready(function() {

    	$('#calendar').remove();
    
    	$( '#cal-container' ).append( '<div id="calendar"></div>');
        // page is ready
        $('#calendar').fullCalendar({
            // calendar properties
            // enable theme
            theme: true,
            // emphasizes business hours
            businessHours: true,
            // event dragging & resizing
            editable: true,
            // header
            header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
            },
            events: [
              // all day event
              {
                id     : '1',
                title  : 'Conference',
                start  : '2016-11-30',
                end    : '2016-12-02',
                allDay : true
              }
              // short term event 
              
            ],
            eventClick: function(event) {
              alert(event.id);
            }
        });
    });
}

var open = document.getElementById("button");
open.onclick = hi;