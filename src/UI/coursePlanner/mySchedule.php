<html>
<head>
<meta charset="utf-8">

    <title>My Schedule</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="css/mainPanel.css">
    <link rel="stylesheet" type="text/css" href="css/schedule.css">
    
  
</head>
    <body>
    <?php 
        include("inc/sidebar.html");
	    require("session.php");
    ?>
        <h1 style="text-align: center;">
            Plan your schedule
        </h1>

    
    <table id="data-table" align="center">
        <tr><td>There are no items...</td></tr>
    </table>

    <div style="text-align: center; margin: 60;">
        <button type="button" id="add-row">Add Row</button>
        <button type="button" id="add-rows">Add Rows</button>
        <button type="button" id="remove-last-row">Remove Last Row</button>
    </div>
    
    <div id="num-of-rows-to-add"></div>
    <div id="confirm-tile-remove"></div>
    <div id="confirm-row-remove"></div>
    <div id="view-edit-tile"></div>
    <div id="edit-tile"></div>

    <?php
        //Access the database connection created on login
	//$conn = $session->db;
        $serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com';
        $userName = 'courseplanner';
        $password = 'cpen3210';
		$databaseName = 'courseplanner';
        //Create a new database object and connect to it
        $conn = new mysqli($serverName, $userName, $password, $databaseName);
    ?>

        <!--DB connection error handling for debugging
            Should change to something more user friendly for final -->
        <?php 
	      if( $conn -> connect_error )
			echo $conn->connect_error;
        ?>

	<?php
        //Get the current session, if none exists already, make one
        $session = Session::getInstance();

        //Do some query to get uid from logintoken
        $UID = $session->userID;
     ?>

</div>

    <script src="js/scheduler.js"></script>
    <script src="js/sidebar.js"></script>

    <?php
    $conn->close();
    ?>
</body>
</html>
