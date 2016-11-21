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
    $session = Session::getInstance();
    $uid = $session->userID;

    if( isset($_POST['name']) ){
        $name = htmlspecialchars($_POST['name']);
        if($name !== ''){
            $sql = "UPDATE `User Profile` SET `Name` = '$name' WHERE `ID`=$uid";
            if( $conn->query($sql) === TRUE ){
                   //echo "Record updated successfully";
            } else{
                   echo "Error: ". $conn->error;
            }
        }
    }
    if( isset($_POST['courseName']) ){
	//for passing course info to database and do the comparsion
	$nvals = count($_POST['courseName']);
	if( $nvals == count($_POST['courseNumber']) && $nvals == count($_POST['courseSection']) ){
		//for each course entered by the user
		for( $i = 0; $i < $nvals; $i++ ){
			$courseName = htmlspecialchars($_POST['courseName'][$i]);
			$courseNumber = htmlspecialchars($_POST['courseNumber'][$i]);
            		$courseSection = htmlspecialchars($_POST['courseSection'][$i]);
            		$sql = "SELECT `ID` FROM `course` WHERE dept='$courseName' AND courseID='$courseNumber' AND sectionID='$courseSection'";
			$result = $conn->query($sql);
            		while( $row = $result->fetch_assoc() ){
						$cid = $row['ID'];
            		}
           
            $sql = "SELECT `dept`, `courseID`, `sectionID`, `course_type`, `course_title`, `course_info`, `course_credit`, `course_location`, `course_term`, `course_schedule_term_row1`, `course_schedule_day_row1`, `course_schedule_day_start_row1`, `course_schedule_day_end_row1`, `course_schedule_building_row1`, `course_schedule_room_row1`, `course_schedule_term_row2`, `course_schedule_day_row2`, `course_schedule_day_start_row2`, `course_schedule_day_end_row2`, `course_schedule_building_row2`, `course_schedule_room_row2`, `course_instructors`, `course_book1`, `course_book2`, `course_book3` FROM `course` WHERE `ID`=$cid";
			$result = $conn->query($sql);
			while ( $row = $result->fetch_assoc() ) {
				$title = $row["dept"]." ".$row["courseID"]." ".$row["sectionID"];
				$info = 'Course: '.$title."<br>".$row["course_title"].'. '.$row["course_info"]."<br>".'Type: '.
						$row["course_type"]."<br>".'Credit: '.$row["course_credit"]."<br>".'Location: '.$row["course_location"].
						"<br>".'Course term: '.$row["course_term"]."<br>".'Instructors: '.$row["course_instructors"]."<br>".
						'Books info: '."<br>".$row["course_book1"]."<br>".$row["course_book2"]."<br>".$row["course_book3"]."<br>";
				$location1 = $row["course_schedule_building_row1"].' Room: '.$row["course_schedule_room_row1"];
				$location2 = $row["course_schedule_building_row2"].' Room: '.$row["course_schedule_room_row2"];
				
				$course_schedule_term_row1= $row["course_schedule_term_row1"];
				$course_schedule_day_row1= $row["course_schedule_day_row1"];
				$course_schedule_day_start_row1= $row["course_schedule_day_start_row1"];
				$course_schedule_day_end_row1= $row["course_schedule_day_end_row1"];
				$course_schedule_term_row2= $row["course_schedule_term_row2"];
				$course_schedule_day_row2= $row["course_schedule_day_row2"];
				$course_schedule_day_start_row2= $row["course_schedule_day_start_row2"];
				$course_schedule_day_end_row2= $row["course_schedule_day_end_row2"];
			}

			if( $course_schedule_day_row1 != NULL ){
				$date1 = explode(" ", $course_schedule_day_row1);
		
				foreach($date1 as $item){ 							//ampersand??
					//check exist
					$check = $conn->query("SELECT `ID` FROM `Unique Calendar Entry` WHERE `userID`=$uid and `Title`='$title' and `date`='$item' and `Location`='$location1'");
					if($check->num_rows == 0){//no exist
						$sql = "INSERT INTO `Unique Calendar Entry`(`Title`, `Location`, `Info`, `date`, `start`, `end`, `userID`, `courseID`) VALUES ('$title','$location1','$info','$item','$course_schedule_day_start_row1','$course_schedule_day_end_row1',$uid,$cid)";
					}
					else{//exist
						$sql="UPDATE `Unique Calendar Entry` SET `Title`='$title',`Location`='$location1',`Info`='$info',`date`='$item',`start`='$course_schedule_day_start_row1',`end`='$course_schedule_day_end_row1' WHERE `userID`=$uid and `Title`='$title' and `date`='$item' and `Location`='$location1'";
					}
					if ($conn->query($sql) != TRUE) {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			}
	
			if($course_schedule_day_row2!=NULL){
				$date2 = explode(" ", $course_schedule_day_row2);
		
				foreach($date2 as $item){
					//check exist
					$check = $conn->query("SELECT `ID` FROM `Unique Calendar Entry` WHERE `userID`=$uid and `Title`='$title' and `date`='$item' and `Location`='$location2'");
					if($check->num_rows == 0){//no exist
						$sql = "INSERT INTO `Unique Calendar Entry`(`Title`, `Location`, `Info`, `date`, `start`, `end`,`userID`) VALUES ('$title','$location2','$info','$item','$course_schedule_day_start_row2','$course_schedule_day_end_row2',$uid)";
					}
					else{//exist
						$sql="UPDATE `Unique Calendar Entry` SET `Title`='$title',`Location`='$location2',`Info`='$info',`date`='$item',`start`='$course_schedule_day_start_row2',`end`='$course_schedule_day_end_row2' WHERE `userID`=$userID and `Title`='$title' and `date`='$item' and `Location`='$location2'";
					}
					if ($conn->query($sql) != TRUE) {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			}
        	}
	}
    }
    //closing connection
    $conn->close();
    if( isset($_POST['redirect']) ){
			//header('Location: '.$_SERVER['REQUEST_URI']); 
            header('Location: '.$_SERVER['PHP_SELF']);
            //header("Location: courseRegister.php");
    }
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Change Account Info</title>
   <link rel="stylesheet" type="text/css" href="css/sidebar.css">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <!--<link rel="stylesheet" type="text/css" href="css/sidebar.css">-->
   <script type="text/javascript" src="jquery-1.3.1.js"></script>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 

<script>
     var _len = 0;
     $(document).ready(function(){
        //<tr/>middle
        $("#tab tr").attr("align","center");
        
        //increase<tr/>
        $("#but").click(function(){
            //var _len = $("#tab tr").length;        
	    $("#tab").append("<tr id="+_len+" align='center'>"
                                +"<td>"+_len+"</td>"
                                +"<td>Course"+_len+"</td>"
                                +"<td><input type='text' name='courseName["+_len+"]' id='courseName"+_len+"' /></td>"
 +"<td><input type='text' name='courseNumber["+_len+"]' id='courseNumber"+_len+"' /></td>" 
+"<td><input type='text' name='courseSection["+_len+"]' id='courseSection"+_len+"' /></td>" 
                               +"<td><a href=\'#\' onclick=\'deltr("+_len+")\'>DELETE</a></td>"
                            +"</tr>");            
            _len++;
	    console.log(_len);
	})    
    })
    
    //delete<tr/>
    var deltr =function(index)
    {
        //var _len = $("#tab tr").length;
        $("tr[id='"+index+"']").remove();//delete current row 
        for(var i=index+1,j=_len;i<j;i++)
        {
            var nextTxtVal = $("#desc"+i).val();
            $("tr[id=\'"+i+"\']")
                .replaceWith("<tr id="+(i-1)+" align='center'>"
                                +"<td>"+(i-1)+"</td>"
                                +"<td>Course "+(i-1)+"</td>"
                                +"<td><input type='text' name='desc"+(i-1)+"' value='"+nextTxtVal+"' id='desc"+(i-1)+"'/></td>"
                                +"<td><a href=\'#\' onclick=\'deltr("+(i-1)+")\'>DELETE</a></td>"
                            +"</tr>");
        }    
        _len--;
	console.log(_len);
    }

</script>

</head>
<body>
<?php
	include("infoFillIn.php");
	include("inc/sidebar.html");
?>
<script src="js/sidebar.js"></script>
    <form id="form1" method="post">
    
    <input type="hidden" name="redirect" value="mainPanel.php">
    <div style="text-align: center; margin: 100;">
    <h1 style="text-align:center;">MODIFY YOUR ACCOUNT AND COURSE INFORMATION</h1>
   
    <style>
    body{background-color:Azure}
    </style>
    <p>1. What's your name    
<!--create a gender chosen button--> 
    <input type="text" name="name"></p>
    <input id="man" type="radio" checked="checked" name="1"/>Male
    <input id="woman" type="radio"  name="1"/>Female 

<!--choose your the year you are in-->
    <p>2. What year are you in?</p>
    <input id="Year1" type="radio" checked="checked" name ="2"/>Year1
    <input id="Year2" type="radio"  name ="2"/>Year2
    <input id="Year3" type="radio"  name ="2"/>Year3
    <input id="Year4" type="radio"  name ="2"/>Year4
    <input id="Year5+" type="radio" name ="2"/>Year5+
<!--initialize a select bar for falculty-->
    <p>3. What's your faculty</p>
    <select id = "falculty-select">
    <option value ="Applied Science">Applied Science</option>
    <option value ="Architecture and Landscape Architecture, School of">Architecture and Landscape Architecture</option>
    <option value="Arts">Arts</option>
    <option value="Audiology and Speech Science">Audiology and Speech Sciences</option>
    <option value ="Business">Business</option>
    <option value ="Community and Regional Planning">Community and Regional Planning</option>
    <option value="Continuing Studies">Continuing Studies</option>
    <option value="Dentistry">Dentistry</option>
    <option value ="Education">Education</option>
    <option value ="Forestry">Forestry</option>
    <option value="Graduate and Postdoctoral Studies">Graduate and Postdoctoral Studies</option>
    <option value="Journalism">Journalism</option>
    <option value ="Kinesiology">Kinesiology</option>
    <option value ="Land and Food Systems">Land and Food Systems</option>
    <option value="Law, Peter A.">Law, Peter A.</option>
    <option value="Library, Archival and Information Studies">Library, Archival and Information Studies</option>
    <option value ="Medicine">Medicine</option>
    <option value ="Music">Music</option>
    <option value="Nursing">Nursing</option>
    <option value="Pharmaceutical Sciences">Pharmaceutical Sciences</option>
    <option value ="Population and Public Health">Population and Public Health</option>
    <option value ="Science">Science</option>
    <option value="Social Work">Social Work</option>
    <option value="UBC Vantage College">UBC Vantage College</option>
    <option value ="Vancouver School of Economics">Vancouver School of Economics</option>
</select>

<!--creat a table for entering course information-->
   <p>4. What courses are you taking?</p>
   <table id="tab" border="1" width="60%" align="center" style="margin-top:20px">
        <tr>
            <td width="20%">Number</td>
            <td>List</td>
            <td>Department</td>
            <td>Course Number</td>
            <td>Course Section</td>
            <td>Delete Course</td>
       </tr>
    </table>

    <div style="border:2px; 
                border-color:red; 
                margin-left:20%;
                margin-top:30px;
		text-align
              ">
    <input type="button" id="but" value="Add Course">
    </div>

<div style="text-align: center; margin: 100;">   
    <input type="submit" name="b1" value="submit">
</div>
</form>
</body>
</html>
