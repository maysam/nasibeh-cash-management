<?
error_reporting(-1);
	if(isset($_REQUEST['oper'])) {
		include("dbconfig.php");
		$oper = $_REQUEST['oper'];
		$id = $_REQUEST['id'];
		if($oper == 'del')
		{
			$sql = "delete from payment where id=$id";
			mysql_query($sql);
		}
		elseif($oper == 'edit')
		{
			foreach($_REQUEST as $key=>$value)
		//	if($key != 'id' && $key != 'oper')
			{
				switch($key)
				{
					case 'date' :
					break;
				}
				$sql = "update payment set $key='$value' where id=$id limit 1";
				mysql_query($sql);
				//break;
			}
		}
	}
?>
