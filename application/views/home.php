<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    label{
        font-weight:bold;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >

<div class="container">
    <div class="row">
        <div class="form-group col-md-4 col-lg-3 col-xs-12">
            <label for="donor_party">Donor</label>
            <select  name="donor_party" id="donor_party" >
            </select>
        </div>
        <div class="form-group col-md-4 col-lg-3 col-xs-12">
            <label for="procured_by_party">Receiver</label>
            <select name="procured_by_party" id="procured_by_party">
            </select>
        </div>
        <div class="form-group col-md-4 col-lg-3 col-xs-12">
            <label for="supplier_party">Supplier</label>
            <select name="supplier_party" id="supplier_party" required>
            </select>
        </div>
        <div class="form-group col-md-4 col-lg-3 col-xs-12">
            <label for="manufactured_party">Manufacturer</label>
            <select name="manufactured_party" id="manufactured_party" required>
            </select>
        </div>
        <div class="form-group col-md-4 col-lg-3 col-xs-12">
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
        <div class="form-group col-md-4 col-lg-3 col-xs-12">
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
        <div class="form-group col-md-4 col-lg-3 col-xs-12">
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
        <div class="form-group col-md-4 col-lg-3 col-xs-12">
            <label for=""> </label>
            <button type="button" class='btn btn-primary btn-block' onclick='loadData()' >Submit</button>                        
        </div>
    </div>

    <div class="row">
        <table id="table-sort" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align:center">#</th>
                    <th style="text-align:center">Equipment Name</th>
                    <th style="text-align:center">Equipment Type</th>
                    <th style="text-align:center">Model</th>
                    <th style="text-align:center">Asset Number</th>
                    <th style="text-align:center">Purchased Date</th>
                    <th style="text-align:center">Installation Date</th>
                    <th style="text-align:center">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=1;
                    foreach($equipment_data as $r){ ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $r->equipment_name; ?></td>
                        <td><?php echo $r->equipment_type_id; ?></td>
                        <td><?php echo $r->model; ?></td>
                        <td><?php echo $r->asset_number; ?></td>
                        <td><?php echo $r->purchase_order_date; ?></td>
                        <td><?php echo $r->installation_date; ?></td>
                        <td>
                            <a href=<?php echo base_url()."equipments/".$r->equipment_id; ?> target="_blank">
                                <i class='fa fa-external-link fa-lg' aria-hidden='true'>
                                </i>
                            </a>
                        </td>
                    </tr>
                <?php }  ?>
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
        var options = {
			widthFixed : false,
			showProcessing: true,
			headerTemplate : '{content} {icon}', // Add icon for jui theme; new in v2.7!
            cssInfoBlock : "tablesorter-no-sort",
			widgets: [ 'default', 'zebra', 'print', 'columns', 'stickyHeaders','filter'],
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
                uitheme : 'jui'
            }
        };
        // $.tablesorter.fixColumnWidth("table-sort");
        $("table").tablesorter(options);
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
                if (!query.length) return callback();
            },

        });
    }
</script>

