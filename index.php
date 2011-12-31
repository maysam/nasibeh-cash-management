<?
	include("dbconfig.php");
	$last = mysql_fetch_array(mysql_query("select * from payment order by id desc limit 1"));
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

</head>
<body style="padding:10px;">
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
		<label for="currency">Currency: <input type="text" id="currency" name="currency" value="<?=$last['currency']?>"  class="text ui-widget-content ui-corner-all" style="width:50px;" /></label>
		<br />
		<label for="cause">Reason: <input type="text" id="cause" name="cause"   class="text ui-widget-content ui-corner-all" /></label>
		<br />
		<label for="place">Place: <input type="text" id="place" name="place"   class="text ui-widget-content ui-corner-all" /></label>
		<br />
		<label for="note">Note: <input type="text" id="note" name="note"   class="text ui-widget-content ui-corner-all" /></label>
		<br />
		<label for="by">By: <input type="text" id="by" name="by" value="<?=$last['by']?>"   class="text ui-widget-content ui-corner-all" /></label>
		<br />
		<label for="for">For: <input type="text" id="for" name="for" value="<?=$last['for']?>"   class="text ui-widget-content ui-corner-all" /></label>
	</fieldset>
	</form>
</div>
<button id="add-expense">Add Expense</button>
<table id="list"></table> 
<div id="pager"></div> 
	<script>
		$.ui.autocomplete.prototype._renderItem = function( ul, item){
  var term = this.term.split(' ').join('|');
  var re = new RegExp("(" + term + ")", "gi") ;
  var t = item.label.replace(re,"<b>$1</b>");
  return $( "<li></li>" )
     .data( "item.autocomplete", item )
     .append( "<a>" + t + "</a>" )
     .appendTo( ul );
};
$(document).ready(function(){
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		 
		$( "#expense-form" ).dialog({
			autoOpen: false,
			height: 500,
			width: 350,
			position : [ $(window).width()-400,50],
			modal: true,
			buttons: {
				"Add Expense": function() {
      				$.post('add.php?add=true', $( "#expense-form-html" ).serialize()
      				, function(data) {
		//		$( "#datepicker" ).val('');
				$( "#amount" ).val('');
				$( "#cause" ).val('');
				$( "#place" ).val('');
				$( "#note" ).val('');
//				$( "#currency" ).val('');
	//			$( "#by" ).val('');
		//		$( "#for" ).val('');
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
				$( "#amount" ).autocomplete({source: 'autocomplete.php?table=payment&field=amount', highlight: true});
				$( "#cause" ).autocomplete({ source: 'autocomplete.php?table=payment&field=cause'});
				$( "#place" ).autocomplete({ source: 'autocomplete.php?table=payment&field=place'});
				$( "#note" ).autocomplete({ source: 'autocomplete.php?table=payment&field=note'});
				$( "#currency" ).autocomplete({ source: 'autocomplete.php?table=payment&field=currency'});
				$( "#by" ).autocomplete({ source: 'autocomplete.php?table=payment&field=by'});
				$( "#for" ).autocomplete({ source: 'autocomplete.php?table=payment&field=for'});


  $("#list").jqGrid({
    url:'payment.php',
    editurl:'payment.php',
    datatype: 'xml',
    mtype: 'GET',
    colNames:['ID','Date', 'Amount','Currency', 'Reason', 'Place', 'Notes', 'by', 'for'],
    colModel :[ 
      {name:'id', index:'id', width:55}, 
      {name:'date', index:'date', width:90}, 
      {name:'amount', index:'amount', width:80, align:'right'}, 
      {name:'currency', index:'currency', width:80, align:'right'}, 
      {name:'cause', index:'cause', width:80, align:'right'}, 
      {name:'place', index:'place', width:80, align:'right'}, 
      {name:'note', index:'note', width:150, sortable:false},
      {name:'by', index:'by', width:150, sortable:false},
      {name:'for', index:'for', width:150, sortable:false},
    ],
    pager: '#pager',
    rowNum:20,
	height:600,
	width:600,
    rowList:[10,20,30],
    sortname: 'date',
    sortorder: 'desc',
    caption: 'My expenses',
    viewrecords: true,
  });
    $("#list").jqGrid('navGrid', '#pager',{edit:true,add:false,del:true}); 
}); 
</script>
 </body>
</html>