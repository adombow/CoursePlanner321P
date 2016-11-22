
<?php
    require("session.php");
    $serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com';
    $userName = 'courseplanner';
    $password = 'cpen3210';
    $databaseName = 'courseplanner';
    //Create a new database object and connect to it
    $conn = new mysqli($serverName, $userName, $password, $databaseName);
    if($conn->connect_error){
        die("Error: ". $conn->connect_error);
    }
    //Get current session
    require('session.php');
    $session = Session::getInstance();
    $uid = $session->userID;

$sql = "SELECT `Title`,`Info`,`Location`,`Date`, `Start`,`End` FROM `Unique Calendar Entry` WHERE `userID`= $uid AND `courseID` IS NULL";
$result = $conn->query($sql);

//creat an array
if($result->num_rows>0){

   

echo "<table>
      <tr>
      <th>TITLE</th>
      <th>INFO</th>
      <th>LOCATION</th>
      <th>DATE</th>
      <th>START</th>
      <th>END</th>
      </tr>";
while($row = $result->fetch_assoc()){
    
    echo"<tr>
         <td>".$row["Title"]."</td>
         <td>".$row["Info"]."</td>
         <td>".$row["Location"]."</td>
         <td>".$row["Date"]."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
         </tr>";
}

echo "</table>";
}
else{
    echo "YEAH!! No tasks today!!!";
}



$conn->close();

?>
