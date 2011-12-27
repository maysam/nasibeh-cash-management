<?php 
include("dbconfig.php");
$SQL = 'SELECT distinct `'.$_REQUEST['field'].'` FROM '.$_REQUEST['table']; 
$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 
while($row = mysql_fetch_row($result)) {
    $s[] = "'".addslashes($row[0])."'";
}
echo implode(',',$s);
?>