<script>

	$(document).ready(function(){
	
		//$('body').off('.alert.data-api');
		
		KANAEMAIL = {
			
			save: function( f ){
			
				if( confirm('Are you sure you want to submit?') ){
			
					$.ajax({
						type: 'post',
						url: "client/kanaemail_save/",
						data: $(f).serialize(),
						dataType: 'json',
						success: function(json){
							if(json.status){
							
								COMMON.alert('Submitted', json.msg, 'alert-success', '<?php echo base_url(); ?>overview/kanaemail');	
								
								/* setTimeout(300,function(){
									window.location = 'kanaemail';
								}) */
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
				
				if( $("#question4").val() == 'N/A' ) 
					score += 10;
					
				score += parseInt($("#question5").val()); 
				
				if( $("#question6").val() == 'Autofail' || $("#question7").val() == 'Autofail'  ){					 
					$("#score").val(0);
				}else{ 
					$("#score").val(score);
				}
			},
			
			autofill: function( f ){
				
				if( f.value == 'Autofail'){
					$('#score').val('0');
				}else{
					this.getscore();
				}
			}			
			
		}
		 
	});

</script> 

<div class="row-fluid" style="background-color: #CFCDFF;">
	<?php //print_r($row); ?>
	<form name="form1" id="form1" action="" method="post" onsubmit="return KANAEMAIL.save(this);">
		<input type="hidden" name="ftype" value="edit" />
		<input type="hidden" name="findex" value="<?php echo $row->id; ?>" />
		<fieldset>
			<legend>Kana Email</legend>
			
			<!--<label class="bold">Review Date</label>
			<input type="text" name="review_date_start" >-->
			
			<label>Agent Login ID</label>
			<input type="text" name="agent_id" value="<?php echo $row->agent_id; ?>">
			
			<label>Kana Email ID</label>
			<input type="text" name="audit_identifier" value="<?php echo $row->audit_identifier; ?>" >
			
			<label>Agent correctly identified and addressed customers concern with all the necessary information?</label>
			<select name="question1" id="question1" onchange="KANAEMAIL.getscore()">
				<option value="0" <?php echo ($row->question1 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="30" <?php echo ($row->question1 == 30)?'selected="selected"':''; ?>>30</option>
			</select>
			
			<label>Did the agent present an applicable solution?</label>
			<select name="question2" id="question2" onchange="KANAEMAIL.getscore()">
				<option value="0" <?php echo ($row->question2 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="25" <?php echo ($row->question2 == 25)?'selected="selected"':''; ?>>25</option>
			</select>

			<label>Spelling/Grammer: Were all words spelled correctly and message content followed correct grammar guidelines</label>
			<select name="question3" id="question3" onchange="KANAEMAIL.getscore()">
				<option value="0" <?php echo ($row->question3 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="25" <?php echo ($row->question3 == 25)?'selected="selected"':''; ?>>25</option>
			</select>

			<label>Did the agent create an interaction or create a case?</label>
			<select name="question4" id="question4" onchange="KANAEMAIL.getscore()">
				<option value="0" <?php echo ($row->question4 == 0)?'selected="selected"':''; ?>>0</option>
				<!--<option value="10" <?php echo ($row->question4 == 10)?'selected="selected"':''; ?>>10</option>-->
				<option value="N/A" <?php echo ($row->question4 == 'N/A')?'selected="selected"':''; ?>>N/A</option>
			</select>
			
			<label>Did the agent provide correct company related info (brand, hours of operation, contact info, etc.)</label>
			<select name="question5" id="question5" onchange="KANAEMAIL.getscore()">
				<option value="0" <?php echo ($row->question5 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="10" <?php echo ($row->question5 == 10)?'selected="selected"':''; ?>>10</option>
			</select>	 
			
			<label>Score</label>
			<input type="text" name="score" id="score" class="disabled" value="<?php echo $row->score; ?>" readonly />
			
			<!--<label>Score for Right Interaction</label>
			<input type="text" name="score_interaction" id="score_interaction"  value="0"  />-->
			
			<label>Potential Escalation Prevention?</label>
			<select name="question6" id="question6" onchange="KANAEMAIL.autofill(this)">
				<option value="Yes" <?php echo ($row->question6 == 'Yes')?'selected="selected"':''; ?>>Yes</option>
				<option value="Autofail" <?php echo ($row->question6 == 'Autofail')?'selected="selected"':''; ?>>Autofail</option>
				<option value="NA" <?php echo ($row->question6 == 'NA')?'selected="selected"':''; ?>>NA</option>
			</select>
			
			<label>Was email routed correctly?</label>
			<select name="question7" id="question7" onchange="KANAEMAIL.autofill(this)">
				<option value="Yes" <?php echo ($row->question7 == 'Yes')?'selected="selected"':''; ?>>Yes</option>
				<option value="Autofail" <?php echo ($row->question7 == 'Autofail')?'selected="selected"':''; ?>>Autofail</option>
				<option value="NA" <?php echo ($row->question7 == 'NA')?'selected="selected"':''; ?>>NA</option>
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