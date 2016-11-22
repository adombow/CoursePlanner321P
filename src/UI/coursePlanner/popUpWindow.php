<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Pop Up</title>

</head>
    <body>
<script type="text/javascript" align="center">
// Popup window code
//function newPopup(url) {

  //  popupWindow = window.open(
  //      url,'popUpWindow','height=300,width=400,left=300,top=200,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
//}

 var _open = window.open(initialReminder.php, 'height=300','width=400','left=300','top=200','resizable=yes','scrollbars=yes','toolbar=yes','menubar=no','location=no','directories=no','status=yes')
  if (_open == null || typeof(_open)=='undefined')
    alert("Turn off your pop-up blocker!");
  
</script>


<!--<p align="right"><a href="JavaScript:newPopup('initialReminder.php');">Check Your Tasks</a></p>
 -->   <p align="right"><a href="initialReminder.php">Check Your Tasks</a></p>

   
</body>
</html>
