// array thats going to be displayed on calendar
var display_events  = [
	{
        /*
		id : '5',
		title: 'msa,',
		start: '04-08-2016 16:45:00',
		end : '04-08-2016 17:30:00',
		backgroundColor: '#12CA6B',
		textColor : '#FFF'
        */
	}
		
];

// interface function to pass the array enevts
function getEvents(){
    console.log("----->> get Events: ");
	console.log(display_events);
	return display_events;
}


// interface to update the display
function rerender() {
	$('.mycal').remove();
    
    $( '#mycal-container' ).append( '<div class="mycal" style="width:100%;"></div>');

    $('.mycal').easycal({
        startDate : '01-08-2016', // OR 31/10/2104
        timeFormat : 'HH:mm',
        columnDateFormat : 'dddd', //, DD MMM',
        minTime : '06:00:00',
        maxTime : '24:00:00',
        slotDuration : 30,
        timeGranularity : 15,
        
        dayClick : function(el, startTime){
            console.log('Slot selected: ' + startTime);

        },
        eventClick : function(eventId){
            console.log('Event was clicked with id: ' + eventId);
            showInfoDialog(eventId);
        },

        events : getEvents(),
        
        overlapColor : '#FF0',
        overlapTextColor : '#000',
        overlapTitle : 'Multiple'
    });
    
}


