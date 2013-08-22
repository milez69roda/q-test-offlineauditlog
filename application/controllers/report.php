<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
	
	public $auditor_id = '';
	public $ch_access = array();
	public $ch_first = '';
	public $channels = array();
	
	public $scorecard_audits_header = array('Date', 'Auditor', 'Type of Audit', 'Count of Audits', 'Average Score Given');
	public $scorecard_audits_query = "(SELECT DATE_FORMAT(date_created,'%m/%d/%Y') AS datecreated, audit_code, 'Chat' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2) AS score 
					FROM kana_chat 
					WHERE DATE_FORMAT(date_created,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(date_created,'%m/%d/%Y'))
					UNION
					(SELECT DATE_FORMAT(created_date,'%m/%d/%Y') AS datecreated, audit_code, 'Email' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2)  AS score 
					FROM kana_email 
					WHERE DATE_FORMAT(created_date,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(created_date,'%m/%d/%Y'))
					UNION					
					(SELECT DATE_FORMAT(date_created,'%m/%d/%Y') AS datecreated, audit_code, 'Cases' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2)  AS score 
					FROM cases 
					WHERE DATE_FORMAT(date_created,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(date_created,'%m/%d/%Y'))
					UNION					 
					(SELECT DATE_FORMAT(created_date,'%m/%d/%Y') AS datecreated, audit_code, 'Social Media' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2) AS score  
					FROM social_media 
					WHERE DATE_FORMAT(created_date,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(created_date,'%m/%d/%Y'))  
					UNION
					(SELECT DATE_FORMAT(created_date,'%m/%d/%Y') AS datecreated, audit_code, 'CDR' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2) AS score  					
					FROM cdr 
					WHERE DATE_FORMAT(created_date,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(created_date,'%m/%d/%Y')) 
					
					ORDER BY datecreated ASC ";
	
	public $scorecard_quality_header = array('Date', 'Agent', 'Type of Audit', 'Count of Audits', 'Sum of Audit Score', 'Sum of Audit Potential Score', '% Score');	
	public $scorecard_quality_query = "(SELECT DATE_FORMAT(date_created,'%m/%d/%Y') AS datecreated, agent_id, 'Chat' AS typeofaudit, COUNT(id) AS num, SUM(score) AS auditscore,  (COUNT(id) * 100) as potential_score, ROUND((SUM(score)/(COUNT(id)*100))*100, 2) AS score 
					FROM kana_chat 
					WHERE DATE_FORMAT(date_created,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY agent_id, DATE_FORMAT(date_created,'%m/%d/%Y'))
					UNION
					(SELECT DATE_FORMAT(created_date,'%m/%d/%Y') AS datecreated, agent_id, 'Email' AS typeofaudit, COUNT(id) AS num, SUM(score) AS auditscore, (COUNT(id) * 100) as potential_score, ROUND((SUM(score)/(COUNT(id)*100))*100, 2) AS score 
					FROM kana_email 
					WHERE DATE_FORMAT(created_date,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY agent_id, DATE_FORMAT(created_date,'%m/%d/%Y'))
					UNION					
					(SELECT DATE_FORMAT(date_created,'%m/%d/%Y') AS datecreated, agent_id, 'Cases' AS typeofaudit, COUNT(id) AS num, SUM(score) AS auditscore, (COUNT(id) * 100) as potential_score, ROUND((SUM(score)/(COUNT(id)*100))*100, 2) AS score 
					FROM cases 
					WHERE DATE_FORMAT(date_created,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY agent_id, DATE_FORMAT(date_created,'%m/%d/%Y'))
					UNION					 
					(SELECT DATE_FORMAT(created_date,'%m/%d/%Y') AS datecreated, agent_id, 'Social Media' AS typeofaudit, COUNT(id) AS num, SUM(score) AS auditscore, (COUNT(id) * 100) as potential_score, ROUND((SUM(score)/(COUNT(id)*100))*100, 2) AS score 
					FROM social_media 
					WHERE DATE_FORMAT(created_date,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY agent_id, DATE_FORMAT(created_date,'%m/%d/%Y'))  
					UNION
					(SELECT DATE_FORMAT(created_date,'%m/%d/%Y') AS datecreated, agent_id, 'CDR' AS typeofaudit, COUNT(id) AS num, SUM(score) AS auditscore, (COUNT(id) * 100) as potential_score, ROUND((SUM(score)/(COUNT(id)*100))*100, 2) AS score 
					FROM cdr 
					WHERE DATE_FORMAT(created_date,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY agent_id, DATE_FORMAT(created_date,'%m/%d/%Y'))  
					
					ORDER BY datecreated ASC, agent_id ASC ";	
	
	public $management_audits_header = array('Date', 'Auditor', 'Type of Audit', 'Count of Audits', 'Average Score Given');
	public $management_audits_query = "(SELECT date_created AS date_created, DATE_FORMAT(date_created,'%M-%Y') AS datecreated, audit_code, 'Chat' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2) AS score 
					FROM kana_chat 
					WHERE DATE_FORMAT(date_created,'%Y-%m') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(date_created,'%m/%Y'))
					UNION
					(SELECT created_date AS date_created, DATE_FORMAT(created_date,'%M-%Y') AS datecreated, audit_code, 'Email' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2)  AS score 
					FROM kana_email 
					WHERE DATE_FORMAT(created_date,'%Y-%m') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(created_date,'%m/%Y'))
					UNION				
					(SELECT date_created AS date_created, DATE_FORMAT(date_created,'%M-%Y') AS datecreated, audit_code, 'Cases' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2)  AS score 
					FROM cases 
					WHERE DATE_FORMAT(date_created,'%Y-%m') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(date_created,'%m/%Y'))
					UNION					 
					(SELECT created_date AS date_created, DATE_FORMAT(created_date,'%M-%Y') AS datecreated, audit_code, 'Social Media' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2) AS score  
					FROM social_media 
					WHERE DATE_FORMAT(created_date,'%Y-%m') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(created_date,'%m/%Y'))  
					UNION
					(SELECT created_date AS date_created, DATE_FORMAT(created_date,'%M-%Y') AS datecreated, audit_code, 'CDR' AS typeofaudit, COUNT(id) AS num, ROUND(AVG(score), 2) AS score  					
					FROM cdr 
					WHERE DATE_FORMAT(created_date,'%Y-%m') BETWEEN '[FROM]' AND '[TO]'
					GROUP BY audit_code, DATE_FORMAT(created_date,'%m/%Y')) 
 
					ORDER BY date_created ASC ";
	
	public $management_quality_header = array('Date', 'Agent', 'Audit ID', 'Type of Audit', 'Audit Score', 'Audit Potential Score', '% Score');	
	public $management_quality_query = "(SELECT DATE_FORMAT(review_date_start,'%m/%d/%Y') AS datecreated, agent_id, audit_code, 'Chat' AS typeofaudit,  score AS auditscore, '100' as potential_score,  ROUND((score/100)*100, 0) AS percent_score
					FROM kana_chat 
					WHERE DATE_FORMAT(review_date_start,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]')
					UNION
					(SELECT DATE_FORMAT(review_date_start,'%m/%d/%Y') AS datecreated, agent_id, audit_code, 'Email' AS typeofaudit,  score AS auditscore, '100' as potential_score, ROUND((score/100)*100, 0) AS percent_score
					FROM kana_email 
					WHERE DATE_FORMAT(review_date_start,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]')
					UNION					
					(SELECT DATE_FORMAT(review_date_start,'%m/%d/%Y') AS datecreated, agent_id, audit_code, 'Cases' AS typeofaudit,  score AS auditscore, '100' as potential_score, ROUND((score/100)*100, 0) AS percent_score
					FROM cases 
					WHERE DATE_FORMAT(review_date_start,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]')
					UNION					 
					(SELECT DATE_FORMAT(review_date_start,'%m/%d/%Y') AS datecreated, agent_id, audit_code, 'Social Media' AS typeofaudit,  score AS auditscore, '100' as potential_score, ROUND((score/100)*100, 0) AS percent_score
					FROM social_media 
					WHERE DATE_FORMAT(review_date_start,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]')  
					UNION
					(SELECT DATE_FORMAT(review_date_start,'%m/%d/%Y') AS datecreated, agent_id, audit_code, 'CDR' AS typeofaudit,  score AS auditscore, '100' as potential_score, ROUND((score/100)*100, 0) AS percent_score
					FROM cdr 
					WHERE DATE_FORMAT(review_date_start,'%Y-%m-%d') BETWEEN '[FROM]' AND '[TO]') 
 
					ORDER BY datecreated ASC ";
	
	
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
	
	public function scorecard_audits(){
	 
		$query =  str_replace(array('[FROM]','[TO]' ), array((isset($_GET['from']))?$_GET['from']:date('Y-m-d'), (isset($_GET['to']))?$_GET['to']:date('Y-m-d')), $this->scorecard_audits_query);
		//echo "<pre>".$query."</pre>";
		$data['list'] = $this->db->query($query)->result();
	 
		$hdata['nactive'] = 'scorecard';
		$this->load->view('header', $hdata );  
		
		$data['nav'] = $this->load->view('report/nav', null, true); 
		$this->load->view('report/scorecard_audits_per_auditor', $data);
		$this->load->view('footer');	 
	 
	}
	
	
	public function scorecard_qualityreport(){
	 
		$query =  str_replace(array('[FROM]','[TO]' ), array((isset($_GET['from']))?$_GET['from']:date('Y-m-d'), (isset($_GET['to']))?$_GET['to']:date('Y-m-d')), $this->scorecard_quality_query);
		 
		$data['list'] = $this->db->query($query)->result();
	 
		$hdata['nactive'] = 'scorecard';
		$this->load->view('header', $hdata );  
		
		$data['nav'] = $this->load->view('report/nav', null, true); 
		$this->load->view('report/scorecard_quality_report', $data);
		$this->load->view('footer');	 
	 
	}	
	
	public function management_audits(){
	 
		$query =  str_replace(array('[FROM]','[TO]' ), array((isset($_GET['from']))?$_GET['from']:date('Y-m'), (isset($_GET['to']))?$_GET['to']:date('Y-m')), $this->management_audits_query);
		 
		$data['list'] = $this->db->query($query)->result();
	 
		$hdata['nactive'] = 'management';
		$this->load->view('header', $hdata );  
		
		$data['nav'] = $this->load->view('report/nav', null, true); 
		$this->load->view('report/management_audits_per_auditor', $data);
		$this->load->view('footer');	 
	 
	}	
	
	public function management_qualityreport(){
	 
		$query = $query =  str_replace(array('[FROM]','[TO]' ), array((isset($_GET['from']))?$_GET['from']:date('Y-m-d'), (isset($_GET['to']))?$_GET['to']:date('Y-m-d')), $this->management_quality_query);
		//echo "<pre>".$query."</pre>"; 
		$data['list'] = $this->db->query($query)->result();
	 
		$hdata['nactive'] = 'management';
		$this->load->view('header', $hdata );  
		
		$data['nav'] = $this->load->view('report/nav', null, true); 
		$this->load->view('report/management_quality_report', $data);
		$this->load->view('footer');	 
	 
	}

	public function excel(){
		$summary = $_GET['ch']; 
		
		$this->load->library('ExportDataExcel');  
		 			 
		$excel = new ExportDataExcel('browser');
		$excel->filename = $summary.'_'.strtotime('now').".xls";

		$header = ''; 
		switch($summary){
			case 'scorecard_audits': //Audits per Auditor per Day Report
				$header = $this->scorecard_audits_header;
				$query =  str_replace(array('[FROM]','[TO]' ), array((isset($_GET['from']))?$_GET['from']:date('Y-m-d'), (isset($_GET['to']))?$_GET['to']:date('Y-m-d')), $this->scorecard_audits_query);
				$records = $this->db->query($query)->result(); 		
				break;
			case 'scorecard_quality': //Agent Quality Report - Summary per Day Report
				$header = $this->scorecard_quality_header;
				$query =  str_replace(array('[FROM]','[TO]' ), array((isset($_GET['from']))?$_GET['from']:date('Y-m-d'), (isset($_GET['to']))?$_GET['to']:date('Y-m-d')), $this->scorecard_quality_query);
				$records = $this->db->query($query)->result(); 		
				break;
			case 'management_audits': //Audits per Auditor per Month (or Week or Custom Time Period) Report
				$header = $this->scorecard_quality_header;
				$query =  str_replace(array('[FROM]','[TO]' ), array((isset($_GET['from']))?$_GET['from']:date('Y-m-d'), (isset($_GET['to']))?$_GET['to']:date('Y-m-d')), $this->management_audits_query);
				$records = $this->db->query($query)->result(); 		
				break;
			case 'management_quality': //Agent Quality Report - Summary per Day Report
				$header = $this->scorecard_quality_header;
				$query =  str_replace(array('[FROM]','[TO]' ), array((isset($_GET['from']))?$_GET['from']:date('Y-m-d'), (isset($_GET['to']))?$_GET['to']:date('Y-m-d')), $this->management_quality_query);
				$records = $this->db->query($query)->result(); 		
				break;
				
				
			default:
				break;
		}
		
		$excel->initialize();
		$excel->addRow($header);
		foreach($records as $row) {
			$excel->addRow($row);
		}
		$excel->finalize();	 		
	}	
	
}

/* End of file client.php */
/* Location: ./application/controllers/client.php */