<?php 
include("dbconfig.php");
$page = $_GET['page']; 
$limit = $_GET['rows']; 
$sidx = $_GET['sidx']; 
$sord = $_GET['sord']; 
if(!$sidx) $sidx =1; 
/*
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
*/
$SQL = "SELECT concat(year(date) , '-' , month(date)) `date`, concat(cause,' (',count(cause),'x)') reason, sum(amount) `total` , currency FROM payment group by cause, year(date), month(date), currency"; 

if($sidx && $sord)
	$SQL .= " ORDER BY $sidx $sord"; 
else
	$SQL .= " ORDER BY total desc"; 

if($limit && $start)
	$SQL .= " LIMIT $start , $limit"; 
else
if($limit )
	$SQL .= " LIMIT $limit"; 

$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 
$count = mysql_num_rows($result);
header("Content-type: text/xml;charset=utf-8");

 

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .=  "<rows>";
$s .= "<page>1</page>";
$s .= "<total>1</total>";
$s .= "<records>".$count."</records>";

while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    $s .= "<row id='". ++$i."'>";            
    $s .= "<cell>". $row['date']."</cell>";
    $s .= "<cell>". htmlentities($row['reason'])."</cell>";
    $s .= "<cell>". $row['total']."</cell>";
    $s .= "</row>";

}

$s .= "</rows>"; 

 

echo $s;

?>
