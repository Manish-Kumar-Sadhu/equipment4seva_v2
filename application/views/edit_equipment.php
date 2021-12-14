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
        text-align:left;
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
    .round-button{
        border-radius:100%;
        border: solid 1px;
        margin-left:10px;
    }

</style>
<?php 
    $logged_in=$this->session->userdata('logged_in');
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white">
           <h4> Edit Equipment Details - ID : <?php echo $equipment->equipment_id; ?></h4>
        </div>
        <div class="card-body">
            <form id="edit_equipment" action="<?= base_url('equipments/edit/').$equipment_id; ?>" onsubmit="return validateForm()" method="POST">
                <input type="hidden" name="form_for" value="update_equipment_details">
                <div class="row">
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="equipment_category">Equipment Category</label>
                        <select class="form-control" name="equipment_category" id="equipment_category" onchange="filter_equipment_type('equipment_category','equipment_type', <?php echo $equipment->equipment_type_id;?>)" required>
                            <option value="" selected>Equipment Category</option>
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
                            <option value="" selected>Equipment Type</option>
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
                        <select name="manufactured_party" id="manufactured_party" placeholder="Manufacturer">
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
                        <select name="supplier_party" id="supplier_party" placeholder="Supplier">
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="procured_by_party">Procured by <span class="star" style="color:red"> *</span></label>
                        <select name="procured_by_party" id="procured_by_party" placeholder="Procured by">
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="procurement_status">Procurement status</label>
                        <select class="form-control" name="procurement_status" id="procurement_status">
                            <option value="0" selected>Procurement status</option>
                            <?php
                                foreach($equipment_procurement_status as $r){ ?>
                                <option value="<?php echo $r->equipment_procurement_status_id;?>"    
                                <?php if($this->input->post('equipment_procurement_status') == $r->equipment_procurement_status_id || $equipment->procurement_status_id == $r->equipment_procurement_status_id ) echo " selected "; ?>
                                ><?php echo $r->procurement_status;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="procurement_type">Procurement type</label>
                        <select class="form-control" name="procurement_type" id="procurement_type">
                            <option value="0" selected>Procurement type</option>
                            <?php
                                foreach($equipment_procurement_type as $r){ ?>
                                <option value="<?php echo $r->equipment_procurement_type_id;?>"    
                                <?php if($this->input->post('equipment_procurement_type') == $r->equipment_procurement_type_id || $equipment->equipment_procurement_type_id == $r->equipment_procurement_type_id) echo " selected "; ?>
                                ><?php echo $r->procurement_type;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="donor_party">Donor</label>
                        <select  name="donor_party" id="donor_party" placeholder="Donor" >
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
                        <input class="form-control" name="installation_date" type="date" value="<?= $equipment->installation_date; ?>">
                    </div>
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="journal_type">Journal Type</label>
                        <select class="form-control" name="journal_type" id="journal_type">
                            <option value="0" selected>Journal type</option>
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
                    <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <label for="functional_status">Functional Status</label>
                        <select class="form-control" name="functional_status" id="functional_status">
                            <option value="0" selected>Functional Status</option>
                            <?php
                                foreach($equipment_functional_status as $r){ ?>
                                <option value="<?php echo $r->functional_status_id;?>"    
                                <?php if($this->input->post('functional_status') == $r->functional_status_id || $equipment->functional_status_id == $r->functional_status_id ) echo " selected "; ?>
                                ><?php echo $r->working_status;?></option>    
                                <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-xs-12">
                        <label for="note">Note</label>
                        <textarea class="form-control" name="note" rows="1"><?= $equipment->note; ?></textarea>
                    </div>
                    <div class="form-group col-md-12 col-lg-12 col-xs-12">
                        <button type="submit" class='btn btn-info btn-block'>Submit</button>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b> Created By :</b> <?php echo $equipment->created_user_first_name ? $equipment->created_user_first_name :''; echo $equipment->created_user_last_name ? ' '.$equipment->created_user_last_name.', ' : ''; echo $equipment->equipment_created_datetime ? date("d-M-Y h:i A", strtotime($equipment->equipment_created_datetime)) : ''; ?>
                    </div>
                    <div class="col-md-6">
                        <b> Last Updated By :</b> <?php echo $equipment->last_updated_user_first_name ? $equipment->last_updated_user_first_name : ''; echo  $equipment->last_updated_user_last_name ? ' '.$equipment->last_updated_user_last_name.', ' : ''; echo $equipment->equipment_last_updated_datetime ? date("d-M-Y h:i A", strtotime($equipment->equipment_last_updated_datetime)) : ''; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php if($view_equipment_location_access) { ?>
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4>Location Information</h4>
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
                            <th style="text-align:center">Created by</th>
                            <th style="text-align:center">Updated by</th>
                            <th style="text-align:center">Note</th>
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
                                <td><?php echo $r->created_user_first_name.' '.$r->created_user_last_name; ?></td>
                                <td><?php echo $r->last_updated_user_first_name.' '.$r->last_updated_user_last_name; ?></td>
                                <td><?php echo $r->note; ?></td>
                            </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </div>
            <?php if($add_equipment_location_access) { ?>
            <div class="card-body">
                <form id="add_location" action="<?=  base_url('equipments/edit/').$equipment_id; ?>" method="POST">
                    <input type="hidden" name="form_for" value="add_equipment_location_log">
                    <div class="row">
                        <div class="form-group col-md-4 col-lg-3 col-xs-12">
                            <label for="location">Location<span class="star" style="color:red"> *</span></label>
                            <select class="form-control" name="location" id="location" required>
                                <option value="" selected>Location</option>
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
                            <select name="receiver_party_id" id="receiver_party_id" placeholder="Receiver party" required>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-lg-3 col-xs-12">
                            <label for="address">Address</label>
                            <input class="form-control" name="address" type="text">
                        </div>
                        <div class="form-group col-md-4 col-lg-3 col-xs-12">
                            <label for="delivery_date">Delivery Date<span class="star" style="color:red"> *</span></label>
                            <input class="form-control" name="delivery_date" type="date" max="<?php echo date("Y-m-d") ?>" required >
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
            <?php } ?>
        </div>
    <?php } if($view_equipment_document_access) {?>
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4>Equipment Document Information </h4>
            </div>
            <div class="card-body">
                <table id="table-sort" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="text-align:center">#</th>
                            <th style="text-align:center">Document type</th>
                            <th style="text-align:center">Document date</th>
                            <th style="text-align:center">Created by</th>
                            <th style="text-align:center">updated by</th>
                            <th style="text-align:center">Note</th>
                            <th style="text-align:center">Document actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=1;
                            foreach($equipment_documents as $r){ ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $r->document_type; ?></td>
                                <td  style="text-align:center"><?php  echo date("d-M-Y", strtotime($r->document_date)); ?></td>
                                <td><?php echo $r->created_user_first_name.' '.$r->created_user_last_name; ?></td>
                                <td><?php echo $r->last_updated_user_first_name.' '.$r->last_updated_user_last_name; ?></td>
                                <td><?php echo $r->equipment_document_note; ?></td>
                                <td>
                                    <button id="view-document" class="btn btn-info btn-sm round-button" onclick="view_document('<?=$r->document_link; ?>');"><i class='fa fa-external-link' aria-hidden='true'></i></button>
                                    <?php if($edit_equipment_document_access) { ?>
                                        <button id="edit-document" class="btn btn-info btn-sm round-button" onclick="edit_document('<?=$r->document_link; ?>');"><i class='fa fa-pencil' aria-hidden='true'></i></button>
                                    <?php } if($delete_equipment_document_access) { ?>
                                        <button id="delete-document" class="btn btn-danger btn-sm round-button" onclick="delete_document('<?=$r->id; ?>');"><i class='fa fa-trash' aria-hidden='true'></i></button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </div>
            <?php if($add_equipment_document_access) { ?>
                <div class="card-body">
                    <form enctype="multipart/form-data" id="add_equipment_document" action="<?= base_url('equipments/edit/').$equipment_id; ?>" method="POST">
                        <input type="hidden" name="form_for" value="upload_equipment_document">
                        <div class="row">
                            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                                <label for="document_type">Document type<span class="star" style="color:red"> *</span></label>
                                <select class="form-control" name="document_type" id="document_type" required>
                                    <option value="" selected>Document type</option>
                                    <?php
                                        foreach($equipment_document_type as $r){ ?>
                                        <option value="<?php echo $r->document_type_id;?>"    
                                        <?php if($this->input->post('document_type') == $r->document_type_id) echo " selected "; ?>
                                        ><?php echo $r->document_type;?></option>    
                                        <?php }  ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                                <label for="document_date">Document date<span class="star" style="color:red"> *</span></label>
                                <input class="form-control" name="document_date" type="date"  max="<?php echo date("Y-m-d") ?>" required>
                            </div>
                            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                                <label for="upload_file">Upload Image<span class="star" style="color:red"> *</span></label>
                                <input type="text" class="sr-only" hidden name="document_link"/>
                                <input type="file" name="upload_file" id="upload_file" required>
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
            <?php } ?>
        </div>
    <?php } ?>
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
        initDropdown('procured_by_party', '<?php echo json_encode($procured_by_parties); ?>', <?php echo $equipment->procured_by_party_id;?>);
        initDropdown('supplier_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->supplier_party_id;?>);
        initDropdown('manufactured_party', '<?php echo json_encode($party); ?>', <?php echo $equipment->manufacturer_party_id;?>);
        initDropdown('receiver_party_id', '<?php echo json_encode($party); ?>');
        //reseting dropdowns on page load
        $("#location, #document_type").val('');
        filter_equipment_type('equipment_category','equipment_type', <?php echo $equipment->equipment_type_id;?>);
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
                resizable_widths: [ '1%', '15%', '15%', '18%','10%', '13%', '13%', '20%'],
                uitheme : 'jui'
            }
        };
        // $.tablesorter.fixColumnWidth("table-sort");
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

    function filter_equipment_type(category, id, selected_equipment_type_id){
        let equipment_types = <?php echo json_encode($equipment_type); ?>;
        let selected_category = $(`#${category}`).val();
        let filtered_equipment_types;
        $(`#${id}`).empty();
        filtered_equipment_types = $.grep(equipment_types , function(v){
            return v.equipment_category_id == selected_category;
        }) ;
        // console.log(filtered_equipment_types);  
        // iterating the filtered equipment types
        $.each(filtered_equipment_types, function (indexInArray, valueOfElement) { 
            const {equipment_type_id ,equipment_type} = valueOfElement;
            let optionElement = $('<option></option>').val(equipment_type_id).html(equipment_type);
            if(selected_equipment_type_id && selected_equipment_type_id == equipment_type_id){
                $(optionElement).attr('selected', true);
            }
            $(`#${id}`).append(optionElement);
        });
    }

    function validateForm(){
        if(!$("#procured_by_party").val()){
            swal({
                title: "Error",
                text: "Please select procured by",
                type: "error"
            });
            return false;
        }
        return true;
    }

    function view_document(document_link){
        window.open("<?php echo base_url()."document/";?>"+document_link, '_blank');
    }

    function delete_document(id){
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this document!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonClass: "btn btn-outline-secondary",
            cancelButtonText: "Cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "DELETE",
                    accepts: {
                        contentType: "application/json"
                    },
                    url: "<?= base_url() ?>equipments/delete_document/"+id,
                    dataType: "text",
                    success: function (response) {
                        const res =  JSON.parse(response);
                        swal({
                            title: "Success",
                            text: "Question has been deleted!",
                            type: "success",
                            timer: 2000
                        });
                        location.reload();
                    },
                    error: function(){
                        swal({
                            title: "Cancelled",
                            text: "Something went wrong. Please try again!",
                            type: "error",
                            timer: 2000
                        })
                    }
                });
            } else {
                swal({
                    title: "Cancelled",
                    text: "Document is safe!",
                    type: "error",
                    timer: 2000
                })
            }
            });  
    }

    // tooltips
    tippy("#view-document", {
        content : 'view document'
    });
    tippy("#edit-document", {
        content : 'edit document'
    });
    tippy("#delete-document", {
        content : 'delete document'
    });
</script>