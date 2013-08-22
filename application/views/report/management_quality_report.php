<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">

<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>

<script>

	$(document).ready(function(){
 
		$('.cdate').datepicker({ 'autoclose': true })
			 .on('changeDate',function(ev){
			 
				if ($("#date_from").val() > $("#date_to").val()){
					  
						alert('Error Date Range');  
				} 
			}); 
 
		CDR = {
			
		}; 
		
		
		oTable = $('#example').dataTable({
				"sDom": "<'row'<'span2'l><'span6 toolbar'><'span4'f>r>t<'row'<'span6'i><'span6'p>>",
				"sPaginationType": "bootstrap", 			
				"oLanguage": {
					"sLengthMenu": "_MENU_ per page"
				} 
			});		
	}); 
	
</script>  
<div class="row-fluid" style="">
	<?php echo $nav; ?>  
	<h4 class="text-center">Agent Quality Report - Summary per Day Report</h4>
	
	<div class="row" style="text-align:left">
		
		<form id="form1" name="form1" action="<?php echo base_url(); ?>management/qualityreport/" method="GET">
		<span class="label label-info">From</span> 
		<div data-date-format="yyyy-mm-dd" class="input-append date cdate">
			<input id="date_from" name="from" type="text" readonly="" value="<?php echo ( isset($_GET['from']))?$_GET['from']:date('Y-m-d'); ?>" size="16" class="span8">
			<span class="add-on"><i class="icon-calendar"></i></span>
		</div>	

		<span class="label label-info">To</span> 
		<div data-date-format="yyyy-mm-dd" class="input-append date cdate">
			<input id="date_to" name="to" type="text" readonly="" value="<?php echo ( isset($_GET['to']))?$_GET['to']:date('Y-m-d'); ?>" size="16" class="span8">
			<span class="add-on"><i class="icon-calendar"></i></span>
		</div>	
		<button type="submit" class="btn btn-primary" id="btn_search_1" >Search</button>	
		<button type="button" class="btn btn-success" onclick="COMMON.report_exportexcel('management_quality')">Export</button>
		</form>	 	
		 
	</div>
	
	<div>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"  >
			<thead>
				<tr>
					<th>Date</th>
					<th>Agent</th>
					<th>Audit ID</th>
					<th>Type of Audit</th> 
					<th>Audit Score</th>
					<th>Audit Potential Score</th>
					<th>% Score</th> 
				</tr>
			</thead>
			<tbody>	
			<?php foreach($list as $row): ?>
				<tr>
					<td><?php echo $row->datecreated; ?></td>
					<td><?php echo $row->agent_id; ?></td>
					<td><?php echo $row->audit_code; ?></td>
					<td><?php echo $row->typeofaudit; ?></td> 
					<td><?php echo $row->auditscore; ?></td>
					<td><?php echo $row->potential_score; ?></td>
					<td><?php echo $row->percent_score; ?>%</td>
				</tr>
			<?php endforeach; ?>	
			</tbody>		
		</table>	
	</div>
</div>	