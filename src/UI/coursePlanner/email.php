<?php

$serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com';
$userName = 'courseplanner';
$password = 'cpen3210';
$databaseName = 'courseplanner';
//Create a new database object and connect to it
$conn = new mysqli($serverName, $userName, $password, $databaseName);
if($conn->connect_error){
	die("Error: ". $conn->connect_error);
}

//E-mail parameters
$subject = "Here's your CoursePlanner schedule for today!";
$header = 'From: <webmaster@courseplanner.de>' . 
			"\r\n". 'Reply-To: webmaster@courseplanner.de'.
			'X-Mailer: PHP/'. phpversion().
			"MIME-Version: 1.0\r\n".
			"Content-type: text/html;charset=UTF-8\r\n";

$sql = "SELECT `email`, `ID`, `Name` FROM `User Profile` WHERE `remind`='y'";
$result = $conn->query($sql);
while( $row = $result->fetch_assoc() ){
	$email = $row['email'];
	if($email != NULL){
		$to = $email;
		$uid = $row['ID'];
		$name = $row['Name'];
		//grab schedule info
		$message = "
			<html>
			<head>
			<title>HTML E-mail</title>
			</head>
			<body>
			<p>This e-mail is written with HTML, $name!</p>
			</body>
			</html>
		";
		$retval = mail($to,$subject,$message,$header);
		if( $retval == true )
			echo "Message sent\n";
		else
			echo "Message not sent\n";
	}
}
$conn->close();
