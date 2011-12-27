<?php
session_start();
$dbhost = 'localhost';
$dbuser   = 'whampoa_maysam';
$dbpassword = 'torabi';
$database = 'whampoa_expenses';
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); 
mysql_select_db($database) or die("Error connecting to db."); 
function file_get_contents_curl($url) {
	$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI'].'.php').'/'.$url;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
	curl_setopt($ch, CURLOPT_USERPWD, "maysam:torabi");
	curl_setopt($ch, CURLOPT_URL, $url);
 
	$data = curl_exec($ch);
	curl_close($ch);
 
	return $data;
}
?>
