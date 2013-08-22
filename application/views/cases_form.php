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
		<input type="hidden" name="ftype" value="new" />
		<fieldset>
			<legend>Cases</legend>
			
			<!--<label class="bold">Review Date</label>
			<input type="text" name="review_date_start" >-->
			
			<label title="WebCSR ID of the agent being audited">Agent Login ID</label>
			<input type="text" name="agent_id" >
			
			<label>Case ID #</label>
			<input type="text" name="audit_identifier" >
			
			<label>Did agent do everything possible to resolve the customer's issue</label>
			<select name="question1" id="question1" onchange="CASES.getscore()">
				<option value="0">0</option>
				<option value="35">35</option>
			</select>
			
			<label>Did agent perform all necessary troubleshooting before reaching out to other departments for assistance (Carrier, Retailers, Corporate, etc.)? </label>
			<select name="question2" id="question2" onchange="CASES.getscore()">
				<option value="0">0</option>
				<option value="25">25</option>
			</select>

			<label>Before closing the case, did the agent attempt to contact the customer, via landline or Cell phone to verify if issue was resolved? </label>
			<select name="question3" id="question3" onchange="CASES.getscore()">
				<option value="0">0</option>
				<option value="15">15</option>
			</select>

			<label>Was it documented whether the customer was contacted and how many times it was attempted? </label>
			<select name="question4" id="question4" onchange="CASES.getscore()">
				<option value="0">0</option>
				<option value="15">15</option>
			</select>
			
			<label>Was the case properly documented?</label>			
			<select name="question5" id="question5" onchange="CASES.getscore()">
				<option value="0">0</option>
				<option value="10">10</option>
			</select>	 

			<label>Score</label>
			<input type="text" name="score" id="score" class="disabled" value="0" readonly />
			
			<label>Did agent notate the account correctly?  (Was the toll free number and internal extension documented)?  (Auto-Fail)</label>
			<select name="question6" id="question6" onchange="CASES.autofill(this)">
				<option value="Yes">Yes</option>
				<option value="Auto-fail">Auto-fail</option>
			</select>	 
			
			<label>Comments</label>
			<textarea name="comments" id="comments" class="input-xxlarge" maxlength="300"></textarea>
			
			<label>Suggestions for Corrections</label>
			<textarea name="suggestion" id="suggestion" class="input-xxlarge" maxlength="300"></textarea>

			<label>Reopened Case</label>
			<select name="reopened" id="reopened" >
				<option value="No">No</option>
				<option value="Yes">Yes</option>
			</select>	
			
			<br />
			<button type="submit" class="btn">Submit</button>
		</fieldset>
	</form>	 
</div>	