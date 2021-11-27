<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
    label{
        font-weight:bold;
    }
    .card{
        margin-top:2rem;
    }
    .card-header{
        text-align:center;
    }
    select{
        cursor: pointer;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }

</style>
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white">
           <h4> Edit Equipment Details</h4>
        </div>
        <div class="card-body">
            <form id="edit_equipment" action="<?= base_url('equipments/edit/').$equipment_id; ?>" method="POST">
                <input type="hidden" name="form_for" value="update_equipment_details">
                <div class="row">
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="equipment_category">Equipment Category</label>
                        <select class="form-control" name="equipment_category" id="equipment_category" onchange="filter_equipment_type('equipment_category','equipment_type')" required>
                            <option value="0" selected>----------Select----------</option>
                            <?php
                                foreach($equipment_category as $r){ ?>
                                <option value="<?php echo $r->id;?>"    
                                <?php if($this->input->post('equipment_category') == $r->id || $equipment->equipment_category_id == $r->id ) echo " selected "; ?>
                                ><?php echo $r->equipment_category;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="equipment_type">Equipment Type</label>
                        <select class="form-control" name="equipment_type" id="equipment_type">
                            <option value="0" selected>----------Select----------</option>
                            <?php
                                foreach($equipment_type as $r){ ?>
                                <option value="<?php echo $r->equipment_type_id;?>"    
                                <?php if($this->input->post('equipment_type') == $r->equipment_type_id || $equipment->equipment_type_id == $r->equipment_type_id) echo " selected "; ?>
                                ><?php echo $r->equipment_type;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="equipment_name">Equipment Name<span class="star" style="color:red"> *</span></label>
                        <input class="form-control" name="equipment_name" type="text" value="<?= $equipment->equipment_name; ?>" required >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="model">Model</label>
                        <input class="form-control" name="model" value="<?= $equipment->model; ?>" type="text" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="manufactured_party">Manufacturer</label>
                        <select name="manufactured_party" id="manufactured_party" placeholder="----------Select----------">
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="serial_number">Serial Number</label>
                        <input class="form-control" name="serial_number" type="text" value="<?= $equipment->serial_number; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="mac_address">Mac address</label>
                        <input class="form-control" name="mac_address" type="text" value="<?= $equipment->mac_address; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="asset_number">Asset Number</label>
                        <input class="form-control" name="asset_number" type="text" value="<?= $equipment->asset_number; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="supplier_party">Supplier</label>
                        <select name="supplier_party" id="supplier_party" placeholder="----------Select----------">
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="procured_by_party">Procured by</label>
                        <select name="procured_by_party" id="procured_by_party" placeholder="----------Select----------">
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="donor_party">Donor</label>
                        <select  name="donor_party" id="donor_party" placeholder="----------Select----------" >
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="purchase_order_date">Purchase order date</label>
                        <input class="form-control" name="purchase_order_date" type="date" value="<?= $equipment->purchase_order_date; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="cost">Cost</label>
                        <input class="form-control" name="cost" type="number" value="<?= $equipment->cost; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="invoice_number">Invoice Number</label>
                        <input class="form-control" name="invoice_number" type="text" value="<?= $equipment->invoice_number; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="invoice_date">Invoice date</label>
                        <input class="form-control" name="invoice_date" type="date" value="<?= $equipment->invoice_date; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="supply_date">Supply date</label>
                        <input class="form-control" name="supply_date" type="date" value="<?= $equipment->supply_date; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="installation_date">Installation date</label>
                        <input class="form-control" name="installation_date" type="date">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="journal_type">Journal Type</label>
                        <select class="form-control" name="journal_type" id="journal_type">
                            <option value="0" selected>----------Select----------</option>
                            <?php
                                foreach($journal_type as $r){ ?>
                                <option value="<?php echo $r->journal_type_id;?>"    
                                <?php if($this->input->post('journal_type') == $r->journal_type_id || $equipment->journal_type_id == $r->journal_type_id) echo " selected "; ?>
                                ><?php echo $r->journal_type;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="journal_number">Journal Number</label>
                        <input class="form-control" name="journal_number" type="text" value="<?= $equipment->journal_number; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="journal_date">Journal date</label>
                        <input class="form-control" name="journal_date" type="date" value="<?= $equipment->journal_date; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="warranty_start_date">Warranty start date</label>
                        <input class="form-control" name="warranty_start_date" type="date" value="<?= $equipment->warranty_start_date; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="warranty_end_date">Warranty end date</label>
                        <input class="form-control" name="warranty_end_date" type="date" value="<?= $equipment->warranty_end_date; ?>" >
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-xs-12">
                        <label for="note">Note</label>
                        <textarea class="form-control" name="note" rows="1"><?= $equipment->note; ?></textarea>
                    </div>
                    <div class="form-group col-md-12 col-lg-12 col-xs-12">
                        <button type="submit" class='btn btn-info btn-block'>Submit</button>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>Location Information</h4>
        </div>
        <div class="card-body">
            <form id="add_location" action="<?=  base_url('equipments/edit/').$equipment_id; ?>" method="POST">
                <input type="hidden" name="form_for" value="add_equipment_location_log">
                <div class="row">
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="location">Locations<span class="star" style="color:red"> *</span></label>
                        <select class="form-control" name="location" id="location" required>
                            <option value="0" selected>----------Select----------</option>
                            <?php
                                foreach($locations as $r){ ?>
                                <option value="<?php echo $r->location_id;?>"    
                                <?php if($this->input->post('location') == $r->location_id) echo " selected "; ?>
                                ><?php echo $r->location;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="receiver_party_id">Receiver party<span class="star" style="color:red"> *</span></label>
                        <select name="receiver_party_id" id="receiver_party_id" placeholder="Receiver party">
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="address">Address</label>
                        <input class="form-control" name="address" type="text">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="delivery_date">Delivery Date<span class="star" style="color:red"> *</span></label>
                        <input class="form-control" name="delivery_date" type="date">
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-xs-12">
                        <label for="note">Note</label>
                        <textarea class="form-control" name="note" rows="1"></textarea>
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-xs-12" style="margin-top:2rem;">
                        <button type="submit" class='btn btn-info '>Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    <?php if(isset($status)) { ?>
        const status = <?php echo $status; ?>;
        const msg= '<?php echo $msg; ?>';
    <?php } ?>
    
    if(status==200){
        swal({
            title: "Success",
            text: msg,
            type: "success",
            timer: 2000
        });
    }

    $(function () {
        initDropdown('donor_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->donor_party_id;?>);
        initDropdown('procured_by_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->procured_by_party_id;?>);
        initDropdown('supplier_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->supplier_party_id;?>);
        initDropdown('manufactured_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->manufacturer_party_id;?>);
        initDropdown('receiver_party_id', '<?php echo json_encode($party); ?>');

        filter_equipment_type('equipment_category','equipment_type');
    });

    function escapeSpecialChars(str) {
        return str.replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\t/g, "\\t");
    }

    function initDropdown(id, list, value){
        let data = JSON.parse(escapeSpecialChars(list));
        // console.log(data);
        var selectize = $(`#${id}`).selectize({
            valueField: 'party_id',
	        labelField: 'party_name',
	        sortField: 'party_name',
            searchField: 'party_name',
            options: data,
            create: false,
            render: {
                option: function(item, escape) {
                    return `<div>
                                <span class="title">
                                    <span class="option-name">${escape(item.party_name)}</span>
                                </span>
                            </div>`;
                }
    	    },
            load: function(query, callback) {
                // if (!query.length) return callback();
                selectize[0].selectize.setValue(null);
            },

        });
        if(value){
		    selectize[0].selectize.setValue(value);
	    }
    }

    function filter_equipment_type(category, id, selected_equipment_type_id){
        let equipment_types = <?php echo json_encode($equipment_type); ?>;
        let selected_category = $(`#${category}`).val();
        let filtered_equipment_types;
        $(`#${id}`).empty();
        filtered_equipment_types = $.grep(equipment_types , function(v){
            return v.equipment_category_id == selected_category;
        }) ;
        console.log(filtered_equipment_types);  
        // iterating the filtered equipment types
        $.each(filtered_equipment_types, function (indexInArray, valueOfElement) { 
            const {equipment_type_id ,equipment_type} = valueOfElement;
            $(`#${id}`).append($('<option></option>').val(equipment_type_id).html(equipment_type));
        });
    }
</script>