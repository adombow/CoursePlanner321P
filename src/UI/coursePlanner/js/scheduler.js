//Data field
var num_of_rows = 0;
var mon = [jQuery.parseJSON('{"title": "Math", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var tue = [jQuery.parseJSON('{"title": "English", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var wed = [jQuery.parseJSON('{"title": "", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var thu = [jQuery.parseJSON('{"title": "Physics", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var fri = [jQuery.parseJSON('{"title": "", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var sat = [jQuery.parseJSON('{"title": "Music!!!", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];
var sun = [jQuery.parseJSON('{"title": "Badminton", "time": "8am-9am", "location": "building-room", "infor": "some infor"}')];

var row0 = ["Monday", "Tuesday", "Wednesday", "Tuesday", "Friday", "Saturday", "Sunday"];
var row1 = [ mon[0], tue[0], wed[0], thu[0], fri[0], sat[0], sun[0]];

var table = [row0, row1];





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

//****************************************************
//
//      load data from UI to local to server(achieve later)
//
//****************************************************
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

var addRow = function() {
    num_of_rows++;

    mon.push(new jQuery.parseJSON('{"title": "^_^", "time": "", "location": "", "infor": ""}'));
    tue.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    wed.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    thu.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    fri.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    sat.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    sun.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));

    table.push([mon[num_of_rows], tue[num_of_rows], wed[num_of_rows], thu[num_of_rows], fri[num_of_rows], sat[num_of_rows], sun[num_of_rows]]);
}

var newRow = document.getElementById("add-row");
newRow.onclick = function(){
    addRow();
    
}


var removeLastRow = function() {
    if (num_of_rows < 0) {
        alert("No row to be removed ...");
    } 
    else {
        num_of_rows--;
        table.pop();
        mon.pop();
        tue.pop();
        wed.pop();
        thu.pop();
        fri.pop();
        sat.pop();
        sun.pop();
    }

}

var removeRow = document.getElementById("remove-last-row");
removeRow.onclick = function(){
    removeLastRow();
}

//****************************************************
//
//      load data from local and from server to UI
//
//****************************************************
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

//trigger the loadData function
var update = document.getElementById("update-scheduler");
update.onclick = function(){
    //load data from server to local

    //load data from local to UI
    loadTable("data-table", table);
    
}


