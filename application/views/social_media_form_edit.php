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
		<input type="hidden" name="ftype" value="edit" />
		<input type="hidden" name="findex" value="<?php echo $row->id; ?>" />	
		<fieldset>
			<legend>Social Media and Blogs</legend>
			
			<!--<label class="bold">Review Date</label>
			<input type="text" name="review_date_start" >-->
			
			<label title="WebCSR ID of the agent being audited">Agent Login ID</label>
			<input type="text" name="agent_id" value="<?php echo $row->agent_id; ?>">
			
			<label>Parature Ticket #</label>
			<input type="text" name="audit_identifier" value="<?php echo $row->audit_identifier; ?>">
			
			<label>Post/Tweet/Ticket Handling</label>
			<select name="question1" id="question1" onchange="SOCIALMEDIA.getscore()">
				<option value="0" <?php echo ($row->question1 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="20" <?php echo ($row->question1 == 20)?'selected="selected"':''; ?>>20</option>
			</select>
			
			<label>Procedures</label>
			<select name="question2" id="question2" onchange="SOCIALMEDIA.getscore()">
				<option value="0" <?php echo ($row->question2 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="25" <?php echo ($row->question2 == 25)?'selected="selected"':''; ?>>25</option>
			</select>

			<label>Resolution</label>
			<select name="question3" id="question3" onchange="SOCIALMEDIA.getscore()">
				<option value="0" <?php echo ($row->question3 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="30" <?php echo ($row->question3 == 30)?'selected="selected"':''; ?>>30</option>
			</select>

			<label>Documentation</label>
			<select name="question4" id="question4" onchange="SOCIALMEDIA.getscore()">
				<option value="0" <?php echo ($row->question4 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="10" <?php echo ($row->question4 == 10)?'selected="selected"':''; ?>>10</option>
			</select>
			
			<label>Grammar</label>
			<select name="question5" id="question5" onchange="SOCIALMEDIA.getscore()">
				<option value="0" <?php echo ($row->question5 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="15" <?php echo ($row->question5 == 15)?'selected="selected"':''; ?>>15</option>
			</select>	 
			
			<label>Score</label>
			<input type="text" name="score" id="score" class="disabled" value="<?php echo $row->score; ?>" readonly />
			
			
			<label>Auto-Fail</label>
			<select name="question6" id="question6" onchange="SOCIALMEDIA.autofill(this)">
				<option value="N/A" <?php echo ($row->question6 == 'N/A')?'selected="selected"':''; ?>>N/A</option>
				<option value="Auto-fail" <?php echo ($row->question6 == 'Auto-fail')?'selected="selected"':''; ?>>Auto-fail</option>
			</select>	 
			
			<!--<label>Auto Fail Comments</label>
			<select name="question7" id="question7">
				<option value="Yes">Yes</option>
				<option value="Auto-fail">Auto-fail</option>			
			</select>	-->
			
			<label>Comments</label>
			<textarea name="comments" id="comments" class="input-xxlarge" maxlength="300"><?php echo $row->comments; ?></textarea>
			
			<label>Suggestions for Corrections</label>
			<textarea name="suggestion" id="suggestion" class="input-xxlarge" maxlength="300"><?php echo $row->suggestion; ?></textarea>

			<!--<label>Feedback from Agent/Supervisor</label>
			<textarea name="feedback" id="feedback" class="input-xxlarge"></textarea>-->
			
			<br />
			<button type="submit" class="btn">Submit</button>
		</fieldset>
	</form>	 
</div>	