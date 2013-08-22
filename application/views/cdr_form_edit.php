<script>

	$(document).ready(function(){
	
		//$('body').off('.alert.data-api');
		
		CDR = {
			
			save: function( f ){
			
				if( confirm('Are you sure you want to submit?') ){
			
					$.ajax({
						type: 'post',
						url: "client/cdr_save/",
						data: $(f).serialize(),
						dataType: 'json',
						success: function(json){
							if(json.status){
							
								COMMON.alert('Submitted', json.msg, 'alert-success', '<?php echo base_url(); ?>overview/cdr');									 
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
<div class="row-fluid" style="background-color:#F4C090">
	<form name="form1" id="form1" action="" method="post" onsubmit="return CDR.save(this);">
		<input type="hidden" name="ftype" value="edit" />
		<input type="hidden" name="findex" value="<?php echo $row->id; ?>" />		
		<fieldset>
			<legend>CDR</legend>
			
			<!--<label class="bold">Review Date</label>
			<input type="text" name="review_date_start" >-->
			
			<label title="WebCSR ID of the agent being audited">Agent Login ID</label>
			<input type="text" name="agent_id" value="<?php echo $row->agent_id; ?>">
			
			<label>Kana Case ID</label>
			<input type="text" name="kana_case_id" value="<?php echo $row->kana_case_id; ?>">
			
			<label>CA Ticket #</label>
			<input type="text" name="audit_identifier" value="<?php echo $row->audit_identifier; ?>">
			
			<label>Did the agent include all necessary information in CA? (30)</label>
			<select name="question1" id="question1" onchange="CDR.getscore()">
				<option value="0" <?php echo ($row->question1 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="30" <?php echo ($row->question1 == 20)?'selected="selected"':''; ?>>30</option>
			</select>
			
			<label>Did the agent follow the correct procedure for authentication? (25)</label>
			<select name="question2" id="question2" onchange="CDR.getscore()">
				<option value="0" <?php echo ($row->question2 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="25" <?php echo ($row->question2 == 25)?'selected="selected"':''; ?>>25</option>
			</select>

			<label>Did the agent present an applicable solution? (25)</label>
			<select name="question3" id="question3" onchange="CDR.getscore()">
				<option value="0" <?php echo ($row->question3 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="25" <?php echo ($row->question3 == 25)?'selected="selected"':''; ?>>25</option>
			</select>

			<label>Did the agent create an interaction? (20)</label>
			<select name="question4" id="question4" onchange="CDR.getscore()">
				<option value="0" <?php echo ($row->question4 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="20" <?php echo ($row->question4 == 20)?'selected="selected"':''; ?>>20</option>
			</select>
			
			<label>Score</label>
			<input type="text" name="score" id="score" class="disabled" value="<?php echo $row->score; ?>" readonly />			
			
			<label>Potential Escalation Prevention</label>			
			<select name="question5" id="question5" onchange="CDR.autofill(this)">
				<option value="Yes" <?php echo ($row->question5 == 'Yes')?'selected="selected"':''; ?>>Yes</option>
				<option value="Auto-fail" <?php echo ($row->question5 == 'Auto-fail')?'selected="selected"':''; ?>>Auto-fail</option>
			</select>	 
  
			
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