<!DOCTYPE html>
<html>
<head>
	<title>My Schedule</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
	
	<link rel="stylesheet" type="text/css" href="css/scheduleTable.css">

	<style>
		#mycal-container{ width: 820px; margin: 0 auto; font-size: 16px; font-family: Arial; box-sizing: border-box;}

	</style>
</head>
<body>
	<?php 
    	include("inc/sidebar.html");
	?>
		<h1 style="text-align: center;">
			Schedule your schedule
		</h1>
	
		<div>
			<div id="onclick-dialog"></div>
			<div id="confirm-delete"></div>
			<div id="new-task"></div>
		</div>
		
		<div style="text-align: center; margin: 30px;">
		    <button type="button" id="add-task" style="font-size: 24px">Edit Calendar</button>
		    
		</div>
		
		<div id="mycal-container"><div class="mycal" style="text-align: center;">Loading ...</div></div>

		

	</div>



	




    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="js/schPlugin.js"></script>
	<script type="text/javascript" src="js/schDelete.js"></script>
	<script type="text/javascript" src="js/schAdd.js"></script>
	<script type="text/javascript" src="js/schEdit.js"></script>
	<script type="text/javascript" src="js/schParameters.js"></script>
	<script type="text/javascript" src="js/schPluginInterface.js"></script>
	<script type="text/javascript" src="js/schLoadAndDisplay.js"></script>
	<script type="text/javascript" src="js/schOnClickDialog.js"></script>
	<script type="text/javascript" src="js/sidebar.js"></script>

    <?php
    //$conn->close();
    ?>
</body>
</html>
