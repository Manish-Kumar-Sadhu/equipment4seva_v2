<?php
class Master_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    

    function get_defaults($id) {
        $this->db->select('*')->from('defaults')->where('default_id',$id);
        $query = $this->db->get();
        $result =  $query->result();
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
			$this->db->order_by("party");
        }
        else if($type=="equipment_category") {
            $this->db->select("*")->from("equipment_category");
			$this->db->order_by("equipment_category");
        }
        $query=$this->db->get();
		return $query->result();
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
        // var_dump($this->db->last_query());
        return $query->result();
    }
}
