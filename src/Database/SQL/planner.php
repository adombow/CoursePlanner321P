<html>
<head>
<title>
<?php echo "fetch ubc ssc courses schedule";?>
</title>
</head>
<body>
<?php
//function to fetch https
function getHTTPS($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HEADER,0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

// Defining the basic scraping function
function scrape_between($data, $start, $end){
	$data = stristr($data, $start); // Stripping all data from before $start
	$data = substr($data, strlen($start));  // Stripping $start
	$stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
	$data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
	return $data;   // Returning the scraped data from the function
}
	
	
//Downloading home page to variable $scraped_page
$scraped_page = getHTTPS('https://courses.students.ubc.ca/cs/main?pname=subjarea&tname=subjareas&req=5&dept=AANB&course=504&section=002');

// Scraping downloaded dara in $scraped_page for content between tags
$scraped_data = scrape_between($scraped_page, "<body>", "</body>");

//split the string to array string list
$scraped_data = preg_replace("/[^A-Za-z0-9]/"," ",$scraped_data);
$data2string = preg_split("/[\s,]+/", $scraped_data);

//$key = array_search("AANB",$data2string);
//echo $data2string[$key];
//split page done, next convert to db manually?

?>
</body>
</html>
