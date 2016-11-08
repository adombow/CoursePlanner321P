<html>
<head>
<meta charset="utf-8">

	<title>Main Panel</title>
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
	<link rel="stylesheet" type="text/css" href="css/mainPanel.css">
	
  
</head>
	<body>
	<?php 
	require("database.php");
	require("session.php");
	include("inc/sidebar.html");
	?>
		<h1 style="text-align: center;">
			Welcome to Course Planner!
		</h1>
		<h2 style="text-align: center;">
			CPEN311 Team CP
		</h2>
		<div class="container">
   			<div class="column column-one column-offset-2">Diya Ren</div>
   			<div class="column column-two column-inset-1">Andrew Dombowsky</div>
   			<div class="column column-three column-offset-1">Chance Gao</div>
  			<div class="column column-four column-inset-2">Mengxi Zhang</div>
   			<div class="column column-five">Pitr Crandall</div>
		</div>
		<div class="container">
   			<div class="column column-one column-offset-2">CPEN</div>
   			<div class="column column-two column-inset-1">CPEN</div>
   			<div class="column column-three column-offset-1">CPEN</div>
  			<div class="column column-four column-inset-2">CPEN</div>
   			<div class="column column-five">CPEN</div>
		</div>
		<div class="container">
   			<div class="column column-one column-offset-2">
   				<img src="img/DiyaR.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
   			</div>
   			<div class="column column-two column-inset-1">
   				<img src="img/AndrewD.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
   			</div>
   			<div class="column column-three column-offset-1">
   				<img src="img/ChanceG.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
   			</div>
  			<div class="column column-four column-inset-2">
  				<img src="img/MengxiZ.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
  			</div>
   			<div class="column column-five">
   				<img src="img/PietrC.jpg" alt="Mountain View" style="max-width:100%;max-height:100%;">
   			</div>
		</div>

	</div>

	<?php
	$databaseName = 'courseplanner';
    	$serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com';
    	$userName = 'courseplanner';
    	$password = 'cpen3210';
        //Create a new database object and connect to it
        //$conn = new Mysql();
	$conn = new mysqli($servername, $username, $password, $databasename);
    	?>

        <!--DB connection error handling for debugging
            Should change to something more user friendly for final -->
        <?php //if( $conn -> getConnection() -> connection_error ): 
	      if( $conn -> connection_error ): ?>
            <h1 style="text-align: center;">
                Not connected to database.
            </h1>
        <?php else: ?>
            <h1 style="text-align: center;">
                Connected to database.
            </h1>
        <?php endif; ?>

        <?php
	//Create new session
	$session = Session::getInstance();

	//FB login token (should be unique for every user ----------- Add this once fb functionality finished
	$fbtoken = rand(0,18097);
	$session->loginToken = $fbtoken;	
	$UID = $session->loginToken; 

	//$session->db = $conn;
        ?>
	<h1 style="text-align: center;">
		<?php echo $UID; ?>
	</h1>

	<?php
	//$session->db->dbDisconnect();  	
	//$session->destroy(); 
        ?>

	<script src="js/sidebar.js"></script>

	<?php
	$conn->close();
	?>
</body>
</html>
