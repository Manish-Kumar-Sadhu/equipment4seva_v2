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

    .round-button{
        border-radius:100%;
        border: solid 1px;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<?php
    $logged_in=$this->session->userdata('logged_in');
    if($this->session->userdata('logged_in')){
        $user_party_ids =[];
        foreach ($user_parties as $key => $value) {
            array_push($user_party_ids, $value->party_id);
        }
    }
?>
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="row">
                <div class="col-md-<?php echo ($logged_in && in_array($equipment->procured_by_party_id, $user_party_ids))  ? '10' : '12'; ?>">
                    <h4>  Equipment Details </h4>
                </div> 
                <?php if($logged_in && in_array($equipment->procured_by_party_id, $user_party_ids) ) { ?>   
                    <div class="col-md-2" style="padding:5px;">
                        <button class="btn btn-light round-button" onclick="update_equipment('<?= $equipment->equipment_id; ?>')" ><i class='fa fa-pencil' aria-hidden='true'></i></button> 
                        <button class="btn btn-light round-button"><i class='fa fa-trash' aria-hidden='true'></i></button> 
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="equipment_category">Equipment Category</label>
                    <select class="form-control" name="equipment_category" id="equipment_category" onchange="filter_equipment_type('equipment_category','equipment_type')" required>
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
                <?php if($logged_in) { ?>
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
                <?php } ?>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="supply_date">Supply date</label>
                    <input class="form-control" name="supply_date" type="date" value="<?= $equipment->supply_date; ?>" >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="installation_date">Installation date</label>
                    <input class="form-control" name="installation_date" type="date" value="<?= $equipment->installation_date; ?>" >
                </div>
                <?php if($logged_in) { ?>
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
                <?php } ?>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="warranty_start_date">Warranty start date</label>
                    <input class="form-control" name="warranty_start_date" type="date" value="<?= $equipment->warranty_start_date; ?>" >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="warranty_end_date">Warranty end date</label>
                    <input class="form-control" name="warranty_end_date" type="date" value="<?= $equipment->warranty_end_date; ?>" >
                </div>
                <!-- <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="last_procured_by">Last procured by</label>
                    <select name="last_procured_by" id="last_procured_by" placeholder="----------Select----------">
                    </select>
                </div> -->
                <!-- <?php if($equipment_location_data) { ?>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="delivered_date">Delivered date</label>
                        <input class="form-control" name="delivered_date" type="date" value="<?= $equipment_location_data->delivery_date; ?>" >
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="current_location">Current Location</label>
                        <select class="form-control" name="current_location" id="current_location">
                            <?php
                                foreach($location as $r){ ?>
                                <option value="<?php echo $r->location_id;?>"    
                                <?php if($this->input->post('current_location') == $r->location_id || $equipment_location_data->location_id == $r->location_id) echo " selected "; ?>
                                ><?php echo $r->location;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="district">District</label>
                        <select class="form-control" name="district" id="district">
                            <option value="0" selected>----------Select----------</option>
                            <?php
                                foreach($district as $r){ ?>
                                <option value="<?php echo $r->district_id;?>"    
                                <?php if($this->input->post('district') == $r->district_id || $equipment_location_data->district_id == $r->district_id) echo " selected "; ?>
                                ><?php echo $r->district;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-xs-12">
                        <label for="current_address">Current address</label>
                        <textarea class="form-control" name="current_address" rows="1"><?= $equipment_location_data->address; ?></textarea>
                    </div>
                <?php } ?> -->
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                    <label for="note">Note</label>
                    <textarea class="form-control" name="note" rows="1"><?= $equipment->note; ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="row">
                <div class="col-md-12">
                    <h4>  Equipmet Location </h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table-sort" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align:center">#</th>
                        <th style="text-align:center">With</th>
                        <th style="text-align:center">Location</th>
                        <th style="text-align:center">District, State</th>
                        <th style="text-align:center">Delivery date</th>
                        <?php if($logged_in) { ?>
                            <th style="text-align:center">Note</th>
                        <?php }  ?> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=1;
                        foreach($equipment_location_history as $r){ ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $r->party_name; ?></td>
                            <td><?php echo $r->location;?> <?php echo $r->address ? '('.$r->address.')' : '' ?> </td>
                            <td><?php echo $r->district;", ".$r->state;  ?><?php  echo ", ".$r->state; ?> </td>
                            <td  style="text-align:center"><?php  echo date("d-M-Y", strtotime($r->delivery_date)); ?></td>
                            <?php if($logged_in) { ?>
                                <td><?php echo $r->note; ?></td>
                            <?php }  ?> 
                        </tr>
                    <?php }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    $(function () {
        $("input, select, textarea").attr('disabled',true);
        initDropdown('donor_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->donor_party_id;?>);
        initDropdown('procured_by_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->procured_by_party_id;?>);
        initDropdown('supplier_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->supplier_party_id;?>);
        initDropdown('manufactured_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->manufacturer_party_id;?>);
        /* // initDropdown('last_procured_by', '<?php echo json_encode($party); ?>', <?php echo $equipment_location_data->receiver_party_id;?>); */
        filter_equipment_type('equipment_category','equipment_type');
        var options = {
			widthFixed : false,
			showProcessing: true,
			headerTemplate : '{content} {icon}', // Add icon for jui theme; new in v2.7!
            cssInfoBlock : "tablesorter-no-sort",
			widgets: [ 'default', 'zebra', 'print', 'columns', 'stickyHeaders','filter','resizable'],
			widgetOptions: {
                print_title      : 'table',          // this option > caption > table id > "table"
                print_dataAttrib : 'data-name', // header attrib containing modified header name
                print_rows       : 'f',         // (a)ll, (v)isible or (f)iltered
                print_columns    : 's',         // (a)ll, (v)isible or (s)elected (columnSelector widget)
                print_extraCSS   : '.table{border:1px solid #ccc;} tr,td{background:white}',          // add any extra css definitions for the popup window here
                print_styleSheet : '', // add the url of your print stylesheet
                // callback executed when processing completes - default setting is null
                print_callback   : function(config, $table, printStyle){
                        // do something to the $table (jQuery object of table wrapped in a div)
                        // or add to the printStyle string, then...
                        // print the table using the following code
                        $.tablesorter.printTable.printOutput( config, $table.html(), printStyle );
                },
                // extra class name added to the sticky header row
                stickyHeaders : '',
                // number or jquery selector targeting the position:fixed element
                stickyHeaders_offset : 0,
                // added to table ID, if it exists
                stickyHeaders_cloneId : '-sticky',
                // trigger "resize" event on headers
                stickyHeaders_addResizeEvent : true,
                // if false and a caption exist, it won't be included in the sticky header
                stickyHeaders_includeCaption : false,
                // The zIndex of the stickyHeaders, allows the user to adjust this to their needs
                stickyHeaders_zIndex : 2,
                // jQuery selector or object to attach sticky header to
                stickyHeaders_attachTo : null,
                // scroll table top into view after filtering
                stickyHeaders_filteredToTop: true,

                // adding zebra striping, using content and default styles - the ui css removes the background from default
                // even and odd class names included for this demo to allow switching themes
                // zebra   : ["ui-widget-content even", "ui-state-default odd"],
                // use uitheme widget to apply defauly jquery ui (jui) class names
                // see the uitheme demo for more details on how to change the class names
                resizable:false,
                resizable_widths: [ '5%', '25%', '20%','30%'],
                uitheme : 'jui'
            }
        };
        $("table").tablesorter(options);
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

    
    function update_equipment(id){
        window.open("<?php echo base_url()."equipments/edit/";?>"+id);
    }

    function filter_equipment_type(category, id, selected_equipment_type_id){
        let equipment_types = <?php echo json_encode($equipment_type); ?>;
        let selected_category = $(`#${category}`).val();
        let filtered_equipment_types;
        $(`#${id}`).empty();
        filtered_equipment_types = $.grep(equipment_types , function(v){
            return v.equipment_category_id == selected_category;
        }) ;
        // iterating the filtered equipment types
        $.each(filtered_equipment_types, function (indexInArray, valueOfElement) { 
            const {equipment_type_id ,equipment_type} = valueOfElement;
            $(`#${id}`).append($('<option></option>').val(equipment_type_id).html(equipment_type));
        });
    }
</script>