<script>

	$(document).ready(function(){
	
		//$('body').off('.alert.data-api');
		
		CASES = {
			
			save: function( f ){
			
				if( confirm('Are you sure you want to submit?') ){
			
					$.ajax({
						type: 'post',
						url: "client/cases_save/",
						data: $(f).serialize(),
						dataType: 'json',
						success: function(json){
							if(json.status){
							
								COMMON.alert('Submitted', json.msg, 'alert-success', '<?php echo base_url(); ?>overview/cases');									 
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
<div class="row-fluid" style="background-color:#99CC99">
	<form name="form1" id="form1" action="" method="post" onsubmit="return CASES.save(this);">
		<input type="hidden" name="ftype" value="edit" />
		<input type="hidden" name="findex" value="<?php echo $row->id; ?>" />		
		<fieldset>
			<legend>Cases</legend>
			
			<!--<label class="bold">Review Date</label>
			<input type="text" name="review_date_start" >-->
			
			<label title="WebCSR ID of the agent being audited">Agent Login ID</label>
			<input type="text" name="agent_id" value="<?php echo $row->agent_id; ?>" >
			
			<label>Case ID #</label>
			<input type="text" name="audit_identifier" value="<?php echo $row->audit_identifier; ?>">
			
			<label>Did agent do everything possible to resolve the customer's issue</label>
			<select name="question1" id="question1" onchange="CASES.getscore()">
				<option value="0" <?php echo ($row->question1 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="35" <?php echo ($row->question1 == 35)?'selected="selected"':''; ?>>35</option>
			</select>
			
			<label>Did agent perform all necessary troubleshooting before reaching out to other departments for assistance (Carrier, Retailers, Corporate, etc.)? </label>
			<select name="question2" id="question2" onchange="CASES.getscore()">
				<option value="0" <?php echo ($row->question2 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="25" <?php echo ($row->question2 == 25)?'selected="selected"':''; ?>>25</option>
			</select>

			<label>Before closing the case, did the agent attempt to contact the customer, via landline or Cell phone to verify if issue was resolved? </label>
			<select name="question3" id="question3" onchange="CASES.getscore()">
				<option value="0" <?php echo ($row->question3 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="15" <?php echo ($row->question3 == 15)?'selected="selected"':''; ?>>15</option>
			</select>

			<label>Was it documented whether the customer was contacted and how many times it was attempted? </label>
			<select name="question4" id="question4" onchange="CASES.getscore()">
				<option value="0" <?php echo ($row->question4 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="15" <?php echo ($row->question4 == 15)?'selected="selected"':''; ?>>15</option>
			</select>
			
			<label>Was the case properly documented?</label>			
			<select name="question5" id="question5" onchange="CASES.getscore()">
				<option value="0" <?php echo ($row->question5 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="10" <?php echo ($row->question5 == 10)?'selected="selected"':''; ?>>10</option>
			</select>	 

			<label>Score</label>
			<input type="text" name="score" id="score" class="disabled" value="<?php echo $row->score; ?>" readonly />
			
			<label>Did agent notate the account correctly?  (Was the toll free number and internal extension documented)?  (Auto-Fail)</label>
			<select name="question6" id="question6" onchange="CASES.autofill(this)">
				<option value="Yes" <?php echo ($row->question6 == 'Yes')?'selected="selected"':''; ?>>Yes</option>
				<option value="Auto-fail" <?php echo ($row->question6 == 'Auto-fail')?'selected="selected"':''; ?>>Auto-fail</option>
			</select>	 
			
			<label>Comments</label>
			<textarea name="comments" id="comments" class="input-xxlarge" maxlength="300"><?php echo $row->comments; ?></textarea>
			
			<label>Suggestions for Corrections</label>
			<textarea name="suggestion" id="suggestion" class="input-xxlarge" maxlength="300"><?php echo $row->suggestion; ?></textarea>

			<label>Reopened Case</label>
			<select name="reopened" id="reopened" >
				<option value="No" <?php echo ($row->reopened == 'No')?'selected="selected"':''; ?>>No</option>
				<option value="Yes" <?php echo ($row->reopened == 'Yes')?'selected="selected"':''; ?>>Yes</option>
			</select>	
			
			<br />
			<button type="submit" class="btn">Submit</button>
		</fieldset>
	</form>	 
</div>	