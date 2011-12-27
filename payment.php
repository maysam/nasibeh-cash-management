<?php 
include("dbconfig.php");
$page = $_GET['page']; 
$limit = $_GET['rows']; 
$sidx = $_GET['sidx']; 
$sord = $_GET['sord']; 
if(!$sidx) $sidx =1; 
$result = mysql_query("SELECT COUNT(*) AS count FROM payment"); 
$row = mysql_fetch_array($result,MYSQL_ASSOC); 
$count = $row['count']; 
if( $count > 0 && $limit > 0) { 
              $total_pages = ceil($count/$limit); 
} else { 
              $total_pages = 0; 
} 
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit;
if($start <0) $start = 0; 

$SQL = "SELECT * FROM payment"; 

if($sidx && $sord)
	$SQL .= " ORDER BY $sidx $sord"; 
if($limit && $start)
	$SQL .= " LIMIT $start , $limit"; 
else
if($limit )
	$SQL .= " LIMIT $limit"; 

$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 

header("Content-type: text/xml;charset=utf-8");

 

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .=  "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";

while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    $s .= "<row id='". $row['id']."'>";            
    $s .= "<cell>". $row['id']."</cell>";
    $s .= "<cell>". $row['date']."</cell>";
    $s .= "<cell>". $row['amount'].' '. $row['currency']."</cell>";
    $s .= "<cell>". htmlentities($row['cause'])."</cell>";
    $s .= "<cell>". $row['place']."</cell>";
//    $s .= "<cell><![CDATA[". $row['note']."]]></cell>";
    $s .= "<cell>". htmlentities($row['note'])."</cell>";

    $s .= "</row>";

}

$s .= "</rows>"; 

 

echo $s;

?>