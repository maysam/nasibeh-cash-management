<?
	if(isset($_REQUEST['oper'])) {
		$oper = $_REQUEST['oper'];
		$id = $_REQUEST['id'];
		if($oper == 'del')
		{
			$sql = "delete from payment where id=$id";
		}
		elseif($oper == 'edit')
		{
			foreach($_REQUEST as $key=>$value)
		//	if($key != 'id' && $key != 'oper')
			{
				
				$sql = "update payment set $key='$value' where id=$id limit 1";
				break;
			}
		}
		if(isset($sql))
		{
			include("dbconfig.php");
			mysql_query($sql);
		//	die($sql);
		}
	}
?>