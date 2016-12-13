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
     var _col = _len + 1;
     $(document).ready(function(){
        //<tr/>middle
        $("#tab tr").attr("align","center");
		
        //increase<tr/>
        $("#but").click(function(){        
	    $("#tab").append("<tr id="+_len+" align='center'>"
                                +"<td>"+_col+"</td>"
                                +"<td>Course"+_col+"</td>"
                                +"<td><input type='text' name='courseName["+_len+"]' id='courseName"+_len+"' required /></td>"
 +"<td><input type='text' name='courseNumber["+_len+"]' id='courseNumber"+_len+"' required /></td>" 
+"<td><input type='text' name='courseSection["+_len+"]' id='courseSection"+_len+"' required /></td>" 
                               +"<td><a href=\'#\' onclick=\'deltr("+_len+")\'>DELETE</a></td>"
                            +"</tr>");            
        _len++;
        _col++;
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
                                +"<td>"+(i)+"</td>"
                                +"<td>Course "+(i)+"</td>"
                                +"<td><input type='text' name='desc"+(i-1)+"' value='"+nextTxtVal+"' id='desc"+(i-1)+"'/></td>"
                                +"<td><a href=\'#\' onclick=\'deltr("+(i-1)+")\'>DELETE</a></td>"
                            +"</tr>");
        }    
        _len--;
        _col--;
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
    
    <p>2. What's your e-mail?
<!--input your e-mail for daily reminders-->
	<input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>"></p>
	<p> Would you like to receive daily reminders about your schedule by e-mail?
	<input type="radio" name="remind" id="remindy" value="y" onclick="$('#email').attr('required', true);" <?php if($remind == 'y') echo 'checked="checked"'; ?> >Yes
	<input type="radio" name="remind" id="remindn" value="n" onclick="$('#email').removeAttr('required');" <?php if($remind == 'n') echo 'checked="checked"'; ?> >No
	</p>

<!--creat a table for entering course information-->
   <p>3. What courses are you taking?</p>
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
