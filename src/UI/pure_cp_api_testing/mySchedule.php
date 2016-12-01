<!DOCTYPE html>
<html>
    <head>
        <title>My Schedule</title>
        <meta charset='utf-8' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.css' />
        <link rel='stylesheet' href='css/jquery-ui.css' />
        <link rel='stylesheet' href='css/sidebar.css' />
        <link rel='stylesheet' href='css/page-footer.css' />

         <!-- Bootstrap -->
          <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
          
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
          <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
          
          <!--[if lt IE 9]>
          <script src = "https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src = "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
          

        <script src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.min.js'></script>




    </head>
    <body>
        <?php 
          include("inc/header-sidebar.html");
        ?>
            <div id='cal-container'><div id='calendar'></div></div>
        </div>

    <div><button id='button'>push me</button></div>
    <script type="text/javascript">
      $(document).ready(function() {
        // page is ready
        $('#calendar').fullCalendar({
            // calendar properties
            // enable theme
            theme: true,
            // emphasizes business hours
            businessHours: true,
            // event dragging & resizing
            editable: true,
            // header
            header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
            },
            events: [
              // all day event
              {
                id     : '1',
                title  : 'Conference',
                start  : '2016-11-30',
                end    : '2016-12-02',
                allDay : true
              },
              // short term event 
              {
                id     : '2',
                title  : 'Dentist',
                start  : '2016-11-30T11:30:00',
                end  : '2016-11-30T012:30:00',
                allDay : false,
                backgroundColor: 'green',
                textColor: 'black'
              }
            ],
            eventClick: function(event) {
              alert(event.id);
            }
        });

        // create footer
        var footer = document.createElement("div"); 
        var footer_text = document.createTextNode("CPEN Team Course Planner");
        footer.appendChild(footer_text);
        footer.id = "footer";
        document.body.appendChild(footer);

      });
    </script>
    <script type="text/javascript" src="js/sidebar.js"></script>
    <script src='js/b.js'></script>
  </body>
</html>