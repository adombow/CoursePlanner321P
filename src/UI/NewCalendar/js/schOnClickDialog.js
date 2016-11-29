
// display the db entry info when click on corresponding tile
var showInfoDialog = function(id) {
	// find the entry with the id 
	// and set variable
	var dialog_index = -1;
	var target;
	for (var i=0; i<dbEntries.length; i++) {
		if (dbEntries[i][db_key_id] == id) {
			var dialog_index = i;
			target = dbEntries[i];
			break;
		}
	}

	if (dialog_index == -1) {
		alert("[ERROR]Unexpected Entry ID ...")
		return;
	}

	// display all info on a new dialog
	$( "#onclick-dialog" ).dialog({
        title: target[db_key_title],
        modal: true,
        buttons: {
        	'Edit' : function () {
        		editTask(target);
        	},
            'Delte' : function () {
            	confirm_delete(id);
            },
            'OK': function () {
           		$(this).dialog('close');
           
            }
        }
        
    });
	// write in the info
    document.getElementById("onclick-dialog").innerHTML = 'Time: ' + dbEntries[i][db_key_start] + '-' + dbEntries[i][db_key_end] + '<br>Location: ' + dbEntries[i][db_key_location] + '<br>' + dbEntries[i][db_key_info];

}







