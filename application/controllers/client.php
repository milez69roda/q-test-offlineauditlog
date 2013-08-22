<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Controller {
	
	public $auditor_id = '';
	public $ch_access = array();
	public $ch_first = '';
	public $channels = array();
	
	
	public function __construct(){
		
		parent::__construct();
		
		if( !$this->session->userdata('OFFAL_ISLOGIN') ){
		 	redirect(base_url().'login');
		}

		$this->auditor_id = $this->session->userdata('OFFAL_AUDITOR_CODE'); 
		
		$this->ch_access = $this->session->userdata('OFFAL_ACCESS');
		$this->channels = $this->session->userdata('OFFAL_CHANNELS');
		 
		if( count($this->ch_access) > 0  ) $this->ch_first = $this->ch_access[0];
		else $this->ch_first = 1;
		 
	}
 
	public function index(){
	
		$hdata['nactive'] = 'home';
		$this->load->view('header', $hdata );
		$this->load->view('index');
		$this->load->view('footer');
	}
	
	/* public function login(){ 
		$this->load->view('login'); 
	} */
		
	
	public function kanaemail(){
	
		if( isset($_GET['edit']) AND $_GET['edit'] != '' ){
		
			$this->db->where('id', $_GET['edit']);
			$data['row']	= $this->db->get('kana_email')->row();
			//echo $this->db->last_query();
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('kana_email_form_edit', $data);
			$this->load->view('footer');						
		}else{
	  
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('kana_email_form');
			$this->load->view('footer');
		
		}
		 
	}
	
	public function kanaemail_save(){
		$json = array('status'=>false, 'msg'=>'Failed to submit');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('agent_id', 'Kana Login ID', 'required');
		$this->form_validation->set_rules('audit_identifier', 'Email Case ID', 'required');
		$this->form_validation->set_rules('comments', 'Comments', 'max_length[300]');
		$this->form_validation->set_rules('suggestion', 'Suggestions for Corrections', 'max_length[300]');
		
		if( $this->form_validation->run() ) {
		
			
			$set['agent_id'] 			= $this->input->post('agent_id');
			$set['audit_identifier']	= $this->input->post('audit_identifier');
			$set['question1'] 			= $this->input->post('question1');
			$set['question2'] 			= $this->input->post('question2');
			$set['question3'] 			= $this->input->post('question3');
			$set['question4'] 			= $this->input->post('question4');
			$set['question5'] 			= $this->input->post('question5');
			$set['question6'] 			= $this->input->post('question6');
			$set['question7'] 			= $this->input->post('question7');
			//$set['score_interaction'] 	= $this->input->post('score_interaction');
			$set['score'] 				= $this->input->post('score');
			$set['comments'] 			= $this->input->post('comments');
			$set['suggestion'] 			= $this->input->post('suggestion');
			
			//$set['feedback'] 			= $this->input->post('feedback');
			$set['updated_date'] 		= date('Y-m-d H:i:s');
			
			if( $this->input->post('ftype') == 'edit' ){
				
				$set['updated_by'] 			= $this->auditor_id;
				
				
				$this->db->where('id', $this->input->post('findex'));
				if( $this->db->update('kana_email', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Update Successfully!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}				
			}else{
				$set['review_date_start'] 	= date('Y-m-d H:i:s');
				$set['audit_code'] 			= $this->auditor_id;
				$set['ip_address'] 			= $_SERVER['REMOTE_ADDR'];			
				if( $this->db->insert('kana_email', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Succesfully Submitted!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}
			}
			
		}else{			
			$json['msg'] = validation_errors();
		}		
		
		echo json_encode($json);
		
	}
	 
	public function kanachat(){
	  
		if( isset($_GET['edit']) AND $_GET['edit'] != '' ){
		
			$this->db->where('id', $_GET['edit']);
			$data['row']	= $this->db->get('kana_chat')->row();
			 
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('kana_chat_form_edit', $data);
			$this->load->view('footer');						
		}else{
	  
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('kana_chat_form');
			$this->load->view('footer');
		
		}		
		
	}
	
	public function kanachat_save(){
		$json = array('status'=>false, 'msg'=>'Failed to submit');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('agent_id', 'Kana Login ID', 'required');
		$this->form_validation->set_rules('audit_identifier', 'KANA Chat ID #', 'required');
		
		if( $this->form_validation->run() ) {
		
			
			$set['agent_id'] 			= $this->input->post('agent_id');
			$set['audit_identifier']	= $this->input->post('audit_identifier');
			$set['question1'] 			= $this->input->post('question1');
			$set['question2'] 			= $this->input->post('question2');
			$set['question3'] 			= $this->input->post('question3');
			$set['question4'] 			= $this->input->post('question4');
			$set['question5'] 			= $this->input->post('question5');
			$set['question6'] 			= $this->input->post('question6');
			$set['question7'] 			= $this->input->post('question7');
			$set['score'] 				= $this->input->post('score');
			//$set['score_interaction'] 	= $this->input->post('score_interaction');
			$set['comments'] 			= $this->input->post('comments');
			$set['suggestion'] 			= $this->input->post('suggestion');
			//$set['feedback'] 			= $this->input->post('feedback');
			
			$set['updated_date'] 		= date('Y-m-d H:i:s');
			if( $this->input->post('ftype') == 'edit' ){
			
				$set['updated_by'] 			= $this->auditor_id;
				
				
				$this->db->where('id', $this->input->post('findex'));
				if( $this->db->update('kana_chat', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Update Successfully!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}			
			
			}else{
				$set['review_date_start'] 	= date('Y-m-d H:i:s');
				$set['audit_code'] 			= $this->auditor_id;
				$set['ip_address'] 			= $_SERVER['REMOTE_ADDR'];			
				if( $this->db->insert('kana_chat', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Succesfully Submitted!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}
			}
			
		}else{			
			$json['msg'] = validation_errors();
		}		
		
		echo json_encode($json);
		
	}	
	
	public function socialmedia(){
	
		if( isset($_GET['edit']) AND $_GET['edit'] != '' ){
		
			$this->db->where('id', $_GET['edit']);
			$data['row']	= $this->db->get('social_media')->row();
			 
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('social_media_form_edit', $data);
			$this->load->view('footer');						
		}else{
		
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('social_media_form');
			$this->load->view('footer');
		
		}
		
	}	
	
	
	public function socialmedia_save(){
		$json = array('status'=>false, 'msg'=>'Failed to submit');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('agent_id', 'Agent Login ID', 'required');
		$this->form_validation->set_rules('audit_identifier', 'Parature Ticket #', 'required');
		$this->form_validation->set_rules('comments', 'Comments', 'max_length[300]');
		$this->form_validation->set_rules('suggestion', 'Suggestions for Corrections', 'max_length[300]');
		
		if( $this->form_validation->run() ) {
		
			
			$set['agent_id'] 			= $this->input->post('agent_id');
			$set['audit_identifier']	= $this->input->post('audit_identifier');
			$set['question1'] 			= $this->input->post('question1');
			$set['question2'] 			= $this->input->post('question2');
			$set['question3'] 			= $this->input->post('question3');
			$set['question4'] 			= $this->input->post('question4');
			$set['question5'] 			= $this->input->post('question5');
			$set['question6'] 			= $this->input->post('question6');
			//$set['question7'] 		= $this->input->post('question7');			  
			$set['score'] 				= ( $this->input->post('question6') == 'Auto-fail' )?0:$this->input->post('score');						
			$set['comments'] 			= $this->input->post('comments');
			$set['suggestion'] 			= $this->input->post('suggestion');
			
			//$set['feedback'] 			= $this->input->post('feedback');

			$set['updated_date'] 		= date('Y-m-d H:i:s');
			if( $this->input->post('ftype') == 'edit' ){
			
				$set['updated_by'] 			= $this->auditor_id;
				
				
				$this->db->where('id', $this->input->post('findex'));
				if( $this->db->update('social_media', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Update Successfully!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}			
			
			}else{	
				$set['review_date_start'] 	= date('Y-m-d H:i:s');
				$set['audit_code'] 			= $this->auditor_id;
				$set['ip_address'] 			= $_SERVER['REMOTE_ADDR'];	
				
				if( $this->db->insert('social_media', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Succesfully Submitted!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}
			}
			
		}else{			
			$json['msg'] = validation_errors();
		}		
		
		echo json_encode($json);
		
	}	
	
	public function cases(){
	
		if( isset($_GET['edit']) AND $_GET['edit'] != '' ){
		
			$this->db->where('id', $_GET['edit']);
			$data['row']	= $this->db->get('cases')->row();
			 
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('cases_form_edit', $data);
			$this->load->view('footer');						
		}else{	
	
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('cases_form');
			$this->load->view('footer');
		
		}
		
	}	

	public function cases_save(){
		$json = array('status'=>false, 'msg'=>'Failed to submit');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('agent_id', 'Agent Login ID', 'required');
		$this->form_validation->set_rules('audit_identifier', 'Case ID #', 'required');
		$this->form_validation->set_rules('comments', 'Comments', 'max_length[300]');
		$this->form_validation->set_rules('suggestion', 'Suggestions for Corrections', 'max_length[300]');
		
		if( $this->form_validation->run() ) {
		
			
			$set['agent_id'] 			= $this->input->post('agent_id');
			$set['audit_identifier']	= $this->input->post('audit_identifier');
			$set['question1'] 			= $this->input->post('question1');
			$set['question2'] 			= $this->input->post('question2');
			$set['question3'] 			= $this->input->post('question3');
			$set['question4'] 			= $this->input->post('question4');
			$set['question5'] 			= $this->input->post('question5');
			$set['question6'] 			= $this->input->post('question6');	
			$set['score'] 				= $this->input->post('score');	
			$set['comments'] 			= $this->input->post('comments');
			$set['suggestion'] 			= $this->input->post('suggestion');
			$set['reopened'] 			= $this->input->post('reopened');
			//$set['feedback'] 			= $this->input->post('feedback'); 
			$set['updated_date'] 		= date('Y-m-d H:i:s');
			
			if( $this->input->post('ftype') == 'edit' ){
			
				$set['updated_by'] 			= $this->auditor_id;
				
				
				$this->db->where('id', $this->input->post('findex'));
				if( $this->db->update('cases', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Update Successfully!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}			
			
			}else{	
				$set['review_date_start'] 	= date('Y-m-d H:i:s');
				$set['audit_code'] 			= $this->auditor_id;
				$set['ip_address'] 			= $_SERVER['REMOTE_ADDR'];
				
				if( $this->db->insert('cases', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Succesfully Submitted!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}
			}
		}else{			
			$json['msg'] = validation_errors();
		}		
		
		echo json_encode($json);
		
	}	
		
	public function cdr(){
	
		if( isset($_GET['edit']) AND $_GET['edit'] != '' ){
		
			$this->db->where('id', $_GET['edit']);
			$data['row']	= $this->db->get('cdr')->row();
			 
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('cdr_form_edit', $data);
			$this->load->view('footer');						
		}else{	
			
			$hdata['nactive'] = 'channel';
			$this->load->view('header', $hdata );
			$this->load->view('cdr_form');
			$this->load->view('footer');
			
		}
		
	}	

	public function cdr_save(){
		$json = array('status'=>false, 'msg'=>'Failed to submit');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('agent_id', 'Agent Login ID', 'required');
		$this->form_validation->set_rules('kana_case_id', 'Kana Case ID', 'required');
		$this->form_validation->set_rules('audit_identifier', 'CA Ticket #', 'required');
		$this->form_validation->set_rules('comments', 'Comments', 'max_length[300]');
		$this->form_validation->set_rules('suggestion', 'Suggestions for Corrections', 'max_length[300]');		
		
		if( $this->form_validation->run() ) {
		
			
			$set['agent_id'] 			= $this->input->post('agent_id');
			$set['kana_case_id'] 		= $this->input->post('kana_case_id');
			$set['audit_identifier']	= $this->input->post('audit_identifier');
			$set['question1'] 			= $this->input->post('question1');
			$set['question2'] 			= $this->input->post('question2');
			$set['question3'] 			= $this->input->post('question3');
			$set['question4'] 			= $this->input->post('question4');
			$set['question5'] 			= $this->input->post('question5');
			$set['score'] 				= $this->input->post('score');	
			$set['comments'] 			= $this->input->post('comments');
			$set['suggestion'] 			= $this->input->post('suggestion');
			//$set['feedback'] 			= $this->input->post('feedback');
			
			$set['updated_date'] 		= date('Y-m-d H:i:s');
			
			if( $this->input->post('ftype') == 'edit' ){
			
				$set['updated_by'] 			= $this->auditor_id;
				
				
				$this->db->where('id', $this->input->post('findex'));
				if( $this->db->update('cdr', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Update Successfully!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}			
			
			}else{
			
				$set['review_date_start'] 	= date('Y-m-d H:i:s');
				$set['audit_code'] 			= $this->auditor_id;
				$set['ip_address'] 			= $_SERVER['REMOTE_ADDR'];			
				
				if( $this->db->insert('cdr', $set) ){
					$json['status'] = true;	
					$json['msg'] = 'Succesfully Submitted!!!';
				}else{
					$json['msg'] = 'Failed to submit the form';
				}
			}
			
		}else{			
			$json['msg'] = validation_errors();
		}		
		
		echo json_encode($json);
		
	}	
	
	public function overview(){
		 
		$first = $this->channels[$this->ch_first]->ch_link; 
		redirect('overview/'.$first);
		
	}
	
	public function overview_kanaemail(){
		$hdata['container'] = 'container-fluid';
		$hdata['nactive'] = 'overview';
		
		$data['nav'] = $this->load->view('channels_nav', '', true);
		
		$this->load->view('header',$hdata);
		$this->load->view('kanaemail_list', $data);
		$this->load->view('footer');
		
	}

	public function ajax_get_kanaemail(){
		
		$this->load->model("Kanaemail_Model", 'kanaemail');
		$this->kanaemail->get('');
		
	}	 
	
	
	public function overview_kanachat(){
		$hdata['container'] = 'container-fluid';
		$hdata['nactive'] = 'overview';
		
		$data['nav'] = $this->load->view('channels_nav', '', true);
		 
		$this->load->view('header', $hdata);
		$this->load->view('kanachat_list', $data);
		$this->load->view('footer');	
	}
	 
	public function ajax_get_kanachat(){
		
		$this->load->model("Kanachat_Model", 'kanachat');
		$this->kanachat->get();
		
	}
	
	public function overview_socialmedia(){
		$hdata['container'] = 'container-fluid';
		$hdata['nactive'] = 'overview';
		
		$data['nav'] = $this->load->view('channels_nav', '', true);
		 
		$this->load->view('header', $hdata);
		$this->load->view('socialmedia_list', $data);
		$this->load->view('footer');	
	}
	 
	public function ajax_get_socialmedia(){
		
		$this->load->model("Socialmedia_Model", 'socialmedia');
		$this->socialmedia->get();
		
	}	
	
	public function overview_cases(){
		$hdata['container'] = 'container-fluid';
		$hdata['nactive'] = 'overview';
		
		$data['nav'] = $this->load->view('channels_nav', '', true);
		 
		$this->load->view('header', $hdata);
		$this->load->view('cases_list', $data);
		$this->load->view('footer');	
	}
	 
	public function ajax_get_cases(){
		
		$this->load->model("Cases_Model", 'cases');
		$this->cases->get();
		
	}	
	
	public function overview_cdr(){
		$hdata['container'] = 'container-fluid';
		$hdata['nactive'] = 'overview';
		
		$data['nav'] = $this->load->view('channels_nav', '', true);
		 
		$this->load->view('header', $hdata);
		$this->load->view('cdr_list', $data);
		$this->load->view('footer');	
	}
	 
	public function ajax_get_cdr(){
		
		$this->load->model("Cdr_Model", 'cdr');
		$this->cdr->get();
		
	}

	public function myaccount(){
		$hdata['nactive'] = 'home';
		$data = '';
		
		$data['nav'] = $this->load->view('myaccount_nav', '', true);
		$this->load->view('header', $hdata);
		$this->load->view('myaccount', $data);
		$this->load->view('footer');	
	}
	
	public function ajax_changepassword(){
		
		$json = array('status'=>false,'msg'=>'Failed to change password');
		
		if( trim($this->input->post('pass45')) != '' ){
			$this->db->where('username', $this->auditor_id );
			$set['password'] 		= strtolower($this->input->post('pass45'));
			$set['newpass_time'] 	= strtotime(date('Y-m-d H:i:s'));
			$set['modified'] 		= date('Y-m-d H:i:s');
			
			if($this->db->update('users',$set)){
				$json['status'] = true;
				$json['msg'] 	= 'Password Changed Successfully';
			}
		
		}else{
			$json['msg'] 	= 'Password must not be empty';
		}
		
		echo json_encode($json);
	}
	
	public function manageaccount(){
		$hdata['nactive'] = 'home';
		$data = '';
		//echo  'tes tes test'.$this->session->userdata('OFFAL_ROLEID');
		$where = '';
		if( $this->session->userdata('OFFAL_ROLEID') == 1 )	{
			$this->db->where(' role_id != ', '1', false);	
			
		}else{
			$this->db->where('isVisible', 1);
		}
		
		$data['users'] = $this->db->get('users')->result();
		//echo $this->db->last_query();
		$data['nav'] = $this->load->view('myaccount_nav', '', true);
		$this->load->view('header', $hdata);
		$this->load->view('manageaccount', $data);
		$this->load->view('footer');	
	}
	
	public function ajax_saveuserschannels(){
		
		$json = array('status'=>false, 'msg'=>'Failed to update');
			
		$set['access'] = implode(',', $this->input->post('chkchannel'));		
		$this->db->where('id', $this->input->post('id'));
		if( $this->db->update('users', $set) ){
			$json['status'] = true;
			$json['msg'] = 'Updated successfully';
		}
		
		echo json_encode($json);
	}
	
	public function excel(){
		
		$channel = $_GET['ch'];
		
		
		
		
		$this->load->library('ExportDataExcel');  
		 			 
		$excel = new ExportDataExcel('browser');
		$excel->filename = $channel.'_'.strtotime('now').".xls";

		$header = ''; 
		switch($channel){
			case 'kana_email':
				$this->db->select('DATE_FORMAT(review_date_start, \'%m/%d/%y %H:%i\'), agent_id, audit_identifier, question1, question2, question3, question4, question5, question6, question7, score, comments, suggestion, feedback, audit_code',false);
				$header = array('Review Date',
								'Agent Login ID',
								'Kana Email ID',
								'Agent correctly identified and address customers concern with all the necessary information?',
								'Did the agent present an applicable solution?',
								'Spelling/Grammer: Were all words spelled correctly and message content follow correct grammar guidelines',
								'Did the agent create an interaction or create a case?',
								'Did the agent provide correct company related info (brand, hours of operation, contact info, etc.)', 
								'Potential Escalation Prevention?',
								'Was email routed correctly?',
								'Score',					
								'Comments',
								'Suggestions for Corrections',
								'Feedback',
								'Audit Code'								
								);
				if( isset($_GET['from']) ) {
					$this->db->where(' DATE_FORMAT(review_date_start, \'%Y-%m-%d\') BETWEEN ', "'".$_GET['from']."' AND '".$_GET['to']."'", false); 
				}	
				$this->db->order_by('review_date_start', 'desc');	
				$records = $this->db->get('kana_email')->result(); 				
				break;			
			case 'kana_chat':
				$this->db->select('DATE_FORMAT(review_date_start, \'%m/%d/%y %H:%i\'), agent_id, audit_identifier, question1, question2, question3, question4, question5, question6, question7, score, comments, suggestion, feedback, audit_code', false);
				$header = array('Review Date',
								'Agent ID ',
								'Kana Chat ID #',
								'Did the agent include all necessary information in the chat session?',
								'Did the agent present an applicable solution?',
								'Spelling: Were all words spelled correctly?',
								'Message Content: Follows grammar, capitalization, and punctuation guidelines',
								'Did the agent create an interaction or create a case?',
								'Did the agent provide correct company related info (brand, hours of operation, contact info, etc.)',
								'Potential Escalation Prevention',
								'Score', 
								'Comments',
								'Suggestions for Corrections',
								'Feedback',
								'Audit Code'								
								);
				if( isset($_GET['from']) ) {
					$this->db->where(' DATE_FORMAT(review_date_start, \'%Y-%m-%d\') BETWEEN ', "'".$_GET['from']."' AND '".$_GET['to']."'", false); 
				}	
				$this->db->order_by('review_date_start', 'desc');	
				$records = $this->db->get('kana_chat')->result(); 				
				break;			
			case 'social_media':
				$this->db->select('DATE_FORMAT(review_date_start, \'%m/%d/%y %H:%i\'), agent_id, audit_identifier, question1, question2, question3, question4, question5, question6, score, comments, suggestion, feedback, audit_code', false);
				$header = array('Review Date', 
								'Agent ID ', 
								'Parature Ticket #', 
								'Post/Tweet/Ticket Handling', 
								'Procedures', 
								'Resolution', 
								'Documentation', 
								'Grammar',  
								'Auto-Fail',  
								'Score', 
								'Comments', 
								'Suggestions for Corrections',
								'Feedback',								
								'Audit Code'								
								);
				if( isset($_GET['from']) ) {
					$this->db->where(' DATE_FORMAT(review_date_start, \'%Y-%m-%d\') BETWEEN ', "'".$_GET['from']."' AND '".$_GET['to']."'", false); 
				}		
				$this->db->order_by('review_date_start', 'desc');
				$records = $this->db->get('social_media')->result(); 				
				break;			
			case 'cases':
				$this->db->select('DATE_FORMAT(review_date_start, \'%m/%d/%y %H:%i\'), agent_id, audit_identifier, question1, question2, question3, question4, question5, question6, score, comments, suggestion, feedback, audit_code', false);
				$header = array('Review Date',
								'Agent ID ',
								'Case ID #',
								'Did agent do everything possible to resolve the customer\'s issue',
								'Did agent perform all necessary troubleshooting before reaching out to other departments for assistance (Carrier, Retailers, Corporate, etc.)? ',
								'Before closing the case, did the agent attempt to contact the customer, via landline or Cell phone to verify if issue was resolved? ',
								'Was it documented whether the customer was contacted and how many times it was attempted? ',
								'Was the case properly documented?', 
								'Did agent notate the account correctly? (Was the toll free number and internal extension documented)? (Auto-Fail)', 
								'Score',
								'Comments',
								'Suggestions for Corrections',
								'TF Miami Feedback',		
								'Audit Code'								
								);
				if( isset($_GET['from']) ) {
					$this->db->where(' DATE_FORMAT(review_date_start, \'%Y-%m-%d\') BETWEEN ', "'".$_GET['from']."' AND '".$_GET['to']."'", false); 
				}		
				$this->db->order_by('review_date_start', 'desc');
				$records = $this->db->get('cases')->result(); 				
				break;			
			case 'cdr':
				$this->db->select('DATE_FORMAT(review_date_start, \'%m/%d/%y %H:%i\'), kana_case_id, agent_id, audit_identifier, question1, question2, question3, question4, question5, score, comments, suggestion, feedback, audit_code', false );
				$header = array('Review Date', 
								'Agent Login ID', 
								'Kana Case ID', 
								'CA Ticket #', 
								'Did the agent include all necessary information in CA? (30)', 
								'Did the agent follow the correct procedure for authentication? (25)', 
								'Did the agent present an applicable solution? (25)', 
								'Did the agent create an interaction? (20)',   
								'Potential Escalation Prevention', 
								'Score', 
								'Comments', 
								'Suggestions for >Corrections',
								'Feedback',	
								'Audit Code'							
								);
				if( isset($_GET['from']) ) {
					$this->db->where(' DATE_FORMAT(review_date_start, \'%Y-%m-%d\') BETWEEN ', "'".$_GET['from']."' AND '".$_GET['to']."'", false); 
				}		
				$this->db->order_by('review_date_start', 'desc');
				$records = $this->db->get('cdr')->result(); 				
				break;
			
		}
		
		//echo $this->db->last_query();
		
		$excel->initialize();
		$excel->addRow($header);
		foreach($records as $row) {
			$excel->addRow($row);
		}
		$excel->finalize();
	}	
	
	public function feedback_save(){
		$json = array('status'=>false, 'msg'=>'Failed to save');
		$table = $this->input->post('tb');
		$id = $this->input->post('id');
		$feedback = $this->input->post('feedback');
		
		$this->db->set('feedback' , $feedback);
		$this->db->set('feedback_by' , $this->auditor_id);
		$this->db->set('feedback_date' , date('Y-m-d'));
		$this->db->where('id', $id);
		
		if( $this->db->update($table) ){
			$json['status'] = true;
			$json['msg'] = 'Feedback save successfully';
		}		
		
		echo json_encode($json);
		 
	}
	
	 
}

/* End of file client.php */
/* Location: ./application/controllers/client.php */