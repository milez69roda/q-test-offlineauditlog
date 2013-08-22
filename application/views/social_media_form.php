<script>

	$(document).ready(function(){
	
		//$('body').off('.alert.data-api');
		
		SOCIALMEDIA = {
			
			save: function( f ){
			
				if( confirm('Are you sure you want to submit?') ){
			
					$.ajax({
						type: 'post',
						url: "client/socialmedia_save/",
						data: $(f).serialize(),
						dataType: 'json',
						success: function(json){
							if(json.status){
							
								COMMON.alert('Submitted', json.msg, 'alert-success', '<?php echo base_url(); ?>overview/socialmedia');									 
								//COMMON.clearForm(f);
							}else{
								//alert(json.msg);
								COMMON.alert('Warning', json.msg, 'alert-error', '');
							}
						},
						error: function(){
							
						}
					});
				}
				
				return false;
			},
			
			getscore: function(){
				var score = 0;
				
				score += parseInt($("#question1").val());
				score += parseInt($("#question2").val());
				score += parseInt($("#question3").val());
				score += parseInt($("#question4").val());
				score += parseInt($("#question5").val());  
				
				$("#score").val(score);
			},
			
			autofill: function( f ){
				
				if( f.value == 'Auto-fail'){
					$('#score').val('0');
				}else{
					this.getscore();
				}
			}
			
		}
		 
	});

</script>  
<div class="row-fluid" style="background-color: #99CCCC">
	<form name="form1" id="form1" action="" method="post" onsubmit="return SOCIALMEDIA.save(this);">
		<input type="hidden" name="ftype" value="new" />
		<fieldset>
			<legend>Social Media and Blogs</legend>
			
			<!--<label class="bold">Review Date</label>
			<input type="text" name="review_date_start" >-->
			
			<label title="WebCSR ID of the agent being audited">Agent Login ID</label>
			<input type="text" name="agent_id" >
			
			<label>Parature Ticket #</label>
			<input type="text" name="audit_identifier" >
			
			<label>Post/Tweet/Ticket Handling</label>
			<select name="question1" id="question1" onchange="SOCIALMEDIA.getscore()">
				<option value="0">0</option>
				<option value="20">20</option>
			</select>
			
			<label>Procedures</label>
			<select name="question2" id="question2" onchange="SOCIALMEDIA.getscore()">
				<option value="0">0</option>
				<option value="25">25</option>
			</select>

			<label>Resolution</label>
			<select name="question3" id="question3" onchange="SOCIALMEDIA.getscore()">
				<option value="0">0</option>
				<option value="30">30</option>
			</select>

			<label>Documentation</label>
			<select name="question4" id="question4" onchange="SOCIALMEDIA.getscore()">
				<option value="0">0</option>
				<option value="10">10</option>
			</select>
			
			<label>Grammar</label>
			<select name="question5" id="question5" onchange="SOCIALMEDIA.getscore()">
				<option value="0">0</option>
				<option value="15">15</option>
			</select>	 
			
			<label>Score</label>
			<input type="text" name="score" id="score" class="disabled" value="0" readonly />
			
			
			<label>Auto-Fail</label>
			<select name="question6" id="question6" onchange="SOCIALMEDIA.autofill(this)">
				<option value="N/A">N/A</option>
				<option value="Auto-fail">Auto-fail</option>
			</select>	 
			
			<!--<label>Auto Fail Comments</label>
			<select name="question7" id="question7">
				<option value="Yes">Yes</option>
				<option value="Auto-fail">Auto-fail</option>			
			</select>	-->
			
			<label>Comments</label>
			<textarea name="comments" id="comments" class="input-xxlarge" maxlength="300"></textarea>
			
			<label>Suggestions for Corrections</label>
			<textarea name="suggestion" id="suggestion" class="input-xxlarge" maxlength="300"></textarea>

			<!--<label>Feedback from Agent/Supervisor</label>
			<textarea name="feedback" id="feedback" class="input-xxlarge"></textarea>-->
			
			<br />
			<button type="submit" class="btn">Submit</button>
		</fieldset>
	</form>	 
</div>	