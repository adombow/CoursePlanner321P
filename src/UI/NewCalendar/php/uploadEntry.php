<?php
	// parameters set up
	$serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com'; //'localhost';//
	$userName = 'courseplanner'; //'root';//
	$password = 'cpen3210'; //'';//
	$databaseName = 'courseplanner';
	$table = 'Unique Calendar Entry';


	    $title = $_REQUEST["title"];
	    $date = $_REQUEST["date"];
	    $start = $_REQUEST["start"];
	    $end = $_REQUEST["end"];
	    $location = $_REQUEST["location"];
	    $info = $_REQUEST["info"];
	    $bg_color = $_REQUEST["bg_color"];
	    $text_color = $_REQUEST["text_color"];
	// get user ID
	//require('../session.php');
	//$session = Session::getInstance();
	$uid = 57;//$session->userID;


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
	/*$sql = "CREATE TABLE `$table` (
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
	}*/


	// **************************************************
	//
	//		check if tile exist in the database
	//
	// **************************************************
	// check
	$exist = 0;
	
	$sql = "SELECT * FROM `{$table}` WHERE `userID`={$uid} AND `Date`='{$date}' AND `Start`='{$start}' ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        
			if ($row["End"] == $end){
				$exist = 1;
				echo "Overwritting a time interval ... \n";
			}
	    }
	} else {
	    //echo "No tile existed in DB \n";
	}
	
	if ($exist === 0) {
		//echo "No same tile existed in DB \n";
	}

	// **************************************************
	//
	//		upload information of the tile
	//
	// **************************************************

	
	if ($exist == 1) {
		$sql = "UPDATE `{$table}` SET `Title`='{$title}', `Location`='{$location}', `Info`='{$info}', `BColour`='{$bg_color}', `TColour`='{$text_color}' WHERE `Date`='{$date}' AND `Start`='{$start}' AND `End`='{$end}' AND `userID`={$uid} ";
		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully \n";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	}
	else {
		
		$sql = "INSERT INTO `{$table}` (`userID`, `Title`, `Date`, `Start`, `End`, `Location`, `Info`, `BColour`, `TColour`) VALUES ('{$uid}', '{$title}', '{$date}', '{$start}', '{$end}', '{$location}', '{$info}', '{$bg_color}', '{$text_color}')";
		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully \n";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
?>







