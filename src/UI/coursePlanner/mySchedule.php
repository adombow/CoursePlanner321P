<html>
<head>
<meta charset="utf-8">

    <title>My Schedule</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="css/mainPanel.css">
    <link rel="stylesheet" type="text/css" href="css/schedule.css">
    
  
</head>
    <body>
    <?php 
        include("inc/sidebar.html");
    ?>
        <h1 style="text-align: center;">
            Welcome to Course Planner!
        </h1>

    
    <table id="data-table" align="center">
        <tr><td>There are no items...</td></tr>
    </table>


    <button type="button" id="updateScheduler">Update</button>
    
    <div id="view-edit-tile"><div>
</div>

    <script src="js/scheduler.js"></script>
    <script src="js/sidebar.js"></script>
</body>
</html>