<script>

	$(document).ready(function(){
	
		//$('body').off('.alert.data-api');
		
		KANACHAT = {
			
			save: function( f ){
				
				/* var form = f;
				
				var heading = 'Confirm';
				var question = 'Are you sure you want to submit?';
				var cancelButtonTxt = 'Cancel';
				var okButtonTxt = 'Confirm';

				var callback = function() {  */
				if( confirm('Are you sure you want to submit?') ){	
					$.ajax({
						type: 'post',
						url: "client/kanachat_save/",
						data: $(f).serialize(),
						dataType: 'json',
						success: function(json){
							if(json.status){
							
								COMMON.alert('Submitted', json.msg, 'alert-success', '<?php echo base_url(); ?>overview/kanachat');									 
								//COMMON.clearForm(form);
							}else{							
								COMMON.alert('Warning', json.msg, 'alert-error', '');
							}
						},
						error: function(){
							
						}
					});
				}; 
				//COMMON.confirm(heading, question, cancelButtonTxt, okButtonTxt, callback);
				
				return false;
			},
			
			getscore: function(){
				var score = 0;
				
				score += parseInt($("#question1").val());
				score += parseInt($("#question2").val());
				score += parseInt($("#question3").val());
				score += parseInt($("#question4").val());
				
				if( $("#question5").val() == 'N/A' ) 
					score += 10;
				
				score += parseInt($("#question6").val()); 
				
				if( $("#question7").val() == 'Autofail'  ){					 
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
<div class="row-fluid" style="background-color:#FCFFCD">
	<form name="form1" id="form1" action="" method="post" onsubmit="return KANACHAT.save(this);">
		<input type="hidden" name="ftype" value="edit" />
		<input type="hidden" name="findex" value="<?php echo $row->id; ?>" />	
		<fieldset>
			<legend>Kana Chat</legend>
			
			<!--<label class="bold">Review Date</label>
			<input type="text" name="review_date_start" >-->
			
			<label title="WebCSR ID of the agent being audited">Agent ID</label>
			<input type="text" name="agent_id" value="<?php echo $row->agent_id; ?>" >
			
			<label>KANA Chat ID #</label>
			<input type="text" name="audit_identifier" value="<?php echo $row->audit_identifier; ?>" >
			
			<label>Did the agent include all necessary information in the chat session?</label>
			<select name="question1" id="question1" onchange="KANACHAT.getscore()">
				<option value="0" <?php echo ($row->question1 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="20" <?php echo ($row->question1 == 20)?'selected="selected"':''; ?>>20</option>
			</select>
			
			<label>Did the agent present an applicable solution?</label>
			<select name="question2" id="question2" onchange="KANACHAT.getscore()">
				<option value="0">0 <?php echo ($row->question2 == 0)?'selected="selected"':''; ?></option>
				<option value="20" <?php echo ($row->question2 == 20)?'selected="selected"':''; ?>>20</option>
			</select>

			<label>Spelling: Were all words spelled correctly?</label>
			<select name="question3" id="question3" onchange="KANACHAT.getscore()">
				<option value="0" <?php echo ($row->question3 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="20" <?php echo ($row->question3 == 20)?'selected="selected"':''; ?>>20</option>
			</select>

			<label>Message Content: Follows grammar, capitalization, and punctuation guidelines</label>
			<select name="question4" id="question4" onchange="KANACHAT.getscore()">
				<option value="0" <?php echo ($row->question4 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="20" <?php echo ($row->question4 == 20)?'selected="selected"':''; ?>>20</option>
			</select>
			
			<label>Did the agent create an interaction or create a case?</label>
			<select name="question5" id="question5" onchange="KANACHAT.getscore()">
				<option value="0" <?php echo ($row->question5 == 0)?'selected="selected"':''; ?>>0</option>
				<!--<option value="10" <?php echo ($row->question5 == 10)?'selected="selected"':''; ?>>10</option>-->
				<option value="N/A" <?php echo ($row->question5 == 'N/A')?'selected="selected"':''; ?>>N/A</option>
			</select>	 
			
			<label>Did the agent provide correct company related info (brand, hours of operation, contact info, etc.)</label>
			<select name="question6" id="question6" onchange="KANACHAT.getscore()">
				<option value="0" <?php echo ($row->question6 == 0)?'selected="selected"':''; ?>>0</option>
				<option value="10" <?php echo ($row->question6 == 10)?'selected="selected"':''; ?>>10</option>
			</select>	 
			
			<label>Score</label>
			<input type="text" name="score" id="score" class="disabled" value="<?php echo $row->score; ?>" readonly />

			<!--<label>Score for Right Interaction</label>
			<input type="text" name="score_interaction" id="score_interaction"  value="0"  />-->
			
			
			<label>Potential Escalation Prevention</label>
			<select name="question7" id="question7" onchange="KANACHAT.autofill(this)">
				<option value="Yes" <?php echo ($row->question7 == 'Yes')?'selected="selected"':''; ?>>Yes</option>
				<option value="Autofail" <?php echo ($row->question7 == 'Autofail')?'selected="selected"':''; ?> >Autofail</option>
				<option value="No" <?php echo ($row->question7 == 'No')?'selected="selected"':''; ?>>No</option>				
			</select>	
			
			<label>Comments</label>
			<textarea name="comments" id="comments" class="input-xxlarge" maxlength="300"><?php echo $row->comments; ?></textarea>
			
			<label>Suggestions for Corrections</label>
			<textarea name="suggestion" id="suggestion" class="input-xxlarge" maxlength="300"><?php echo $row->comments; ?></textarea>

			<!--<label>Feedback from Agent/Supervisor</label>
			<textarea name="feedback" id="feedback" class="input-xxlarge"></textarea>-->
			
			<br />
			<button type="submit" class="btn">Submit</button>
		</fieldset>
	</form>	 
</div>	