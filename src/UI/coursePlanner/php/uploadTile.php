<?php
	// parameters set up
	$serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com';
    	$userName = 'courseplanner';
    	$password = 'cpen3210';
    	$databaseName = 'courseplanner';
	$table = "Unique Calendar Entry";

	//Get parameters from url
	
	    $title = $_POST['title'];
	    $x = $_POST['x'];
	    $y = $_POST['y'];
	    $time = $_POST['time'];
	    $location = $_POST['location'];
	    $infor = $_POST['infor'];
	
	// get user ID
	//require(session.php);
	//$session = Session::getInstance();
	$uid = 12;//$session->userID;


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


	

	//id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	// sql to create table
	$sql = "CREATE TABLE `$table` (
		userID INT(6) UNSIGNED, 
		Title VARCHAR(30),
		Time VARCHAR(50),
		Location VARCHAR(50),
		Info VARCHAR(50),
		x INT(6) UNSIGNED,
		y INT(6) UNSIGNED
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table ScheduleTile created successfully \n";
	} else {
	    echo "Fail to create table: " . $conn->error + "\n";
	}


	// **************************************************
	//
	//		check if tile exist in the database
	//
	// **************************************************
	// check
	$exist = 0;
	$sql = "SELECT `userID`, `x`, `y` FROM `$table` ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        
			if ($row["x"] == $x && $row["y"] == $y && $row["userID"] == $uid){
				$exist = 1;
				echo "This tile exists in DB \n";
			}
	    }
	} else {
	    echo "No tile existed in DB \n";
	}
	
	if ($exist === 0) {
		echo "No same tile existed in DB \n";
	}

	// **************************************************
	//
	//		upload information of the tile
	//
	// **************************************************

	
	if ($exist == 1) {
		$sql = "UPDATE `$table` SET `Title`='$title', `Time`='$time', `Location`='$location', `Info='$infor' WHERE `x`=$x AND `y`=$y AND `userID`=$uid ";

		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully \n";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	}
	else {
		
		$sql = "INSERT INTO `$table` (`userID`, `Title`, `x`, `y`, `Time`, `Location`, `Info`) VALUES ($uid, '$title', $x, $y, '$time', '$location', '$infor')";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully \n";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	

	$conn->close();
?>







