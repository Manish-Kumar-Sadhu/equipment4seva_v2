<?php
class documentation_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function add_document($filename, $equipment_id){
		$data = array(
			'equipment_id'=>$equipment_id,
			'document_date'=>$this->input->post('document_date'),
			'document_type_id'=>$this->input->post('document_type'),
			'note'=>$this->input->post('note'),
			'document_link' => $filename,
			'created_by'=>$this->session->userdata('logged_in')['user_id']
		);

		$this->db->trans_start(); //Transaction begins
        $this->db->insert('equipment_documents',$data); //Insert 
        $this->db->trans_complete(); //Transaction Ends
		if($this->db->trans_status()===TRUE) return true; else return false; //if transaction completed successfully return true, else false.
	}

	function get_documents_by_equipment_id($equipment_id){
		$this->db->select('document_type, document_date, created_user.first_name as created_user_first_name, created_user.last_name  as created_user_last_name,
		document_link, equipment_documents.note as equipment_document_note')
		->from('equipment_documents')
		->join('equipment_document_type','equipment_document_type.document_type_id = equipment_documents.document_type_id','left')
		->join('user as created_user','created_user.user_id=equipment_documents.created_by','left')
		->where("equipment_id",$equipment_id)
		->order_by('equipment_documents.create_datetime');
		$query = $this->db->get();
        $result =  $query->result();
        if($result){
            return $result;       
        }else{
            return false;
        }
	}
    
}