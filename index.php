<?
	include("dbconfig.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Expence Grid</title>

<link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui-1.8.2.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.jqgrid.css" />

<link rel="icon"       type="image/png"       href="favicon.ico">
<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>

<script src="js/jquery.layout.js" type="text/javascript"></script>
<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script type="text/javascript">
	$.jgrid.no_legacy_api = true;
	$.jgrid.useJSON = true;
</script>
<script src="js/ui.multiselect.js" type="text/javascript"></script>
<script src="js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script src="js/jquery.tablednd.js" type="text/javascript"></script>
<script src="js/jquery.contextmenu.js" type="text/javascript"></script>

<!--

<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.7.custom.js" type="text/javascript"></script>
<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="js/jquery.jqGrid.js" type="text/javascript"></script>
<script type="text/javascript">
	$.jgrid.no_legacy_api = true;
	$.jgrid.useJSON = true;
</script>
<script src="js/jquery.layout.js" type="text/javascript"></script>
<script src="js/ui.multiselect.js" type="text/javascript"></script>
<script src="js/jquery.tablednd.js" type="text/javascript"></script>
<script src="js/jquery.contextmenu.js" type="text/javascript"></script>

	<script src="js/jquery.ui.core.js"></script> 
	<script src="js/jquery.ui.widget.js"></script> 
	<script src="js/jquery.ui.mouse.js"></script> 
	<script src="js/jquery.ui.button.js"></script> 
	<script src="js/jquery.ui.draggable.js"></script> 
	<script src="js/jquery.ui.position.js"></script> 
	<script src="js/jquery.ui.resizable.js"></script> 
	<script src="js/jquery.ui.dialog.js"></script> 
	<script src="js/jquery.ui.datepicker.js"></script> 
	<script src="js/jquery.ui.autocomplete.js"></script> 
	<script src="js/jquery.effects.core.js"></script> 
-->
</head>
<body style="padding:10px;">
<!--
<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false" onclick="opendialog();"><span class="ui-button-text">Add</span></button>

<button id="create-user" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" role="button" aria-disabled="false">
	<span class="ui-button-text">Create new user</span>
</button>
-->
	<style>
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain { width: 400px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
	</style>
<div id="expense-form" title="Add Expense">
	<p class="validateTips">All form fields are required.</p>
	<form id="expense-form-html">
	<fieldset>
     	<label for="datepicker">Date: <input type="text" id="datepicker" name="date"  class="text ui-widget-content ui-corner-all" /></label>
		<br />
		<label for="amount">Amount: <input type="text" id="amount" name="amount"   class="text ui-widget-content ui-corner-all" style="width:100px;" /></label>
		<br />
		<label for="currency">Currency: <input type="text" id="currency" name="currency" value="<?=$_COOKIE['currency']?>"  class="text ui-widget-content ui-corner-all" style="width:50px;" /></label>
		<br />
		<label for="cause">Reason: <input type="text" id="cause" name="cause"   class="text ui-widget-content ui-corner-all" /></label>
		<br />
		<label for="place">Place: <input type="text" id="place" name="place"   class="text ui-widget-content ui-corner-all" /></label>
		<br />
		<label for="note">Note: <input type="text" id="note" name="note"   class="text ui-widget-content ui-corner-all" /></label>
		<br />
		<label for="by">By: <input type="text" id="by" name="by" value="<?=$_COOKIE['by']?>"   class="text ui-widget-content ui-corner-all" /></label>
		<br />
		<label for="for">For: <input type="text" id="for" name="for" value="<?=$_COOKIE['for']?>"   class="text ui-widget-content ui-corner-all" /></label>
	</fieldset>
	</form>
</div>
<button id="add-expense">Add Expense</button>
<table id="list"></table> 
<div id="pager"></div> 
	<script>
$(document).ready(function(){
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		 
		$( "#expense-form" ).dialog({
			autoOpen: false,
			height: 500,
			width: 350,
			modal: true,
			buttons: {
				"Add Expense": function() {
      				$.post('add.php?add=true', $( "#expense-form-html" ).serialize()
      				, function(data) {
				$( "#datepicker" ).val('');
				$( "#amount" ).val('');
				$( "#cause" ).val('');
				$( "#place" ).val('');
				$( "#note" ).val('');
				$( "#currency" ).val('');
				$( "#by" ).val('');
				$( "#for" ).val('');
				$( "#expense-form" ).dialog( "close" );
       				$("#list").trigger("reloadGrid");
       				//window.location = 'http://expenses.babataher.com/';
                      });
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
			}
		}).dialog( "open" );

		$( "#add-expense" )
			.button()
			.click(function() {
				$( "#expense-form" ).dialog( "open" );
			});
				$( "#datepicker" ).datepicker( {"dateFormat" : 'yy-mm-dd'} );
				$( "#amount" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=amount')?>]	});
				$( "#cause" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=cause')?>]	});
				$( "#place" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=place')?>]	});
				$( "#note" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=note')?>]	});
				$( "#currency" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=currency')?>]	});
				$( "#by" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=by')?>]	});
				$( "#for" ).autocomplete({ source: [ <?=file_get_contents_curl('autocomplete.php?table=payment&field=for')?>]	});


  $("#list").jqGrid({
    url:'payment.php',
    editurl:'payment.php',
    datatype: 'xml',
    mtype: 'GET',
    colNames:['ID','Date', 'Amount','Reason','Place','Notes'],
    colModel :[ 
      {name:'id', index:'id', width:55}, 
      {name:'date', index:'date', width:90}, 
      {name:'amount', index:'amount', width:80, align:'right'}, 
      {name:'cause', index:'cause', width:80, align:'right'}, 
      {name:'place', index:'place', width:80, align:'right'}, 
      {name:'note', index:'note', width:150, sortable:false},
    ],
    pager: '#pager',
    rowNum:20,
	height:600,
	width:600,
    rowList:[10,20,30],
    sortname: 'id',
    sortorder: 'desc',
    caption: 'My expenses',
    viewrecords: true,
  });
    $("#list").jqGrid('navGrid', '#pager',{edit:true,add:false,del:true}); 
}); 
</script>
<?

// the actual query for the grid data 
$SQL = "SELECT * FROM payment ORDER BY date desc"; 
$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 
 

$s = "<table>";

 
// be sure to put text data in CDATA
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    $s .= "<tr id='". $row['id']."'>";            
    $s .= "<td>". $row['id']."</td>";
    $s .= "<td>". $row['date']."</td>";
    $s .= "<td><b>". $row['amount']."</b></td>";
    $s .= "<td>". $row['cause']."</td>";
    $s .= "<td>". $row['place']."</td>";
//    $s .= "<td><![CDATA[". $row['note']."]]></td>";
    $s .= "<td>". $row['note']."</td>";
    $s .= "</tr>";
}
$s .= "</table>"; 
 
//echo $s;
?>
 </body>
</html>