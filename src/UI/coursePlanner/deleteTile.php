<?php
	// parameters set up
	$serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com';
    	$userName = 'courseplanner';
    	$password = 'cpen3210';
    	$databaseName = 'courseplanner';
	$table = "Unique Calendar Entry";

	//Get parameters from url
	$x = $_REQUEST['x'];
	$y = $_REQUEST['y'];

	// get user ID
	require('../session.php');
	$session = Session::getInstance();
	$uid = $session->userID;


	// **************************************************
	//
	//		Database connecting
	//
	// **************************************************

	// Create connection
	$conn = new mysqli($serverName, $userName, $password, $databaseName);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully \n";

	// **************************************************
	//
	//		check if tile exist in the database
	//
	// **************************************************
	// check
	$exist = 0;
	$sql = "SELECT `ID`, `x`, `y` FROM `$table` WHERE `userID`=$uid";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        //echo "title: " . $row["title"]. " - Time: " . $row["time"]. " " . $row["location"]. "<br>";
			if ($row["x"] == $x && $row["y"] == $y){
				$exist = 1;
				$tid = $row["ID"];
				echo "This tile exists in DB \n";
			}
	    }
	} else {
	    echo "No tile existed in DB \n";
	}
	
	if ($exist == 0) {
		echo "This tile does not exist in DB \n";
	}
	
	// **************************************************
	//
	//		upload information of the tile
	//
	// **************************************************
	if ($exist == 1) {
		$sql = "DELETE FROM `$table` WHERE `ID`=$tid";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully \n";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}
	$conn->close();
?>







