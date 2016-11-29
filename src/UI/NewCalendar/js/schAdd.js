// functions of adding a task or class

var invalidTime = function(start_time, end_time){
    if (start_time === end_time) return true;
    var new_start_time = parseInt(start_time.replace(":",""));
    var new_end_time = parseInt(end_time.replace(":",""));
    if(new_start_time <= new_end_time) return true;
    else return false;
}

var addTask = function() {
    //write content
    $("#new-task").show();
    $( "#new-task" ).dialog({
        title: "New Task",
        modal: true,
        width: 400,
        buttons: {
            'Create Task!': function () {
            	var bg = document.getElementById("bg-color-dropdown-menu");
				var t = document.getElementById("text-color-dropdown-menu");
                var d = document.getElementById("date-dropdown-menu");
                var s = document.getElementById("start-time-dropdown-menu");
                var e = document.getElementById("end-time-dropdown-menu");
                var target = {
                	title: $('input[name="title"]').val(),
                	date: d.options[d.selectedIndex].value,
                	start: s.options[s.selectedIndex].value,
                	end: e.options[e.selectedIndex].value,
                	location: $('input[name="title"]').val(),
                	info: $('input[name="info"]').val(),
                	bgC: bg.options[bg.selectedIndex].value,
                	textC: t.options[t.selectedIndex].value
                };

                if (!invalidTime(s.options[s.selectedIndex].value, e.options[e.selectedIndex].value)) {
                    alert("Start time must be earlier than end time.");
                } else {
                    console.log("Adding new task ...");
                    console.log(target);

                    $.ajax({
                        type: "POST",
                        url: 'php/uploadEntry.php',
                        data: {title: target["title"], date: target["date"], start: target["start"], end: target["end"], location: target["location"], info: target["info"], bg_color: target["bgC"], text_color: target["textC"]},
                        success: function(data){
                           alert(data);
                           location.reload();
                        },
                        error : function() {        
                            alert("Exception from uploadEntry.php");    
                        }    
                    });
                

                    $(this).dialog('close');
                }

                
            },
            'Cancel': function () {
                $(this).dialog('close');

            }
        }
    });

}





var button_add_task = document.getElementById("add-task");
button_add_task.onclick = addTask;