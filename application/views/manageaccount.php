	<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
	
	<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>
 <style>
	.access1 p{
		display: block;
		clear: both;
		font-size: 10px !important;
	}
	
	.access1 input{
		font-size: 10px !important;
	}
	
	td.acccolor{
		background-color: #B94A48 !important;
		color:#fff !important;
	}
 </style>
<script>
	
	$(document).ready(function(){
 
 		ACCOUNT = {
			
				updateChannels: function( id, f ){
					$("#access_"+id).addClass('acccolor');
					$.ajax({
						type: 'post',
						url: "client/ajax_saveuserschannels/",
						data: $("#"+f).serialize()+'&id='+id,
						dataType: 'json',
						success: function(json){
							if( json.status ) {
								setTimeout(function() {
									$("#access_"+id).removeClass( "acccolor" ).hide().fadeIn();
								},1000);
							}
							
						},
						error: function(){
							
						}
					});  
			 
				
				return false;
			} 
		}
		 
		
			$('.cdate').datepicker({ 'autoclose': true })
				 .on('changeDate',function(ev){
				 
					if ($("#date_from").val() > $("#date_to").val()){
						  
							alert('Error Date Range');  
					} 
				});
				
			var  oTable = $('#example').dataTable( {
				"sDom": "<'row'<'span2'l><'span6 toolbar'><'span4'f>r>t<'row'<'span6'i><'span6'p>>",
				"sPaginationType": "bootstrap",
				"bPaginate": false,	
				"oLanguage": {
					"sLengthMenu": "_MENU_ per page"
				},
				"aaSorting": [[ 0, 'desc' ]] 
			});  
			  	
 
	}); 
</script>
<div class="row-fluid">
	  
	<?php echo $nav; ?>
	
	<div class="row">
		 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"  >
			<thead>
				<tr>
					<th>Name</th>
					<th>Username</th>
					<th>Password</th> 
					<th>Type</th> 
					<?php if( $this->session->userdata('OFFAL_ROLEID') ==  1): ?><th>Access</th><?php endif; ?> 
				</tr>
			</thead>
			<tbody>	
			<?php foreach($users as $row): ?>
				<tr>
					<td><?php echo $row->fullname?></td>
					<td><span class="label <?php echo ($row->isSuper)?'label-important':'label-info'?> "><?php echo $row->username?></span></td>
					<td><?php echo $row->password?></td>
					<td><?php echo ($row->isSuper)?'Manager':'Representative'?></td>
					<?php if( $this->session->userdata('OFFAL_ROLEID') ==  1): ?>
					<td class="access1" id="access_<?php echo $row->id; ?>"> 
						<?php $channels = explode(',',$row->access); ?>
						<form name="forma_<?php echo $row->id; ?>" id="forma_<?php echo $row->id; ?>" action="" method="post">
						<p><input type="checkbox" style="float:left" value="1" name="chkchannel[]" <?php echo (in_array('1', $channels))?'checked':'' ?> onclick="javascript:ACCOUNT.updateChannels(<?php echo $row->id; ?>,'forma_<?php echo $row->id; ?>')"> <label style="float:left"> Kana Email</label></p>
						<p><input type="checkbox" style="float:left" value="2" name="chkchannel[]" <?php echo (in_array('2', $channels))?'checked':'' ?> onclick="javascript:ACCOUNT.updateChannels(<?php echo $row->id; ?>,'forma_<?php echo $row->id; ?>')"> <label for="ckacc_<?php echo $row->id; ?>" style="float:left"> Kana Chat</label></p>
						<p><input type="checkbox" style="float:left" value="3" name="chkchannel[]" <?php echo (in_array('3', $channels))?'checked':'' ?> onclick="javascript:ACCOUNT.updateChannels(<?php echo $row->id; ?>,'forma_<?php echo $row->id; ?>')"> <label for="ckacc_<?php echo $row->id; ?>" style="float:left"> Social Media and Blogs</label></p>
						<p><input type="checkbox" style="float:left" value="4" name="chkchannel[]" <?php echo (in_array('4', $channels))?'checked':'' ?> onclick="javascript:ACCOUNT.updateChannels(<?php echo $row->id; ?>,'forma_<?php echo $row->id; ?>')"> <label for="ckacc_<?php echo $row->id; ?>" style="float:left"> Cases</label></p>
						<p><input type="checkbox" style="float:left" value="5" name="chkchannel[]" <?php echo (in_array('5', $channels))?'checked':'' ?> onclick="javascript:ACCOUNT.updateChannels(<?php echo $row->id; ?>,'forma_<?php echo $row->id; ?>')"> <label for="ckacc_<?php echo $row->id; ?>" style="float:left"> CDR</label></p>
						</form>
					</td>
					<?php endif; ?>
				</tr>
			<?php endforeach; ?>	
			</tbody>
		</table>		
	</div> 
</div>	