<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
    label{
        font-weight:bold;
    }
    .disabled {
        cursor: not-allowed;
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
    select{
        cursor: pointer;
    }
    input[type=date] {
        cursor: pointer;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<?php
    $logged_in=$this->session->userdata('logged_in');
    $default_party_id = $logged_in['default_party_id'];
    $to_date = $this->input->post('to_date');
    $from_date = $this->input->post('from_date');
    $donor_party = $this->input->post('donor_party');
    $selected_equipment_type_id = $this->input->post('equipment_type');
    $procured_by_party = $this->input->post('procured_by_party') ? $this->input->post('procured_by_party') : $default_party_id ;
    $supplier_party = $this->input->post('supplier_party');
    $manufactured_party = $this->input->post('manufactured_party');
    $group_by_equipment_type = $this->input->post('group_by_equipment_type');
    $group_by_equipment_category = $this->input->post('group_by_equipment_category');
?>

<div class="container">
    <?php if($view_summary_report) { ?>
        <form id="summary_report" action="<?= base_url('reports/summary_report'); ?>" method="POST">
            <input type="hidden" id="1" name="postback" value="1">
            <div class="row">
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="equipment_category">Equipment Category</label>
                    <select class="form-control" name="equipment_category" id="equipment_category" onchange="filter_equipment_type('equipment_category','equipment_type')">
                        <option value="0" selected>Equipment Category</option>
                        <?php
                            foreach($equipment_category as $r){ ?>
                            <option value="<?php echo $r->id;?>"    
                            <?php if($this->input->post('equipment_category') == $r->id) echo " selected "; ?>
                            ><?php echo $r->equipment_category;?></option>    
                            <?php }  ?>
                    </select>
                    <?php if(!$this->input->post('postback')) { ?>				  
                        <input type="checkbox" name="group_by_equipment_category" id="group_by_equipment_category" value="1" checked onclick="handleClick();"  > <span>Group by equipment category</span>
                    <?php } else { ?>
                        <input type="checkbox" name="group_by_equipment_category" id="group_by_equipment_category" value="1" <?php if($group_by_equipment_category) echo "checked";?> onclick="handleClick();"  > <span>Group by equipment category</span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="equipment_type">Equipment Type</label>
                    <select class="form-control" name="equipment_type" id="equipment_type">
                        <option value="" selected>Equipment Type</option>
                        <?php
                            foreach($equipment_type as $r){ ?>
                            <option value="<?php echo $r->equipment_type_id;?>"    
                            <?php if($this->input->post('equipment_type') == $r->equipment_type_id || $selected_equipment_type_id == $r->equipment_type_id) echo " selected "; ?>
                            ><?php echo $r->equipment_type;?></option>    
                            <?php }  ?>
                    </select>
                    <input type="checkbox" name="group_by_equipment_type" id="group_by_equipment_type" value="1" <?php if($group_by_equipment_type) echo "checked";?>  onclick="handleClick();" /> <span>Group by equipment type</span>
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="from_invoice_date">From Invoice date</label>
                    <input class="form-control" type="date" name="from_date" id="from_date" value=<?= $from_date?> >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="to_invoice_date">To Invoice date</label>
                    <input class="form-control" type="date" name="to_date" id="to_date" value=<?= $to_date?>>
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="donor_party">Donor</label>
                    <select name="donor_party" id="donor_party" placeholder="Donor">
                    </select>
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="procured_by_party">Procured by</label>
                    <select name="procured_by_party" id="procured_by_party" placeholder="Procured by">
                    </select>
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="supplier_party">Supplier</label>
                    <select  name="supplier_party" id="supplier_party" placeholder="Supplier">
                    </select>
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="manufactured_party">Manufacturer</label>
                    <select  name="manufactured_party" id="manufactured_party" placeholder="Manufacturer">
                    </select>
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="equipment_type">Location</label>
                    <select class="form-control" name="location" id="location">
                        <option value="0" selected>Location</option>
                        <?php
                            foreach($location as $r){ ?>
                            <option value="<?php echo $r->location_id;?>"    
                            <?php if($this->input->post('location') == $r->location_id) echo " selected "; ?>
                            ><?php echo $r->location;?></option>    
                            <?php }  ?>
                    </select>
                </div>
                <div class="form-group col-md-2 col-lg-1 col-xs-12">
                    <button type="submit" class='btn btn-info' style="margin-top:1.75rem;">Submit</button>                        
                </div>
            </div>
        </form>
        <div class="row">
            <table id="table-sort" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align:center">#</th>
                        <?php if($group_by_equipment_category)  { ?>
                            <th style="text-align:center">Equipment Category</th>
                        <?php } if($group_by_equipment_type) { ?>
                            <th style="text-align:center">Equipment Type</th>
                        <?php } ?>
                        <th style="text-align:center">No. of records</th>
                        <th style="text-align:center">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $serial_number=1;
                        $total_no_of_records=0;
                        $grand_total_amount=0;
                        $val_count='';
                        foreach($summary_data as $r){
                            $val_count=0;
                        ?>
                        <tr>
                            <td><?php echo $serial_number++; ?></td>
                            <?php if($group_by_equipment_category)  { ?>
                                <td><?php echo $r->equipment_category; $val_count=$val_count +1; ?></td>
                            <?php } if($group_by_equipment_type) { ?>
                                <td><?php echo $r->equipment_type; $val_count=$val_count +1; ?></td>
                            <?php } ?>
                            <td style="text-align:right"><?php echo $r->no_of_records; ?></td>
                            <td style="text-align:right"><?php echo number_format($r->total_amount); ?></td>
                        </tr>
                    <?php
                        $total_no_of_records += $r->no_of_records;
                        $grand_total_amount += $r->total_amount;
                    }  ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align:center">Total</th>
                        <?php
                            for ($i = 0; $i < $val_count; $i++) {
                                echo "<th></th>";
                            }
                            ?>
                        <th style="text-align:right"><?php echo $total_no_of_records;  ?> </th>
                        <th style="text-align:right"><?php echo number_format($grand_total_amount);  ?> </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php }  else {?>
        <div class="row" style="margin-top:1rem;">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <p>You don't have access to view summary report. Please contact administrator</p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script>

    $(function () {
        initDropdown('donor_party', '<?php echo json_encode($donor_parties); ?>', <?php echo $donor_party; ?>);
        initDropdown('procured_by_party', '<?php echo json_encode($procured_by_parties); ?>', '<?= $procured_by_party ?>');
        initDropdown('supplier_party', '<?php echo json_encode($supplier_parties); ?>', <?php echo $supplier_party ?>);
        initDropdown('manufactured_party', '<?php echo json_encode($manufactured_parties); ?>', <?php echo $manufactured_party ?>);
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
                uitheme : 'jui'
            }
        };
        // $.tablesorter.fixColumnWidth("table-sort");
        $("table").tablesorter(options);
    });

    function escapeSpecialChars(str) {
        return str.replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\t/g, "\\t");
    }

    function initDropdown(id, list, val){
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
        if(val){
            selectize[0].selectize.setValue(val);
        }
    }

    function filter_equipment_type(category, id){
        let equipment_types = <?php echo json_encode($equipment_type); ?>;
        let selected_category = $(`#${category}`).val();
        let filtered_equipment_types;
        $(`#${id}`).empty().append(`<option value="0" selected>----------Select----------</option>`);
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

    function handleClick() {
    var groupByEquipmentCategory = document.getElementById("group_by_equipment_category");
    var groupByEquipmentType = document.getElementById("group_by_equipment_type");
    var groupbyicdcode = document.getElementById("groupbyicdcode");
    if ( !groupByEquipmentCategory.checked && !groupByEquipmentType.checked){
        groupByEquipmentCategory.checked = true;
    }
    }


</script>