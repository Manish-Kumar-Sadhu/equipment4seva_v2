<?php
class Reports_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function summary_report(){
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
        if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
            $this->db->where("(invoice_date BETWEEN '$from_date' AND '$to_date')");
		}
        if($this->input->post('group_by_equipment_category')){
            $this->db->group_by('equipment_type.equipment_category_id');
        }
        // if($this->input->post('group_by_equipment_type')=='on'){
        //     $this->db->group_by('equipment.equipment_type_id');
        // }
        $this->db->select("equipment_type, equipment_category, COUNT(equipment.equipment_id) as no_of_records, SUM(equipment.cost) as total_amount")
            ->join('equipment_type','equipment_type.equipment_type_id=equipment.equipment_type_id','left')
            ->join('equipment_category','equipment_category.id=equipment_type.equipment_category_id','left')
            ->from("equipment")
            ->group_by('equipment_category.id');
        $query=$this->db->get();
        echo $this->db->last_query();
        return $query->result();
    }
}