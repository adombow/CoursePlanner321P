<html>
<head>
<title>
<?php echo "crawl and fetch ubc ssc courses schedule and put into db";?>
</title>
</head>
<body>
<?php

//-------------------------------------------
//library to crawler
//-------------------------------------------
include_once("simple_html_dom.php");


//-------------------------------------------
//function to fetch https
//-------------------------------------------
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

//-------------------------------------------
// Defining the basic scraping function
//-------------------------------------------
function scrape_between($data, $start, $end){
	$data = stristr($data, $start); // Stripping all data from before $start
	$data = substr($data, strlen($start));  // Stripping $start
	$stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
	$data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
	return $data;   // Returning the scraped data from the function
}

/*

//-------------------------------------------
// Get the level 1 link and save in a csv file
// The csv file will be edit to delet un-need link
// Then will take the new csv file to crawler again
//-------------------------------------------
// set target url to crawl
$url = "https://courses.students.ubc.ca/cs/main?pname=subjarea"; 
// open the web page
$html = new simple_html_dom();
$html->load_file($url);
// array to store scraped links
$links_level_1 = array();
// crawl the webpage for links
foreach($html->find("a") as $link){
    array_push($links_level_1, $link->href);
}
// remove duplicates from the links array
$links_level_1 = array_unique($links_level_1);
// set output headers to download file
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=links_level_1.csv");
// set file handler to output stream
$output = fopen("php://output", "w");
// output the scraped links
fputcsv($output, $links_level_1, "\n");

//-------------------------------------------
// Level 1 crawler clean up
//-------------------------------------------
//open the new csv file, store into array
//the array need implode to string
//and miss https://courses.students.ubc.ca
$links_level_1_new = array_map("str_getcsv",file("links_level_1_new.csv"));
foreach($links_level_1_new as &$item){
	$item = 'https://courses.students.ubc.ca'.implode($item);
}

*/

/*

//-------------------------------------------
// Level 2 crawler
//-------------------------------------------
// array to store scraped links
$links_level_2 = array();
foreach($links_level_1_new as &$item){
	// set target url to crawl
	$url = $item; 
	// open the web page
	$html = new simple_html_dom();
	$html->load_file($url);
	// crawl the webpage for links
	foreach($html->find("a") as $link){
		array_push($links_level_2, $link->href);
	}
	// remove duplicates from the links array
	$links_level_2 = array_unique($links_level_2);
}
// set output headers to download file
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=links_level_2.csv");
// set file handler to output stream
$output = fopen("php://output", "w");
// output the scraped links
fputcsv($output, $links_level_2, "\n");	

//-------------------------------------------
// Level 2 crawler clean up
//-------------------------------------------
//open the new csv file, store into array
//the array need implode to string
//and miss https://courses.students.ubc.ca
$links_level_2_new = array_map("str_getcsv",file("links_level_2_new.csv"));
foreach($links_level_2_new as &$item){
	$item = 'https://courses.students.ubc.ca'.implode($item);
}


//-------------------------------------------
// Level 3 crawler
//-------------------------------------------
// array to store scraped links
$links_level_3 = array();
foreach($links_level_2_new as &$item){
	// set target url to crawl
	$url = $item; 
	// open the web page
	$html = new simple_html_dom();
	$html->load_file($url);
	// crawl the webpage for links
	foreach($html->find("a") as $link){
		array_push($links_level_3, $link->href);
	}
	// remove duplicates from the links array
	$links_level_3 = array_unique($links_level_3);
}
// set output headers to download file
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=links_level_3.csv");
// set file handler to output stream
$output = fopen("php://output", "w");
// output the scraped links
fputcsv($output, $links_level_3, "\n");	

*/


//-------------------------------------------
// Level 3 crawler clean up
//-------------------------------------------
//open the new csv file, store into array
//the array need implode to string
//and miss https://courses.students.ubc.ca
$links_level_3_new = array_map("str_getcsv",file("links_level_3_new.csv"));
foreach($links_level_3_new as &$item){
	$item = 'https://courses.students.ubc.ca'.implode($item);
}

/*
// Downloading home page to variable $scraped_page
$scraped_page = getHTTPS('https://courses.students.ubc.ca/'.implode($links_level_2[0]));
// Scraping downloaded dara in $scraped_page for content between tags
$scraped_data = scrape_between($scraped_page, "<body>", "</body>");
// split the string to array string list
$scraped_data = preg_replace("/[^A-Za-z0-9]/"," ",$scraped_data);
$data2string = preg_split("/[\s,]+/", $scraped_data);
$key = array_search("AANB",$data2string);
echo $data2string[$key];
*/

?>
</body>
</html>
