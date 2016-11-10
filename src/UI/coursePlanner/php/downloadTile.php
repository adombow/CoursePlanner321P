<?php
	// parameters set up
	$serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com';
    $userName = 'courseplanner';
    $password = 'cpen3210';
    $databaseName = 'courseplanner';
	$table = "Unique Calendar Entry";

	$x = $_POST["x"];
	$y = $_POST["y"];
	
	// get user ID
	require(session.php);
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


	

	
	// **************************************************
	//
	//		Getting data from database
	//
	// **************************************************
	$sql = "SELECT `userID`, `Title`, `Time`, `Location`, `info`, `x`, `y` FROM `$table`";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        //only return the expected one
			if ($row["x"] == $x && $row["y"] == $y && $row["ID"] == $uid){
				unset($row["ID"]);
				echo json_encode($row);
				break;
			}
			
	    }
	} else {
	    echo "[Pulling Failed]: No such a tile in database ...\n";
	}




	
	$conn->close();
?>







