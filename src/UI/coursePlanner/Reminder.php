
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
    //Get current session
   // require('session.php');
   // $session = Session::getInstance();
    $uid = 81;

$sql = "SELECT `reminder`,`Start_Date`,`End_Date`,`Title`,`Info`,`Location`,`Date`, `Start`,`End` FROM `Unique Calendar Entry` WHERE `userID`= $uid AND `courseID` IS NULL";
$result = $conn->query($sql);
date_default_timezone_set('America/Vancouver');
$date_array = getdate();

// foreach ( $date_array as $key => $val ){
  //   print "$key = $val<br />";
   //}
    $formated_date = '';
    $formated_date .= $date_array['year'] ."/";
    if( strlen($date_array['mon'])<2){
    $formated_date .= "0".$date_array['mon'] ."/";
  } else {
     $formated_date .= $date_array['mon'] ."/";
  }
   if( strlen($date_array['mday'])<2){
    $formated_date .= "0".$date_array['mday'];
  }else{
    $formated_date .= $date_array['mday'];
  }

    //  echo $formated_date;



//for set up abbreviation weekday
switch ($date_array['weekday']){
case "Monday":
      $abbrDate = 'Mon';
      $abbrNum  = 1;
      break;
case "Tuesday":
      $abbrDate = 'Tue';
      $abbrNum  = 2;
      break;
case "Wednesday":
      $abbrDate = 'Wed';
      $abbrNum  = 3;
      break;      
case "Thursday":
      $abbrDate = 'Thu';
      $abbrNum  = 4;
      break;
case "Friday":
      $abbrDate = 'Fri';
      $abbrNum  = 5;
      break;
case "Saturday":
      $abbrDate = 'Sat';
      $abbrNum  = 6;
      break;
case "Sunday":
      $abbrDate = 'Sun';
      $abbrNum  = 7;
      break;
    
}

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

if($row["reminder"]==0){
if($row["End_Date"]==NULL){
  if($row["Start_Date"]==$formated_date){

    echo"<tr>
         <td>".$row["Title"]."</td>
         <td>".$row["Info"]."</td>
         <td>".$row["Location"]."</td>
         <td>".$row["Date"]."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
         </tr>";
  }
} else if($row["End_Date"]!=NULL){
  if(($row["Start_Date"]<=$formated_date)&&($formated_date<=$row["End_Date"])){
    if($row["Date"]==$abbrDate){
    echo"<tr>
         <td>".$row["Title"]."</td>
         <td>".$row["Info"]."</td>
         <td>".$row["Location"]."</td>
         <td>".$row["Date"]."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
         </tr>";
    }
      
 

     }
   }
  

} else if($row["reminder"]!=0){
if($row["End_Date"]==NULL){
  if(date("Y/m/d",time(time($row["Start_Date"])-$row['reminder']*86400))==$formated_date){
    echo"<tr>
         <td>".$row["Title"]."</td>
         <td>".$row["Info"]."</td>
         <td>".$row["Location"]."</td>
         <td>".$row["Date"]."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
         </tr>";
  }
} else if($row["End_Date"]!=NULL){
  if(($row["Start_Date"]<=$formated_date)&&($formated_date<=$row["End_Date"])){

    switch ($row["Date"]){
      case "Mon":
      if($row["reminder"]==1){
         $remindemME = "Sun";
      }else if($row["reminder"]==2){
         $remindemME = "Sat";
      }else if($row["reminder"]==3){
         $remindemME = "Fri";
      }else if($row["reminder"]==4){
         $remindemME = "Thu";
      }else if($row["reminder"]==5){
         $remindemME = "Wed";
      }

      break; 
      
      case "Tue":
       if($row["reminder"]==1){
         $remindemME = "Mon";
      }else if($row["reminder"]==2){
         $remindemME = "Sun";
      }else if($row["reminder"]==3){
         $remindemME = "Sat";
      }else if($row["reminder"]==4){
         $remindemME = "Fri";
      }else if($row["reminder"]==5){
         $remindemME = "Thu";
      }
      break;
      
      case "Wed":
      if($row["reminder"]==1){
         $remindemME = "Tue";
      }else if($row["reminder"]==2){
         $remindemME = "Mon";
      }else if($row["reminder"]==3){
         $remindemME = "Sun";
      }else if($row["reminder"]==4){
         $remindemME = "Sat";
      }else if($row["reminder"]==5){
         $remindemME = "Fri";
      }
      break; 
      
      case "Thu":
      if($row["reminder"]==1){
         $remindemME = "Wed";
      }else if($row["reminder"]==2){
         $remindemME = "Tue";
      }else if($row["reminder"]==3){
         $remindemME = "Mon";
      }else if($row["reminder"]==4){
         $remindemME = "Sun";
      }else if($row["reminder"]==5){
         $remindemME = "Sat";
      }
      break;
      case "Fri":
      if($row["reminder"]==1){
         $remindemME = "Thu";
      }else if($row["reminder"]==2){
         $remindemME = "Wed";
      }else if($row["reminder"]==3){
         $remindemME = "Tue";
      }else if($row["reminder"]==4){
         $remindemME = "Mon";
      }else if($row["reminder"]==5){
         $remindemME = "Sun";
      }
      break; 
     
      case "Sat":
      if($row["reminder"]==1){
         $remindemME = "Fri";
      }else if($row["reminder"]==2){
         $remindemME = "Thu";
      }else if($row["reminder"]==3){
         $remindemME = "Wed";
      }else if($row["reminder"]==4){
         $remindemME = "Tue";
      }else if($row["reminder"]==5){
         $remindemME = "Mon";
      }
      break;
      
      case "Sun":
      if($row["reminder"]==1){
         $remindemME = "Sat";
      }else if($row["reminder"]==2){
         $remindemME = "Fri";
      }else if($row["reminder"]==3){
         $remindemME = "Thu";
      }else if($row["reminder"]==4){
         $remindemME = "Wed";
      }else if($row["reminder"]==5){
         $remindemME = "Tue";
      }
      break; 
      
    }
    if($remindemME==$abbrDate){
       echo"<tr>
         <td>".$row["Title"]."</td>
         <td>".$row["Info"]."</td>
         <td>".$row["Location"]."</td>
         <td>".$row["Date"]."</td>
         <td>".$row["Start"]."</td>
         <td>".$row["End"]."</td>
         </tr>";
    }

      
 

     }
  }


}
}


echo "</table>";
}
else{
    echo "YEAH!! No tasks today!!!";
}



$conn->close();

?>
