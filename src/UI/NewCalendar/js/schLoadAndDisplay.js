var idArray = [19];
var dbEntries = Array();

// ---------------->> To display calendar based on dbEntries array <<----------------
function db2cal_time(db_date, db_start, db_end){
    var date_time = "01-08-2016 ";
    if(db_date == "mon") date_time = "01-08-2016 ";
    else if(db_date == "tue") date_time = "02-08-2016 ";
    else if(db_date == "wed") date_time = "03-08-2016 ";
    else if(db_date == "thu") date_time = "04-08-2016 ";
    else if(db_date == "fri") date_time = "05-08-2016 ";
    else if(db_date == "sat") date_time = "06-08-2016 ";
    else if(db_date == "sun") date_time = "07-08-2016 ";
    else date_time = "01-08-2016 ";
    var ret = [
        date_time.concat(db_start),
        date_time.concat(db_end)
    ];
    return ret;
}

function db2cal_color(db_color_bg, db_color_text) {
    var temp = [];
    if (!db_color_bg || 0 === db_color_bg.length){
        temp[0] = "#12CA6B";
    }else{
        temp[0] = db_color_bg;
    }

    if (!db_color_text || 0 === db_color_text.length){
        temp[1] = "#FFF";
    }else{
        temp[1] = db_color_text;
    }

    return temp;
}

var mapToDisplay = function() {
    for (var i=0; i<dbEntries.length;i++) {
        console.log("map: " + i);

        var display_time = db2cal_time(dbEntries[i][db_key_date], dbEntries[i][db_key_start], dbEntries[i][db_key_end]);
        var display_color = db2cal_color(dbEntries[i][db_key_color_bg], dbEntries[i][db_key_color_text]);
        //console.log(display_time[0] + "   " + display_time[1]);
        var display_id = dbEntries[i][db_key_id];
        var display_title = dbEntries[i][db_key_title];
		//add two date
		var start_date = dbEntries[i][db_key_start_date];
		var end_date = dbEntries[i][db_key_end_date];
        var temp = {
            id : display_id,
            title: display_title,
            start: display_time[0],
            end : display_time[1],
            backgroundColor: display_color[0],
            textColor : display_color[1],
			ranges: [{ //repeating events are only displayed if they are within at least one of the following ranges.
				start: moment().startOf('week'), //next two weeks
				end: moment().endOf('week').add(7,'d'),
			},
			{
				start: moment(start_date,'YYYY-MM-DD'), //all of february
				end: moment(end_date,'YYYY-MM-DD'),
			}]
        };

        display_events.push(temp);

    }


    rerender();
}


// ---------------->> To update dbEntries array from Database <<----------------
var updateEventsFromDB = function(num) {
    console.log("Function updateEventsFromDB called ...")
    for (var i=0; i<num; i++) {
        //console.log("----->> "+i);

        $.ajax({
            type: "POST",
            url: 'php/downloadEntries.php',
            data: { array : idArray },//idArray,
            async: false,
            dataType: "json",
            success: function(data){
                //console.log("get json object from DB ...");
                console.log(data);
                
                //console.log("idArray:");
                //console.log(idArray);
                
                dbEntries.push(data);
                idArray.push(parseInt(data[db_key_id]));

            },
            error : function() {        
                alert("Exception from downloadEntries.php");    
            }    
        });
    }
}

var updateEvents = function(){
    console.log("Button pushed ... ");
    
    var numEntries = 0;
    $.ajax({
        type: "POST",
        url: 'php/countEntries.php',
        dataType: "json",
        async: false,
        success: function(data){
            console.log("get num of entries of the user from dtabase ... ");
            numEntries = parseInt(data);
            console.log(numEntries);

            updateEventsFromDB(numEntries);

        },
        error : function() {        
            //alert("Exception from countEntries.php");    
        }    
    });


    
}


// ---------------->> Initialize the page when refresh <<----------------
$.ajax({
    url:updateEvents(),
    async: false,
    success:function(){
       mapToDisplay();
    }
});

