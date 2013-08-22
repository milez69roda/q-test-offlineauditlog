	<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
	
	<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>
	
	<style>
		.dataTable thead tr th{
			font-size: 11px;
		}
		
		.cdate {
			margin-bottom: -3px !important;
		}		
	</style>
	
	<script>
		var  oTable;
		$(document).ready(function() {
		
			$('.cdate').datepicker({ 'autoclose': true })
				 .on('changeDate',function(ev){
				 
					if ($("#date_from").val() > $("#date_to").val()){
						  
							alert('Error Date Range');  
					} 
				});
				
			oTable = $('#example').dataTable( {
				"sDom": "<'row'<'span2'l><'span6 toolbar'><'span4'f>r>t<'row'<'span6'i><'span6'p>>",
				"sPaginationType": "bootstrap", 
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "client/ajax_get_cases",				
				"oLanguage": {
					"sLengthMenu": "_MENU_ per page"
				},
				"aaSorting": [[ 0, 'desc' ]], 
				"fnServerParams": function( aoData ){
					aoData.push( { "name": "date_from", "value": $("#date_from").val() } );
					aoData.push( { "name": "date_to", "value": $("#date_to").val() } );
				}
			});
			
			$("#btn_search_1").click(function(){
				oTable.fnDraw();	
			});	 
			
			$("#example_processing").addClass('label label-success');
		});	
	</script>
	<div class="row-fluid">
	 
		<?php echo $nav; ?>  
		
		<div class="row" style="text-align:center">
			<span class="label label-info">From</span> 
			<div data-date-format="yyyy-mm-dd" class="input-append date cdate">
				<input id="date_from" name="date_from" type="text" readonly="" value="<?php echo ( isset($_GET['from']))?$_GET['from']:date('Y-m-d'); ?>" size="16" class="span8">
				<span class="add-on"><i class="icon-calendar"></i></span>
			</div>	

			<span class="label label-info">To</span> 
			<div data-date-format="yyyy-mm-dd" class="input-append date cdate">
				<input id="date_to" name="date_to" type="text" readonly="" value="<?php echo ( isset($_GET['to']))?$_GET['to']:date('Y-m-d'); ?>" size="16" class="span8">
				<span class="add-on"><i class="icon-calendar"></i></span>
			</div>	
			<button type="button" class="btn btn-primary" id="btn_search_1" >Search</button>	
			<button type="button" class="btn btn-success" onclick="COMMON.exportexcel('cases')">Export</button>	
		</div>
		
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"  >
			<thead>
				<tr>
					<th>Review Date</th>
					<th>Agent ID </th>
					<th>Case ID #</th>
					<th>Did agent do everything possible to resolve the customer's issue</th>
					<th>Did agent perform all necessary troubleshooting before reaching out to other departments for assistance (Carrier, Retailers, Corporate, etc.)? </th>
					<th>Before closing the case, did the agent attempt to contact the customer, via landline or Cell phone to verify if issue was resolved? </th>
					<th>Was it documented whether the customer was contacted and how many times it was attempted? </th>
					<th>Was the case properly documented?</th> 
					<th>Did agent notate the account correctly? (Was the toll free number and internal extension documented)? (Auto-Fail)</th> 
					<th>Score</th>
					<th>Comments</th>
					<th>Suggestions for Corrections</th>
					<th>TF Miami Feedback</th>
					<th>Reopened Case</th>
					<th>Audit Code</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>	
				
			</tbody>		
		</table>
	</div>	 
	