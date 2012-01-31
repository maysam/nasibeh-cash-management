<?
	include("dbconfig.php");
	$last = mysql_fetch_array(mysql_query("select * from payment order by id desc limit 1"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Expence Grid</title>
<link rel="icon" type="image/png" href="favicon.ico">

<link rel="stylesheet" type="text/css" href="js/jquery-ui/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="js/jqGrid/css/ui.jqgrid.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery-ui.js" type="text/javascript"></script>
<script src="js/jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="js/layout.js/layout.js" type="text/javascript"></script>
<script src="js/jqGrid/jquery.jqGrid.js" type="text/javascript"></script>
<script src="js/jqGrid/plugins/ui.multiselect.js" type="text/javascript"></script>
<script src="js/jqGrid/plugins/jquery.tablednd.js" type="text/javascript"></script>
<script src="js/jqGrid/plugins/jquery.contextmenu.js" type="text/javascript"></script>

<script type="text/javascript">
	$.jgrid.no_legacy_api = true;
	$.jgrid.useJSON = true;
</script>

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
<table>
<tr><td>
<button id="add-expense">Add Expense</button>
</td>
<td align=right>
<select id="choose-currency">
	<option value=SGD>SGD</option>
	<option value=MYR>MYR</option>
	<option value=IRR>Rial</option>
</select>
<select id="choose-table">
	<option value=payment>2012</option>
	<option value=payment_2011>2011</option>
</select>
<input type=checkbox id="monthly">Monthly</checkbox>
</td>
</td></tr>

<tr><td>
<table id="list"></table> 
<div id="pager"></div>

</td><td>
<table id="statlist"></table> 
<div id="statpager"></div>

</td></tr></table>
<style>
.new_date {
    background-color: lightblue !important;
}
</style> 

<script type="text/javascript">

		var lastSel=0;
		var lastDate=0;
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
						$.post('add.php?add=true', $( "#expense-form-html" ).serialize(), function(data) {
							$( "#amount" ).val('');
							$( "#cause" ).val('');
							$( "#place" ).val('');
							$( "#note" ).val('');
							$( "#expense-form" ).dialog( "close" );
							$("#list").trigger("reloadGrid");
						});
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				},
				close: function() {
				}
			});//.dialog( "open" );

			$( "#add-expense" )
				.button()
				.click(function() {
					$( "#expense-form" ).dialog( "open" );
				});
	
			
			$( "#datepicker" ).datepicker( {"dateFormat" : 'yy-mm-dd'} );
			$( "#amount" ).autocomplete({source: 'autocomplete.php?table=payment&field=amount'});
			$( "#cause" ).autocomplete({ source: 'autocomplete.php?table=payment&field=cause'});
			$( "#place" ).autocomplete({ source: 'autocomplete.php?table=payment&field=place'});
			$( "#note" ).autocomplete({ source: 'autocomplete.php?table=payment&field=note'});
			$( "#currency" ).autocomplete({ source: 'autocomplete.php?table=payment&field=currency'});
			$( "#by" ).autocomplete({ source: 'autocomplete.php?table=payment&field=by'});
			$( "#for" ).autocomplete({ source: 'autocomplete.php?table=payment&field=for'});
	}); 
	
var weekday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
function date_formater  (cellvalue, options, rowObject)
{
  // do something here
   d = new Date(cellvalue);
   
   return weekday[d.getDay()];
}
function list() {
	try {
	  $("#list").jqGrid({
		url:'list.php',
		cellEdit : false,
		cellsubmit : 'remote',
		cellurl: 'action.php',
		editurl: 'action.php',
		datatype: 'xml',
		mtype: 'GET',
		colNames:['ID','Day', 'Date', 'Amount','Currency', 'Reason', 'Place', 'Notes', 'by', 'for'],
		colModel :[ 
		  {name:'id', index:'id', width:55, PrimaryKey:true}, 
		  {name:'wdate', index:'wdate', width:90, editable:false, formatter:date_formater}, 
		  {name:'date', index:'date', width:110, editable:true, editoptions:{ dataInit:function (elem) { $(elem).datepicker({"dateFormat" : 'yy-mm-dd'}); } }}, 
		  {name:'amount', index:'amount', width:80, align:'right', editable:true}, 
		  {name:'currency', index:'currency', width:80, align:'right', editable:true, edittype:"select", editoptions:{value:"SGD:SGD;MYR:MYR"}}, 
		  {name:'cause', index:'cause', width:80, align:'right', editable:true}, 
		  {name:'place', index:'place', width:80, align:'right', editable:true}, 
		  {name:'note', index:'note', width:150, sortable:false, editable:true},
		  {name:'by', index:'by', width:150, sortable:false, editable:true},
		  {name:'for', index:'for', width:150, sortable:false, editable:true},
		],
		pager: '#pager',
		rowNum:20,
		height:500,
		width:600,
		rowList:[10,20,50, 100, 200],
		sortname: 'date',
		sortorder: 'desc',
		caption: 'Expenses',
		viewrecords: true,
		loadComplete: function(){
			//	coloring rows alternatively to indicate days
			toggleDate = true;
			var rowIDs = jQuery("#list").getDataIDs(); 
			for (var i=0;i<rowIDs.length;i++){ 
				rowData=jQuery("#list").getRowData(rowIDs[i]);
				if(rowData.date != lastDate)
				{
					toggleDate = ! toggleDate;
					lastDate = rowData.date;
				}
				if(toggleDate){
					$("#" + rowData.id).removeClass('ui-widget-content');
					$("#" + rowData.id).addClass('new_date');
				}
			}
		},
		ondblClickRow: function(id, ri, ci)
		{
			// edit the row and save it on press "enter" key
			$("#list").jqGrid('editRow',id,true);
		},
		onSelectRow: function(id) {
			if (id && id !== lastSel) {
				// cancel editing of the previous selected row if it was in editing state.
				// jqGrid hold intern savedRow array inside of jqGrid object,
				// so it is safe to call restoreRow method with any id parameter
				// if jqGrid not in editing state
				$("#list").jqGrid('restoreRow',lastSel);
				lastSel = id;
			}
		},
	  }).jqGrid('navGrid', '#pager',{edit:true,add:false,del:true}); 
	 } catch(e) {
		 console.log('loading list again: ' + e);
		 setTimeout("list()",300);
	 }
  }	//	x function
  
function stats() {
	try {
	  $("#statlist").jqGrid({
		url:'stats.php',  
		datatype: 'xml',
		mtype: 'GET',
		colNames:['Year-Month', 'Reason','Total Amount'],
		colModel :[ 
		  {name:'date', index:'date', width:110}, 
		  {name:'reason', index:'reason', width:80}, 
		  {name:'total', index:'total', width:80, align:'right'}, 
		],
		pager: '#statpager',
		rowNum:200,
		height:500,
		width:600,
		rowList:[10,20,50, 100, 200],
		sortname: 'total',
		sortorder: 'desc',
		caption: 'Stats',
		viewrecords: true,
		loadComplete: function(){
			//	coloring rows alternatively to indicate days
			var rowIDs = jQuery("#statlist").getDataIDs(); 
			
			for (var i=1;i<rowIDs.length;i+=2){ 
				$("#" + i).removeClass('ui-widget-content');
				$("#" + i).addClass('new_date');
			}
		},
	  }).jqGrid('navGrid', '#statpager',{edit:false,add:false,del:false}); 

//			$( "#choose-table" ).click( update_lists());
//			$( "#choose-currency" ).click( update_lists());
	
	 } catch(e) {
		 console.log('loading stats again: ' + e);
		 setTimeout("stats()",300);
	 }
  }	//	y function
  	$(document).ready(function(){
		list();
		stats();
		function reload() {
		}
		$("select").click(function() {
			var param = '?table=' + $("#choose-table").val() + '&currency=' + $("#choose-currency").val();
			if($('#monthly').is(':checked'))
				param = param + '&monthly=true';
			$("#list").setGridParam({url : 'list.php' + param }).trigger("reloadGrid");
			$("#statlist").setGridParam({url : 'stats.php'+param }).trigger("reloadGrid");
		});

		$("#monthly").click(function() {
			var param = '?table=' + $("#choose-table").val() + '&currency=' + $("#choose-currency").val();
			if($('#monthly').is(':checked'))
				param = param + '&monthly=true';
			$("#statlist").setGridParam({url : 'stats.php'+param }).trigger("reloadGrid");
		});
	});
</script>

 </body>
</html>
