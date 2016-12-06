<?php
	require("acctInfo.php");
?>

<!DOCTYPE HTML>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Change Account Info</title>
   <!-- Bootstrap for page header-->
   <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
   <link rel="stylesheet" type="text/css" href="css/sidebar.css">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>
     var _len = 0;
     $(document).ready(function(){
        //<tr/>middle
        $("#tab tr").attr("align","center");
		
        //increase<tr/>
        $("#but").click(function(){        
	    $("#tab").append("<tr id="+_len+" align='center'>"
                                +"<td>"+_len+"</td>"
                                +"<td>Course"+_len+"</td>"
                                +"<td><input type='text' name='courseName["+_len+"]' id='courseName"+_len+"' required /></td>"
 +"<td><input type='text' name='courseNumber["+_len+"]' id='courseNumber"+_len+"' required /></td>" 
+"<td><input type='text' name='courseSection["+_len+"]' id='courseSection"+_len+"' required /></td>" 
                               +"<td><a href=\'#\' onclick=\'deltr("+_len+")\'>DELETE</a></td>"
                            +"</tr>");            
        _len++;
		console.log(_len);
		});    
    });
    
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
	include("inc/sidebar.html");
	include("infoFillIn.php");
?>
<script src="js/sidebar.js"></script>
    <form name="form1" id="form1" method="post">
    
    <input type="hidden" name="submitted" value="<?php echo 'refresh'; ?>">
    <div style="text-align: center; margin: 100;">
    <h1 style="text-align:center;">MODIFY YOUR ACCOUNT AND COURSE INFORMATION</h1>
   
    <style>
    body{background-color:Azure}
    </style>
    <p>1. What's your name?    
<!--create a gender chosen button--> 
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" ></p>
    <input id="man" type="radio" checked="checked" name="1"/>Male
    <input id="woman" type="radio"  name="1"/>Female 
    
    <p>2. What's your e-mail?
<!--input your e-mail for daily reminders-->
	<input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>"></p>
	<p> Would you like to receive daily reminders about your schedule by e-mail?
	<input type="radio" name="remind" id="remindy" value="y" onclick="$('#email').attr('required', true);" <?php if($remind == 'y') echo 'checked="checked"'; ?> >Yes
	<input type="radio" name="remind" id="remindn" value="n" onclick="$('#email').removeAttr('required');" <?php if($remind == 'n') echo 'checked="checked"'; ?> >No
	</p>

<!--choose your the year you are in-->
    <p>3. What year are you in?</p>
    <input id="Year1" type="radio" checked="checked" name ="2"/>Year1
    <input id="Year2" type="radio"  name ="2"/>Year2
    <input id="Year3" type="radio"  name ="2"/>Year3
    <input id="Year4" type="radio"  name ="2"/>Year4
    <input id="Year5+" type="radio" name ="2"/>Year5+
<!--initialize a select bar for falculty-->
    <p>4. What's your faculty</p>
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
   <p>5. What courses are you taking?</p>
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
