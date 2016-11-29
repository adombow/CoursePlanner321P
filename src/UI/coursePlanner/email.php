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
$header = 'From: <no-reply@courseplanner.de>' . 
			"\r\n". 'X-Mailer: PHP/'. phpversion().
			"MIME-Version: 1.0\r\n".
			"Content-type: text/html;charset=UTF-8\r\n";

$sql = "SELECT `email`, `ID`, `Name` FROM `User Profile` WHERE `remind`='y'";
$result = $conn->query($sql);
while( $row = $result->fetch_assoc() ){
	$email = $row['email'];
	if($email != NULL){
		$to = $email;
		$uid = $row['ID'];
		list($first, $last) = explode( " ", $row['Name'] );
		//grab schedule info ordered by their time, ascending by default
		//i.e. earliest to latest
		$sql = "SELECT `title` `info` etc. FROM `Unique Calendar Entry` 
				WHERE `userID`=$uid AND `date`=$date ORDER BY `time`";
		$tasks = $conn->query($sql);
		if( $tasks->num_rows > 0 ){
			$title = array();
			$info = array();
			etc.
			while( $tasksRow = $tasks->fetch_assoc() ){
				$title[] = $tasksRow['title'];
				$info[] = $tasksRow['info'];
				etc.
			}
			$message = "
				<html>
				<head>
					<title>HTML E-mail</title>
				</head>
				<body>
					<p>Hey $first, here's your schedule for the day!</p>
					<table width=\"600\" style=\"border:1px solid #333\">
					<tr>
						<td align=\"center\">head</td>
					</tr>
					<Tr>
					<td align=\"center\">body 
					<table align=\"center\" width=\"300\" border=\"0\" 
								 cellspacing=\"0\" cellpadding=\"0\" 
								 style=\"border:1px solid #ccc;\">
					<tr>";
			for( $i = 0, $size = count($title); $i < $size; $i++ ){
				$message .= "<td> $title[$i] </td>";
				$message .= "<td> $info[$i] </td>";
				etc.
			}
			$message .= "
					</tr>
					</table></td>
					</tr>
					</table>
				</body>
				</html>";
			$retval = mail($to,$subject,$message,$header);
			if( $retval == true )
				echo "Message sent\n";
			else
				echo "Message not sent\n";
		}
	}
}
$conn->close();
