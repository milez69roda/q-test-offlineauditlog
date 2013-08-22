<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Kanachat_Model extends CI_Model {
 
    function __construct() {
        
        parent::__construct();
    }
    
    function get(){ 
 
		$aColumns = array('review_date_start', 'agent_id', 'audit_identifier', 'question1', 'question2', 'question3', 'question4', 'question5', 'question6', 'question7', 'score',  'suggestion', 'feedback',  'audit_code'	);
		

		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "kana_chat.id";
		
		/* DB table to use */
		$sTable = "kana_chat";
		$sJoin = " ";
		/* 
		 * Paging
		 */
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ) {
			$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".mysql_real_escape_string( $_GET['iDisplayLength'] );
		}
		 
		/*
		 * Ordering
		 */
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
			
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
					
					
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
						
					//$this->db->order_by($aColumns[ intval( $_GET['iSortCol_'.$i] ) ], $_GET['sSortDir_'.$i] );	
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" ){
				$sOrder = "";
			}
		}
		
		
		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = "WHERE ";
		 
		$sWhere .= " DATE_FORMAT(review_date_start,'%Y-%m-%d') BETWEEN '".$_GET['date_from']."' AND '".$_GET['date_to']."'";
		 
		if( !$this->session->userdata('OFFAL_ISSUPER') )		
			$sWhere .= " AND (audit_code = '".$this->session->userdata('OFFAL_AUDITOR_CODE')."')"; 
		
		if ( $_GET['sSearch'] != "" ){
			 
			$sWhere .= " AND (";	
			
			for ( $i=0 ; $i<count($aColumns) ; $i++ ){
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				
				/*if( $i == 0 )
					$this->db->like($_GET['sSearch'], 'match');
				else
					$this->db->or_like($_GET['sSearch'], 'match');*/
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ){
				if ( $sWhere == "" ) {
					$sWhere = "WHERE ";
				}
				else { 
					$sWhere .= " AND";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		 
		
		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = "
			SELECT SQL_CALC_FOUND_ROWS  
				id,
				review_date_start,
				agent_id,
				audit_identifier,
				question1,
				question2,
				question3,
				question4,
				question5,
				question6,
				question7,
				score,
				score_interaction,
				comments,
				suggestion,
				feedback,
				audit_code
			FROM   $sTable
			$sJoin
			$sWhere
			$sOrder
			$sLimit
		";
		 
		$rResult = $this->db->query($sQuery); 
		
		//echo $this->db->last_query();
		$iFilteredTotal = $rResult->num_rows();
		
		/* Total data set length */
		$sQuery = "
			SELECT COUNT(".$sIndexColumn.") as numrow
			FROM   $sTable
			$sJoin
			$sWhere
		";
		//$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
		//$aResultTotal = mysql_fetch_array($rResultTotal);
		$aResultTotal = $this->db->query($sQuery)->row();
		$iTotal = $aResultTotal->numrow;
		
		
		/*
		 * Output
		 */
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			//"iTotalDisplayRecords" => $iFilteredTotal,
			"iTotalDisplayRecords" => $iTotal,
			"aaData" => array()
		);
		
		//while ( $aRow = mysql_fetch_array( $rResult ) ){
		
		$rResult = $rResult->result();
		
		//print_r($rResult);
		foreach( $rResult as $row ){
		
			$rows = array();
			
			$rows['DT_RowId'] = $row->id; 
			 
			$rows[] = $row->review_date_start;    
			$rows[] = $row->agent_id;    
			$rows[] = $row->audit_identifier;    
			$rows[] = $row->question1;    
			$rows[] = $row->question2;    
			$rows[] = $row->question3;    
			$rows[] = $row->question4;    
			$rows[] = $row->question5;    
			$rows[] = $row->question6;    
			$rows[] = $row->question7;    
			$rows[] = $row->score;    
			//$rows[] = $row->score_interaction;    
			$rows[] = $row->comments;    
			$rows[] = $row->suggestion;    
			$rows[] = $row->feedback;    
			$rows[] = $row->audit_code;    
			//$rows[] = '<a href="'.base_url().'kanachat/?edit='.$row->id.'">edit</a>';
			$rows[] = '<a style="padding: 4px;" href="'.base_url().'kanachat/?edit='.$row->id.'">Edit</a> | '.(($this->session->userdata('OFFAL_ISSUPER') == 1)?'<a style="padding: 4px;" href="javascript:void(0)" title="'.$row->feedback.'" onclick="COMMON.feedbackform(\'kana_chat\', '.$row->id.', this)">Feedback</a>':'');
			
			$output['aaData'][] = $rows;
		}
		
		echo json_encode( $output );	
	 	
	
	}

}