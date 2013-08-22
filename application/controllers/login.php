<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
	
 
	public function __construct(){
		
		parent::__construct();
		
		
	}
 
	public function index(){
		
		if( $this->session->userdata('OFFAL_ISLOGIN') ){
		 	redirect(base_url().'client');
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt45u', 'Usernme', 'required');
		$this->form_validation->set_rules('txt45p', 'Password', 'required');
		
		$data['errors'] = '';
		
		if($_POST){
		
			if( $this->form_validation->run() ) {
				$username = strtolower($this->input->post('txt45u'));
				$password = strtolower($this->input->post('txt45p'));
				
				$res = $this->db->get_where('users', array('username'=>$username));
				
				if( $res->num_rows() > 0 ){
					$row = $res->row();
					if( $row->password == $password){
						
						$this->session->set_userdata('OFFAL_ISLOGIN', true);
						$this->session->set_userdata('OFFAL_USERID', $row->id);
						$this->session->set_userdata('OFFAL_AUDITOR_CODE', $row->username);
						$this->session->set_userdata('OFFAL_FULLNAME', $row->fullname);
						$this->session->set_userdata('OFFAL_ISSUPER', $row->isSuper);
						$this->session->set_userdata('OFFAL_ROLEID', $row->role_id);
						
						$access = explode(',', $row->access); 
						$this->session->set_userdata('OFFAL_ACCESS', $access);
						
						$resch = $this->db->get_where('channels', array('ch_status'=>1))->result();
						$channels = array();
						foreach( $resch as $row1){
							$channels[$row1->ch_id] = $row1;
						}  
						$this->session->set_userdata('OFFAL_CHANNELS', $channels);
						
						$set['last_ip'] = $_SERVER['REMOTE_ADDR'];
						$set['last_login'] = date('Y-m-d H:i:s');	
						$this->db->where('id', $row->id);
						$this->db->update('users', $set);		
						
						redirect(base_url().'client');
					}else{
						$data['errors'] = '<span class="label label-important">Username/Password is Incorrect</span>';	
					}
				}else{
					$data['errors'] = '<span class="label label-important">Username/Password is Incorrect</span>';	
				}
			}else{
				$data['errors'] =  '<span class="label label-warning">'.validation_errors().'</span>';
			}			
		}
		
		$this->load->view('login', $data); 
	}
	  
	public function logout(){
		
		$array_items = array('OFFAL_ISLOGIN'=>false,
							'OFFAL_USERID'=>'',
							'OFFAL_AUDITOR_CODE'=>'',
							'OFFAL_FULLNAME'=>'',
							'OFFAL_ISSUPER'=>0
						);
		
		$this->session->set_userdata($array_items);
		
		redirect(base_url().'client');
	}
		
 
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */