<?
include("dbconfig.php");
if($_REQUEST['add']) {
	if(mysql_query("insert into payment set date='{$_REQUEST['date']}', cause='{$_REQUEST['cause']}', place='{$_REQUEST['place']}', amount='{$_REQUEST['amount']}', note='{$_REQUEST['note']}', currency='{$_REQUEST['currency']}', `by`='{$_REQUEST['by']}', `for`='{$_REQUEST['for']}'")) {
     	$id = mysql_insert_id();
		$message = "payment($id) added successfully!";
		die($message);
	}
	setcookie("currency", $_REQUEST['currency'], time() + (60*60*24*360));
	setcookie("by", $_REQUEST['by'], time() + (60*60*24*360));
	setcookie("for", $_REQUEST['for'], time() + (60*60*24*360));
/*
	$_COOKIE['currency'] = $_REQUEST['currency'];
	$_COOKIE['by'] = $_REQUEST['by'];
	$_COOKIE['for'] = $_REQUEST['for'];
*/
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Expence Grid</title>
 
<link type="text/css" href="css/hot-sneaks/jquery-ui-1.8.7.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.7.custom.min.js"></script>

	<script src="ui/jquery.ui.core.js"></script> 
	<script src="ui/jquery.ui.widget.js"></script> 
	<script src="ui/jquery.ui.mouse.js"></script> 
	<script src="ui/jquery.ui.button.js"></script> 
	<script src="ui/jquery.ui.draggable.js"></script> 
	<script src="ui/jquery.ui.position.js"></script> 
	<script src="ui/jquery.ui.resizable.js"></script> 
	<script src="ui/jquery.ui.dialog.js"></script> 
	<script src="ui/jquery.ui.datepicker.js"></script> 
	<script src="ui/jquery.ui.autocomplete.js"></script> 
	<script src="ui/jquery.effects.core.js"></script> 
</head>
<body style="padding:100px;">
<h1><?=$message?></h1>
<form method="post"> 
	<fieldset>
		<label for="datepicker">Date: </label><input type="text" id="datepicker" name="date"  class="text ui-widget-content ui-corner-all" />
		<label for="amount">Amount: </label><input type="text" id="amount" name="amount"   class="text ui-widget-content ui-corner-all" />
		<label for="currency">Currency: </label><input type="text" id="currency" name="currency" value="<?=$_COOKIE['currency']?>"  class="text ui-widget-content ui-corner-all" style="width:50px;" />
		<label for="cause">Reason: </label><input type="text" id="cause" name="cause"   class="text ui-widget-content ui-corner-all" />
		<br />
		<label for="place">Place: </label><input type="text" id="place" name="place"   class="text ui-widget-content ui-corner-all" />
		<label for="note">Note: </label><input type="text" id="note" name="note"   class="text ui-widget-content ui-corner-all" />
		<label for="by">By: </label><input type="text" id="by" name="by" value="<?=$_COOKIE['by']?>"   class="text ui-widget-content ui-corner-all" />
		<label for="for">For: </label><input type="text" id="for" name="for" value="<?=$_COOKIE['for']?>"   class="text ui-widget-content ui-corner-all" />

<input type="submit" name="add" value="add" class="ui-button ui-widget-content ui-corner-all" />
	</fieldset>

</form>
		<script>
			$(function() {
				$( "#datepicker" ).datepicker( {"dateFormat" : 'yy-mm-dd'} );
				$( "#amount" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=amount')?>]	});
				$( "#cause" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=cause')?>]	});
				$( "#place" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=place')?>]	});
				$( "#note" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=note')?>]	});
				$( "#currency" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=currency')?>]	});
				$( "#by" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=by')?>]	});
				$( "#for" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=for')?>]	});
			});
		</script>
</body>
</html>