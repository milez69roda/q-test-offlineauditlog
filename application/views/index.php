 <style>
	.cdate{
		margin-bottom: -3px !important;
	}
 </style>
<script>
	
	$(document).ready(function(){
	 $('.cdate').datepicker({
			'autoclose': true
		}); 
	});
	
	function redirect(link){ 
		window.location = link+"/?from="+$("#date_from").val()+"&to="+$("#date_to").val();
	}
	
	
</script>
<div class="row-fluid">
	<!--<div class="hero-unit" style="padding: 20px !important;">
		<span class="label label-info">From</span> 
		<div data-date-format="yyyy-mm-dd" class="input-append date cdate">
			<input id="date_from" name="date_from" type="text" readonly="" value="<?php echo date('Y-m-d'); ?>" size="16" class="span8">
			<span class="add-on"><i class="icon-calendar"></i></span>
		</div>	

		<span class="label label-info">To</span> 
		<div data-date-format="yyyy-mm-dd" class="input-append date cdate">
			<input id="date_to" name="date_to" type="text" readonly="" value="<?php echo date('Y-m-d'); ?>" size="16" class="span8">
			<span class="add-on"><i class="icon-calendar"></i></span>
		</div>			
	 
		<button type="button" class="btn btn-primary" >Search</button>
	</div> -->
	
	<div class="row">
	<!--
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"  >
			<thead>
				<tr>
					<th>Channels</th>
					<th>No. of Audits</th>
					<th>Average Score</th> 
					<th></th> 
				</tr>
			</thead>
			<tbody>	
				<tr>
					<td>Kana Email</td>
					<td>20</td>
					<td>78%</td>
					<td><a class="btn btn-info btn-small" href="javascript:redirect('overview/kanaemail')">View details &raquo;</a></td>
				</tr>
				<tr >
					<td>Kana Chat</td>
					<td>20</td>
					<td>78%</td>
					<td><a class="btn btn-info btn-small" href="javascript:redirect('overview/kanachat')">View details &raquo;</a></td>
				</tr>
				<tr>
					<td>Social Media and Blogs</td>
					<td>20</td>
					<td>78%</td>
					<td><a class="btn btn-info btn-small" href="javascript:redirect('overview/socialmedia')">View details &raquo;</a></td>
				</tr>
				<tr>
					<td>Cases</td>
					<td>20</td>
					<td>78%</td>
					<td><a class="btn btn-info btn-small" href="javascript:redirect('overview/cases')">View details &raquo;</a></td>
				</tr>
				<tr>
					<td>CDR</td>
					<td>20</td>
					<td>78%</td>
					<td><a class="btn btn-info btn-small" href="javascript:redirect('overview/cdr')">View details &raquo;</a></td>
				</tr>
			</tbody>		
		</table>-->	
	</div>
	<!--
	<div class="row">
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>

		<script type="text/javascript">
		  google.load("visualization", "1", {packages:["corechart"]});
		  google.setOnLoadCallback(drawChart);
		  function drawChart() {
			var data = google.visualization.arrayToDataTable([
			  ['Month', 'Kana Email', 'Kana Chat', 'Social Media and Blogs', 'Cases', 'CDR'],
			  ['June',  100, 81, 88, 99, 100] 
			]);

			var options = {
			  title: 'Audits Overview',
			  hAxis: {title: 'Month', titleTextStyle: {color: 'red'}}
			};

			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		  }
		</script>
		<div id="chart_div" style="width: 900px; height: 500px;"></div>
	</div>-->
</div>	