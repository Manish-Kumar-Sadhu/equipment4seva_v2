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
        <div class="card-header bg-primary text-white">
           <h4> Add Equipment Details </h4>
        </div>
        <div class="card-body">
            <form id="add_equipment" action="<?= base_url('equipments/add'); ?>" method="POST">
                <div class="row">
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="donor_party">Donor</label>
                        <select  name="donor_party" id="donor_party" placeholder="----------Select----------" >
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="procured_by_party">Procured by</label>
                        <select name="procured_by_party" id="procured_by_party" placeholder="----------Select----------">
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="supplier_party">Supplier</label>
                        <select name="supplier_party" id="supplier_party" placeholder="----------Select----------">
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="manufactured_party">Manufacturer</label>
                        <select name="manufactured_party" id="manufactured_party" placeholder="----------Select----------">
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="equipment_category">Equipment Category</label>
                        <select class="form-control" name="equipment_category" id="equipment_category">
                            <option value="0" selected>----------Select----------</option>
                            <?php
                                foreach($equipment_category as $r){ ?>
                                <option value="<?php echo $r->id;?>"    
                                <?php if($this->input->post('equipment_category') == $r->id) echo " selected "; ?>
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
                                <?php if($this->input->post('equipment_type') == $r->equipment_type_id) echo " selected "; ?>
                                ><?php echo $r->equipment_type;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="equipment_name">Equipment Name<span class="star" style="color:red"> *</span></label>
                        <input class="form-control" name="equipment_name" type="text" required>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="model">Model</label>
                        <input class="form-control" name="model" type="text">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="serial_number">Serial Number</label>
                        <input class="form-control" name="serial_number" type="text">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="mac_address">Mac address</label>
                        <input class="form-control" name="mac_address" type="text">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="asset_number">Asset Number</label>
                        <input class="form-control" name="asset_number" type="text">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="purchase_order_date">Purchase order date</label>
                        <input class="form-control" name="purchase_order_date" type="date">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="cost">Cost</label>
                        <input class="form-control" name="cost" type="number">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="invoice_number">Invoice Number</label>
                        <input class="form-control" name="invoice_number" type="text">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="invoice_date">Invoice date</label>
                        <input class="form-control" name="invoice_date" type="date">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="supply_date">Supply date</label>
                        <input class="form-control" name="supply_date" type="date">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="installation_date">Installation date</label>
                        <input class="form-control" name="installation_date" type="date">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="warranty_start_date">Warranty start date</label>
                        <input class="form-control" name="warranty_start_date" type="date">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="warranty_end_date">Warranty end date</label>
                        <input class="form-control" name="warranty_end_date" type="date">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="journal_type">Journal Type</label>
                        <select class="form-control" name="journal_type" id="journal_type">
                            <option value="0" selected>----------Select----------</option>
                            <?php
                                foreach($journal_type as $r){ ?>
                                <option value="<?php echo $r->journal_type_id;?>"    
                                <?php if($this->input->post('journal_type') == $r->journal_type_id) echo " selected "; ?>
                                ><?php echo $r->journal_type;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="journal_number">Journal Number</label>
                        <input class="form-control" name="journal_number" type="number">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="journal_date">Journal date</label>
                        <input class="form-control" name="journal_date" type="date">
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-xs-12">
                        <label for="note">Note</label>
                        <textarea class="form-control" name="note" rows="1"></textarea>
                    </div>
                    <div class="form-group col-md-12 col-lg-12 col-xs-12">
                        <button type="submit" class='btn btn-primary btn-block'>Submit</button>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(function () {
        initDropdown('donor_party', '<?php echo json_encode($party); ?>');
        initDropdown('procured_by_party', '<?php echo json_encode($party); ?>');
        initDropdown('supplier_party', '<?php echo json_encode($party); ?>');
        initDropdown('manufactured_party', '<?php echo json_encode($party); ?>');
    });

    function escapeSpecialChars(str) {
        return str.replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\t/g, "\\t");
    }

    function initDropdown(id, list){
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
    }
</script>