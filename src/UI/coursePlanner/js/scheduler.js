//Data field
var num_of_rows_db = 60;
var mon = new Array();
var tue = new Array();
var wed = new Array();
var thu = new Array();
var fri = new Array();
var sat = new Array();
var sun = new Array();
var first_col = [jQuery.parseJSON('{"title": "1"}')];

var row0 = ["#", "Monday", "Tuesday", "Wednesday", "Tuesday", "Friday", "Saturday", "Sunday"];


var table = [row0];



//show infor
var viewTile = function(i,j) {
    if (j==0) return;
    //console.log("i = " + i + " ;  j = " + j);
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
                edit($("#view-edit-tile").data('dialog_title'), i, j);
                //$( this ).dialog( "close" );
            },
            "Remove": function() {
                confirm_tile_remove($("#view-edit-tile").data('dialog_title'), i, j);

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
var edit = function(target, i, j) {
    //console.log("Editing ...");

    //write content
    document.getElementById("edit-tile").innerHTML = 'Title: <input type="text" style="z-index:10000" name="title"><br>Time: <input type="text" style="z-index:10000" name="time"><br>Location: <input type="text" style="z-index:10000" name="location"><br>Infor: <input type="text" style="z-index:10000" name="infor"><br>';
    //open the dialog box
    $( "#edit-tile" ).dialog({
        title: "Edit the Tile",
        modal: true,
        buttons: {
            'OK': function () {
                target["title"] =  $('input[name="title"]').val();
                target["time"] = $('input[name="time"]').val();
                target["location"] = $('input[name="location"]').val();
                target["infor"] = $('input[name="infor"]').val();

                loadTable("data-table", table);

                $.ajax({
                    type: "POST",
                    url: 'php/uploadTile.php',
                    data: {title: target["title"], time: target["time"], location: target["location"], infor: target["infor"], x: i, y: j},
                    success: function(data){
                       alert(data);
                    }
                });

                $(this).dialog('close');
                $( "#view-edit-tile" ).dialog('close');
            },
            'Cancel': function () {
                $( "#view-edit-tile" ).dialog('close');
                $(this).dialog('close');

            }
        }
    });


    
}

var removeTile = function(target, i, j) {
    target["title"] = "";
    target["time"] = "";
    target["location"] = "";
    target["infor"] = "";

    $.ajax({
        type: "POST",
        url: 'php/deleteTile.php',
        data: {x: i, y: j},
        success: function(data){
           alert(data);
        }
    });
    loadTable("data-table", table);

}

var confirm_tile_remove = function(target, i, j) {

    document.getElementById("confirm-tile-remove").innerHTML = "Are you sure to remove the information of this tile?";
    
    $( "#confirm-tile-remove" ).dialog({
        title: "Confirm removement",
        modal: true,
        buttons: {
            'Yes': function () {
                
                removeTile(target, i, j);
                
                $( "#confirm-tile-remove" ).dialog('close');
            },
            'Cancel': function () {
                $(this).dialog('close');

            }
        }
    });
}


// ************************** row operation **************************
var addRow = function() {
    var position_of_new_row = table.length - 1;

    mon.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    tue.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    wed.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    thu.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    fri.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    sat.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    sun.push(new jQuery.parseJSON('{"title": "", "time": "", "location": "", "infor": ""}'));
    first_col.push(new jQuery.parseJSON('{"title": ""}'));
    first_col[position_of_new_row]["title"] = table.length;

    table.push([first_col[position_of_new_row], mon[position_of_new_row], tue[position_of_new_row], wed[position_of_new_row], thu[position_of_new_row], fri[position_of_new_row], sat[position_of_new_row], sun[position_of_new_row]]);
}

var newRow = document.getElementById("add-row");
newRow.onclick = function(){
    addRow();
    
    loadTable("data-table", table);
}


var removeLastRow = function() {

    var num_of_editable_row = table.length - 1;
    if (num_of_editable_row < 1) {
        alert("No row to be removed ...");
    } 
    else {

        table.pop();
        mon.pop();
        tue.pop();
        wed.pop();
        thu.pop();
        fri.pop();
        sat.pop();
        sun.pop();
    }

    loadTable("data-table", table);

}

var confirm_row_remove = function() {

    document.getElementById("confirm-row-remove").innerHTML = "Are you sure to remove the last row from the table?";
    
    $( "#confirm-row-remove" ).dialog({
        title: "Confirm removement",
        modal: true,
        buttons: {
            'Yes': function () {
                
                removeLastRow();
                
                $( "#confirm-row-remove" ).dialog('close');
            },
            'Cancel': function () {
                $(this).dialog('close');

            }
        }
    });
}

var removeRow = document.getElementById("remove-last-row");
removeRow.onclick = function(){
    confirm_row_remove();
}








//****************************************************
//
//      load data from local and from server to UI
//
//****************************************************
var addRowsConfirm = function() {
    document.getElementById("num-of-rows-to-add").innerHTML = '<input type="text" style="z-index:10000" name="num_of_rows">';
    //open the dialog box
    $( "#num-of-rows-to-add" ).dialog({
        title: "How many rows to add:",
        modal: true,
        buttons: {
            'OK': function () {
                var num =  $('input[name="num_of_rows"]').val();
                addRows(num);

                //downloadTiles(num_of_rows);

                loadTable("data-table", table);

               

                $(this).dialog('close');

            },
            'Cancel': function () {
                $(this).dialog('close');

            }
        }
    });
}
var addRows = function(num_of_rows) {

    for (var i=0; i<num_of_rows; i++) {
        addRow();
    }
}

var newRows = document.getElementById("add-rows");
newRows.onclick = function(){
    addRowsConfirm();
}

var downloadTiles = function(i) {
    for(var k=1; k<=i; k++) {

        for(var q=1; q<8; q++) {
            downloadTile(k,q);
        }
    }
}



var downloadTile = function(i,j) {
    $.ajax({
        type: "GET",
        url: 'php/downloadTile.php',
        data: {x: i, y: j},
        dataType: "json",
        success: function(data){
            console.log("find data with index: (" + i + "," + j +")");



            storeTileLocal(data, i, j);
 

        }
    });
}

// modify the global array
var storeTileLocal = function(data, i, j) {
    console.log("store tile locally ..");
    //get temp json object
    var empt = new jQuery.parseJSON('{"title": "", "time": "" , "location": "", "infor": ""}');
    var temp = new jQuery.parseJSON('{"title": "", "time": "" , "location": "", "infor": ""}');
    temp["title"] = data["Title"];
    temp["time"] = data["Time"];
    temp["location"] = data["Location"];
    temp["infor"] = data["Info"];


    

    switch(j) {
        case 1: 
            for (var p=0; p<i-1; p++) {
                if(typeof mon[p] === 'undefined') {
                    mon.push(empt);
                }
            }
            mon[i-1] = temp;  break;
        case 2: 
            for (var p=0; p<i-1; p++) {
                if(typeof tue[p] === 'undefined') {

                    tue.push(empt);
                }
            }
            tue[i-1] = temp;  break;
        case 3: 
            for (var p=0; p<i-1; p++) {
                if(typeof wed[p] === 'undefined') {
                    wed.push(empt);
                }
            }
            wed[i-1] = temp;  break;
        case 4: 
            for (var p=0; p<i-1; p++) {
                if(typeof thu[p] === 'undefined') {
                    thu.push(empt);
                }
            }
            thu[i-1] = temp;  break;
        case 5:
            for (var p=0; p<i-1; p++) {
                if(typeof fri[p] === 'undefined') {
                    fri.push(empt);
                }
            } 
            fri[i-1] = temp;  break;
        case 6: 
            for (var p=0; p<i-1; p++) {
                if(typeof sat[p] === 'undefined') {
                    sat.push(empt);
                }
            }
            sat[i-1] = temp;  break;
        case 7: 
            for (var p=0; p<i-1; p++) {
                if(typeof sun[p] === 'undefined') {
                    sun.push(empt);
                }
            }
            sun[i-1] = temp;  break;
    }
} 


//function to load data
var loadTable = function(tableId, data) {

    var rows = '';

    // load the first row
    var row = '<tr>';
    for (var i=0; i<row0.length; i++) {
        row += '<td class="uneditable">' + data[0][i] + '</td>';
        
    }
    rows += row + '<tr>';

    // load the other rows
    for (var i=1; i<data.length; i++) {
        var row = '<tr>';
        for (var j=0; j<data[i].length; j++) {
            var temp = data[i][j];

            if (j==0) row += '<td class="uneditable" onclick="viewTile(' + i + ',' + j + ')">' + temp["title"] + '</td>';
            else row += '<td class="editable" onclick="viewTile(' + i + ',' + j + ')">' + temp["title"] + '</td>';
        }
        rows += row + '<tr>';
    }
    
    // load all the rows to DOM
    $('#' + tableId).html(rows);
}




//initialize the table
downloadTiles(num_of_rows_db);
