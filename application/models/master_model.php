<?php
class Master_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    

    function get_defaults($id) {
        $this->db->select('*')->from('defaults')->where('default_id',$id);
        $query = $this->db->get();
        $result =  $query->row();
        if($result){
            return $result;       
        }else{
            return false;
        }
    }

    function get_data($type){
        if($type=="equipment_type") {
            $this->db->select("*")->from("equipment_type");
			$this->db->order_by("equipment_type");
        }
        else if($type=="journal_type") {
            $this->db->select("*")->from("journal_type");
			$this->db->order_by("journal_type");
        }
        else if($type=="location") {
            $this->db->select("location_id, location")->from("location");
			$this->db->order_by("location");
        }
        else if($type=="party") {
            $this->db->select("party_id, party_type_id, party_name")->from("party");
			$this->db->order_by("party_name");
        }
        else if($type=="equipment_category") {
            $this->db->select("*")->from("equipment_category");
			$this->db->order_by("equipment_category");
        } 
        else if($type=="equipment_procurement_type") {
            $this->db->select("*")->from("equipment_procurement_type");
            $this->db->order_by("procurement_type");
        } 
        else if($type=="equipment_functional_status") {
            $this->db->select("*")->from("equipment_functional_status");
            $this->db->order_by("working_status");
        } 
        else if($type=="equipment_procurement_status") {
            $this->db->select("*")->from("equipment_procurement_status");
            $this->db->order_by("procurement_status");
        } 
        else if($type=="journal_type") {
            $this->db->select("*")->from("journal_type");
            $this->db->order_by("journal_type");
        }
        $query=$this->db->get();
		return $query->result();
    }

    function get_equipment_data($default_rowsperpage){
        if ($this->input->post('page_no')) {
			$page_no = (int) $this->input->post('page_no');
		}
		else{
			$page_no = 1;
		}

        if($this->input->post('rows_per_page')) {
			$rows_per_page = $this->input->post('rows_per_page');
		}
		else{
			$rows_per_page = $default_rowsperpage;
		}

        $start = ($page_no -1 )  * $rows_per_page;
        if($this->input->post('equipment_category')){
            $this->db->where('equipment_category_id', $this->input->post('equipment_category'));
        }
        if($this->input->post('donor_party')){
            $this->db->where('equipment.donor_party_id', $this->input->post('donor_party'));
        }
        if($this->input->post('procured_by_party')){
            $this->db->where('equipment.procured_by_party_id', $this->input->post('procured_by_party'));
        }
        if($this->input->post('supplier_party')){
            $this->db->where('equipment.supplier_party_id', $this->input->post('supplier_party'));
        }
        if($this->input->post('manufactured_party')){
            $this->db->where('equipment.manufacturer_party_id', $this->input->post('manufactured_party'));
        }
        if($this->input->post('equipment_type')){
            $this->db->where('equipment.equipment_type_id', $this->input->post('equipment_type'));
        }
        /* if($this->input->post('location')){
            $this->db->where('location_id', $this->input->post('location'));
        } */
        $this->db->select("*")
            ->from("equipment")
            ->join('equipment_type','equipment_type.equipment_type_id=equipment.equipment_type_id','left')
            // ->join('equipment_location_log','equipment_location_log.equipment_id=equipment.equipment_id','inner')
            // ->join('location','location.location_id=equipment_location_log.location_id','left')
            // ->group_by('equipment_location_log.equipment_id')
            // ->order_by("delivery_date", 'desc')
            ->order_by("installation_date", 'desc');
        $this->db->limit($rows_per_page,$start);	
        $query=$this->db->get();
        return $query->result();
    }
    
    function get_equipment_count(){
        if($this->input->post('equipment_category')){
            $this->db->where('equipment_category_id', $this->input->post('equipment_category'));
        }
        if($this->input->post('donor_party')){
            $this->db->where('equipment.donor_party_id', $this->input->post('donor_party'));
        }
        if($this->input->post('procured_by_party')){
            $this->db->where('equipment.procured_by_party_id', $this->input->post('procured_by_party'));
        }
        if($this->input->post('supplier_party')){
            $this->db->where('equipment.supplier_party_id', $this->input->post('supplier_party'));
        }
        if($this->input->post('manufactured_party')){
            $this->db->where('equipment.manufacturer_party_id', $this->input->post('manufactured_party'));
        }
        if($this->input->post('equipment_type')){
            $this->db->where('equipment.equipment_type_id', $this->input->post('equipment_type'));
        }
        /* if($this->input->post('location')){
            $this->db->where('location_id', $this->input->post('location'));
        } */
        $this->db->select("COUNT(*) as count")
            ->from("equipment")
            ->join('equipment_type','equipment_type.equipment_type_id=equipment.equipment_type_id','left');
            // ->join('equipment_location_log','equipment_location_log.equipment_id=equipment.equipment_id','inner')
            // ->join('location','location.location_id=equipment_location_log.location_id','left')
            // ->group_by('equipment_location_log.equipment_id')
            // ->order_by("delivery_date", 'desc')	
        $query=$this->db->get();
        return $query->row();
    }
    function get_parties_by_party_type($party_type) {
        if($party_type =='donor_party'){
            $this->db->join('equipment','equipment.donor_party_id=party.party_id','inner');
        } 
        else if($party_type =='procured_by_party') {
            $this->db->join('equipment','equipment.procured_by_party_id=party.party_id','inner');
        }
        else if($party_type =='supplier_party') {
            $this->db->join('equipment','equipment.supplier_party_id=party.party_id','inner');
        } else {
            // when party type is manufacturer
            $this->db->join('equipment','equipment.manufacturer_party_id=party.party_id','inner');
        }

        $this->db->select("party_id, party_name")
            ->from('party')
            ->group_by('party_id')
            ->order_by("party_name");
        $query = $this->db->get();
        return $query->result();
    }

    function get_equipment_by_id($equipment_id){
        $this->db->select(
                    "equipment_id, equipment_name, equipment_type, procurement_type, model, serial_number, mac_address, asset_number,purchase_order_date, 
                    cost, invoice_number, invoice_date, supply_date, installation_date, warranty_start_date, warranty_end_date,
                    created_by, created_datetime, updated_by, updated_datetime, equipment_category, working_status as functional_status, procurement_status, journal_type, journal_date,note")
            ->from("equipment")
            ->join('equipment_type','equipment_type.equipment_type_id=equipment.equipment_type_id','left')
            ->join('equipment_category','equipment_category.id=equipment_type.equipment_category_id','left')
            ->join('equipment_functional_status','equipment_functional_status.functional_status_id=equipment.functional_status_id','left')
            ->join('equipment_procurement_status','equipment_procurement_status.equipment_procurement_status_id=equipment.procurement_status_id','left')
            ->join('equipment_procurement_type','equipment_procurement_type.equipment_procurement_type_id=equipment.equipment_procurement_type_id','left')
            ->join('journal_type','journal_type.journal_type_id=equipment.journal_type_id','left')
            ->where("equipment_id",$equipment_id)
            ->order_by("equipment_id");
        $query = $this->db->get();
        $result =  $query->row();
        if($result){
            return $result;       
        }else{
            return false;
        }
    }

    function add_equipment(){
        $data = array(
            'donor_party_id'=>$this->input->post('donor_party'),
            'procured_by_party_id'=>$this->input->post('procured_by_party'),
            'supplier_party_id'=>$this->input->post('supplier_party'),
            'manufacturer_party_id'=>$this->input->post('manufactured_party'),
            'equipment_type_id'=>$this->input->post('equipment_type'),
            'equipment_name'=>$this->input->post('equipment_name'),
            'model'=>$this->input->post('model'),
            'serial_number'=>$this->input->post('serial_number'),
            'mac_address'=>$this->input->post('mac_address'),
            'asset_number'=>$this->input->post('asset_number'),
            'purchase_order_date'=>$this->input->post('purchase_order_date'),
            'cost'=>$this->input->post('cost'),
            'invoice_number'=>$this->input->post('invoice_number'),
            'invoice_date'=>$this->input->post('invoice_date'),
            'supply_date'=>$this->input->post('supply_date'),
            'installation_date'=>$this->input->post('installation_date'),
            'warranty_start_date'=>$this->input->post('warranty_start_date'),
            'warranty_end_date'=>$this->input->post('warranty_end_date'),
            'journal_type_id'=>$this->input->post('journal_type'),
            'journal_number'=>$this->input->post('journal_number'),
            'journal_date'=>$this->input->post('journal_date'),
            'note'=>$this->input->post('note'),
            'created_by'=>$this->session->userdata('logged_in')['user_id'],
            'created_datetime'=>date("Y-m-d H:i:s")
        );

        $this->db->trans_start(); //Transaction begins
        $this->db->insert('equipment',$data); //Insert 
        $this->db->trans_complete(); //Transaction Ends
		if($this->db->trans_status()===TRUE) return true; else return false; //if transaction completed successfully return true, else false.
    }
}
