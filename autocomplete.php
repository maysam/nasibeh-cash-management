<?php 
include("dbconfig.php");
$SQL = 'SELECT distinct `'.$_REQUEST['field'].'`, sum(amount) cid FROM '.$_REQUEST['table'];
if(isset($_REQUEST['term']))
	$SQL .= ' WHERE `'.$_REQUEST['field'].'` like \'%'.$_REQUEST['term'].'%\''; 
$SQL .= ' Group by `'.$_REQUEST['field'].'` Order by cid desc';
$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 
while($row = mysql_fetch_row($result)) {
    $s[] = '"'.addslashes($row[0]).'"';
}
echo '['.implode(',',$s).']';
?>
