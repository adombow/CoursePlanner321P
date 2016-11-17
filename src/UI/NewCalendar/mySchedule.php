<!DOCTYPE html>
<html>
<head>
	<title>My Schedule</title>
	
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
	
	<link rel="stylesheet" type="text/css" href="css/scheduleTable.css">

	
</head>
<body>
	<?php 
    	include("inc/sidebar.html");
	?>
		<h1 style="text-align: center;">
			Schedule your schedule
		</h1>
	

	<div id="mycal-container"><div class="mycal" style="width:100%;"></div></div>
	<div style="text-align: center; margin: 30px;">
	    <button type="button" id="edit-schedule" style="font-size: 24px">Edit Schedule</button>
	    
	</div>

	</div>



	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
	<script type="text/javascript" src="js/schPlugin.js"></script>
	<script type="text/javascript" src="js/schParameters.js"></script>
	<script type="text/javascript" src="js/schPluginInterface.js"></script>
	<script type="text/javascript" src="js/schLoadAndDisplay.js"></script>
	<script type="text/javascript" src="js/sidebar.js"></script>
	<script type="text/javascript">
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
            },

            events : getEvents(),
            
            overlapColor : '#FF0',
            overlapTextColor : '#000',
            overlapTitle : 'Multiple'
        });
	</script>

	
	
</body>
</html>