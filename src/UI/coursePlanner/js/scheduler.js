//Data field
var mon0 = jQuery.parseJSON('{"title": "Math", "time": "8am-9am", "location": "building-room", "infor": "some infor"}');
var tue0 = jQuery.parseJSON('{"title": "English", "time": "8am-9am", "location": "building-room", "infor": "some infor"}');
var wed0 = jQuery.parseJSON('{"title": "", "time": "8am-9am", "location": "building-room", "infor": "some infor"}');
var thu0 = jQuery.parseJSON('{"title": "Physics", "time": "8am-9am", "location": "building-room", "infor": "some infor"}');
var fri0 = jQuery.parseJSON('{"title": "", "time": "8am-9am", "location": "building-room", "infor": "some infor"}');
var sat0 = jQuery.parseJSON('{"title": "Music!!!", "time": "8am-9am", "location": "building-room", "infor": "some infor"}');
var sun0 = jQuery.parseJSON('{"title": "Badminton", "time": "8am-9am", "location": "building-room", "infor": "some infor"}');

var row0 = ["Monday", "Tuesday", "Wednesday", "Tuesday", "Friday", "Saturday", "Sunday"];
var row1 = [ mon0, tue0, wed0, thu0, fri0, sat0, sun0];

var table = [row0, row1];



//function to load data
var loadTable = function(tableId, data) {
    var rows = '';

    // load the first row
    var row = '<tr>';
    for (var i=0; i<7; i++) {
        row += '<td>' + data[0][i] + '</td>';
    }
    rows += row + '<tr>';

    // load the other rows
    for (var i=1; i<data.length; i++) {
        var row = '<tr>';
        for (var j=0; j<data[i].length; j++) {
            var temp = data[i][j];
            row += '<td onclick="dialogInfor(' + i + ',' + j + ')">' + temp["title"] + '</td>';
        }
        rows += row + '<tr>';
    }
    
    // load all the rows to DOM
    $('#' + tableId).html(rows);
}

//show infor
var dialogInfor = function(i,j) {
    //store information to the dialogbox
    $( "#view-edit-tile" ).data("dialog_title", table[i][j]);

    //write content
    document.getElementById("view-edit-tile").innerHTML = 'Time: ' + table[i][j]["time"] + '<br>' +
                                                            'Location: ' + table[i][j]["location"] + '<br>' +
                                                            table[i][j]["infor"];
    //open the dialog box
    $( "#view-edit-tile" ).dialog({
        title: $("#view-edit-tile").data('dialog_title')["title"],
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,

        buttons: {
            "Edit": function() {
                edit($("#view-edit-tile").data('dialog_title'), "SLEEEEEEEP", "8am-8pm","","lololololol");
                $( this ).dialog( "close" );
            },
            "Remove": function() {
                remove($("#view-edit-tile").data('dialog_title'));
                $( this ).dialog( "close" );
            },
            Ok: function() {
                $( this ).dialog( "close" );
            }
        }
    });

    
}

var edit = function(target, title, time, location, infor) {
    target["title"] = title;
    target["time"] = time;
    target["location"] = location;
    target["infor"] = infor;
}

var remove = function(target) {
    target["title"] = "";
    target["time"] = "";
    target["location"] = "";
    target["infor"] = "";
}


//trigger the loadData function
var update = document.getElementById("updateScheduler");
update.onclick = function(){
    loadTable("data-table", table);
    
}