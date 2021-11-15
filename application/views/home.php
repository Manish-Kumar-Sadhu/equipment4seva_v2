<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    label{
        font-weight:bold;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="form-group col-md-2">
            <label for="donor_party">Donor</label>
            <select  name="donor_party" id="donor_party" >
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="procured_by_party">Receiver</label>
            <select name="procured_by_party" id="procured_by_party">
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="supplier_party">Supplier</label>
            <select name="supplier_party" id="supplier_party" required>
            </select>
        </div>
        <div class="col-md-2">
            <label for="manufactured_party">Manufacturer</label>
            <select name="manufactured_party" id="manufactured_party" required>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="equipment_type">Equipment Type</label>
            <select class="form-control" name="equipment_type" id="equipment_type" required>
                <option value="0" selected>Select</option>
                <?php
                    foreach($equipment_type as $r){ ?>
                    <option value="<?php echo $r->equipment_type_id;?>"    
                    <?php if($this->input->post('equipment_type') == $r->equipment_type_id) echo " selected "; ?>
                    ><?php echo $r->equipment_type;?></option>    
                    <?php }  ?>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="equipment_category">Equipment Category</label>
            <select class="form-control" name="equipment_category" id="equipment_category" required>
                <option value="0" selected>Select</option>
                <?php
                    foreach($equipment_category as $r){ ?>
                    <option value="<?php echo $r->id;?>"    
                    <?php if($this->input->post('equipment_category') == $r->id) echo " selected "; ?>
                    ><?php echo $r->equipment_category;?></option>    
                    <?php }  ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <label for="equipment_type">Location</label>
            <select class="form-control" name="location" id="location" required>
                <option value="0" selected>Location</option>
                <?php
                    foreach($location as $r){ ?>
                    <option value="<?php echo $r->location_id;?>"    
                    <?php if($this->input->post('location') == $r->location_id) echo " selected "; ?>
                    ><?php echo $r->location;?></option>    
                    <?php }  ?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for=""> </label>
            <button type="button" class='btn btn-primary btn-block' onclick='loadData()' >Submit</button>                        
        </div>
    </div>

    <div class="row">
        <table id="equipments_data" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Equipment Name</th>
                    <th scope="col">Equipment Type</th>
                    <th scope="col">Functional Status</th>
                    <th scope="col">Functional Status</th>
                    <th scope="col">Functional Status</th>
                    <th scope="col">Functional Status</th>
                    <th scope="col">Functional Status</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                    </tr>
                    <tr>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                    </tr>
                    <tr>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    
    $(function () {
        initDropdown('donor_party', '<?php echo json_encode($donor_parties); ?>');
        initDropdown('procured_by_party', '<?php echo json_encode($procured_by_parties); ?>');
        initDropdown('supplier_party', '<?php echo json_encode($supplier_parties); ?>');
        initDropdown('manufactured_party', '<?php echo json_encode($manufactured_parties); ?>');

    });

    function escapeSpecialChars(str) {
        return str.replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\t/g, "\\t");
    }

    function initDropdown(id, list){
        let data = JSON.parse(escapeSpecialChars(list));
        console.log(data);
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
                if (!query.length) return callback();
            },

        });
    }
</script>

