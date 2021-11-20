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
    .page_dropdown{
        position: relative;
        float: left;
        padding: 6px 12px;
        width: auto;
        height: 34px;
        line-height: 1.428571429;
        text-decoration: none;
        background-color: #ffffff;
        border: 1px solid #dddddd;
        margin-left: -1px;
        color: #428bca;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        display: inline;
    }
    .page_dropdown:hover{
        background-color: #eeeeee;
        color: #2a6496;
    }
    .page_dropdown:focus{
        color: #2a6496;
        outline:0px;	
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
    .rows_per_page{
        display: inline-block;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #555555;
        vertical-align: middle;
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #cccccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }
    .rows_per_page:focus{
        border-color: #66afe9;
        outline: 0;	
    }
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<?php $page_no = 1;	 ?>
<div class="container">
    <form id="equipment_data" action="<?= base_url('home'); ?>" method="POST">
        <div class="row">
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
                <label for="donor_party">Donor</label>
                <select class="form-control" name="donor_party" id="donor_party">
                    <option value="0" selected>Select</option>
                    <?php
                        foreach($donor_parties as $r){ ?>
                        <option value="<?php echo $r->party_id;?>"    
                        <?php if($this->input->post('donor_party') == $r->party_id) echo " selected "; ?>
                        ><?php echo $r->party_name;?></option>    
                        <?php }  ?>
                </select>
            </div>
            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                <label for="procured_by_party">Procured by</label>
                <select class="form-control" name="procured_by_party" id="procured_by_party">
                    <option value="0" selected>Select</option>
                    <?php
                        foreach($procured_by_parties as $r){ ?>
                        <option value="<?php echo $r->party_id;?>"    
                        <?php if($this->input->post('procured_by_party') == $r->party_id) echo " selected "; ?>
                        ><?php echo $r->party_name;?></option>    
                        <?php }  ?>
                </select>
            </div>
            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                <label for="supplier_party">Supplier</label>
                <select class="form-control" name="supplier_party" id="supplier_party">
                    <option value="0" selected>Select</option>
                    <?php
                        foreach($supplier_parties as $r){ ?>
                        <option value="<?php echo $r->party_id;?>"    
                        <?php if($this->input->post('supplier_party') == $r->party_id) echo " selected "; ?>
                        ><?php echo $r->party_name;?></option>    
                        <?php }  ?>
                </select>
            </div>
            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                <label for="manufactured_party">Manufacturer</label>
                <select class="form-control" name="manufactured_party" id="manufactured_party">
                    <option value="0" selected>Select</option>
                    <?php
                        foreach($manufactured_parties as $r){ ?>
                        <option value="<?php echo $r->party_id;?>"    
                        <?php if($this->input->post('manufactured_party') == $r->party_id) echo " selected "; ?>
                        ><?php echo $r->party_name;?></option>    
                        <?php }  ?>
                </select>
            </div>
            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                <label for="equipment_type">Equipment Type</label>
                <select class="form-control" name="equipment_type" id="equipment_type">
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
            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                <label for=""> </label>
                <button type="submit" class='btn btn-primary btn-block'>Submit</button>                        
            </div>
        </div>
    </form>

    <div class="row">
        <table id="table-sort" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align:center">#</th>
                    <th style="text-align:center">Equipment Type</th>
                    <th style="text-align:center">Equipment Name</th>
                    <th style="text-align:center">Serial Number</th>
                    <th style="text-align:center">Current Location</th>
                    <th style="text-align:center">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=1;
                    foreach($equipment_data as $r){ ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $r->equipment_type; ?></td>
                        <td><?php echo $r->equipment_name; ?></td>
                        <td><?php echo $r->serial_number; ?></td>
                        <td><?php echo 'TBU' ?></td>
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
    <div class="row">
    </div>
        <?php 
            if ($this->input->post('rows_per_page')){
                $total_records_per_page = $this->input->post('rows_per_page');
            }else{
                $total_records_per_page = $pagination->value;
            }

            if ($this->input->post('page_no')) { 
                $page_no = $this->input->post('page_no');
            }
            else{
                $page_no = 1;
            }

            $total_records = count($equipment_data);		
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
            if ($total_no_of_pages==0)
                $total_no_of_pages = 1;
            $second_last = $total_no_of_pages - 1; 
            $offset = ($page_no-1) * $total_records_per_page;
            $previous_page = $page_no - 1;
            $next_page = $page_no + 1;
            $adjacents = "2";	
        ?>
        <ul class="pagination" style="margin:0">
            <?php if($page_no > 1){
                echo "<li class='page-item'><span class='page-link' href=# onclick=doPost(1)>First Page</span></li>";
            } ?>

            <li class='page-item' <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
            <a class='page-link' <?php if($page_no > 1){
                echo "href=# onclick=doPost($previous_page)";
            } ?>>Previous</a>
            </li>
            <?php
                if ($total_no_of_pages <= 10){  	 
                    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                        if ($counter == $page_no) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                        } else{
                        echo "<li class='page-item'><a class='page-link' href=# onclick=doPost($counter)>$counter</a></li>";
                        }
                    }
                }
                else if ($total_no_of_pages > 10){
                    if($page_no <= 4) {			
                        for ($counter = 1; $counter < 8; $counter++){		 
                            if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                            } else {
                                echo "<li class='page-item'><a class='page-link' href=# onclick=doPost($counter)>$counter</a></li>";
                            }
                        }
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href=# onclick=doPost($second_last)>$second_last</a></li>";
                        echo "<li class='page-item'><a class='page-link' href=# onclick=doPost($total_no_of_pages)>$total_no_of_pages</a></li>";
                    }
                    elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
                        echo "<li class='page-item'><a class='page-link' href=# onclick=doPost(1)>1</a></li>";
                        echo "<li class='page-item'><a class='page-link' href=# onclick=doPost(2)>2</a></li>";
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents;$counter++) {		
                            if ($counter == $page_no) {
                                echo "<li class='active'><a class='page-link'>$counter</a></li>";	
                            }else{
                                echo "<li class='page-item'><a class='page-link' href=# onclick=doPost($counter)>$counter</a></li>";
                            }                  
                        }
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href=# onclick=doPost($counter) >$counter</a></li>";
                        echo "<li class='page-item'><a class='page-link' href=# onclick=doPost($total_no_of_pages)>$total_no_of_pages</a></li>";
                    }
                    else {
                        echo "<li class='page-item'><a class='page-link' href=# onclick=doPost(1)>1</a></li>";
                        echo "<li class='page-item'><a class='page-link' href=# onclick=doPost(2)>2</a></li>";
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        for ($counter = $total_no_of_pages - 6;$counter <= $total_no_of_pages;$counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='active'><a class='page-link'>$counter</a></li>";	
                            }else{
                                echo "<li class='page-item'><a class='page-link' href=# onclick=doPost($counter)>$counter</a></li>";
                            }                   
                        }
                    }
                }     
            ?>
            <li class='page-item' <?php if($page_no >= $total_no_of_pages){
                echo "class='disabled'";
            } ?>>
            <a class='page-link' <?php if($page_no < $total_no_of_pages) {
                echo "href=# onclick=doPost($next_page)";
            } ?>>Next</a>
            </li>

            <?php if($page_no < $total_no_of_pages){
                echo "<li class='page-item'><a class='page-link' href=# onclick=doPost($total_no_of_pages)>Last Page</a></li>";
            } ?>
            <?php if($total_no_of_pages > 0){
                echo "<li class='page-item'><select class='page_dropdown' onchange='onchange_page_dropdown(this)'>";
                for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                                echo "<option value=$counter ";
                                if ($page_no == $counter){
                                echo "selected";
                                }         
                                echo ">$counter</option>";
                }
                echo "</select></li>";
            } ?>
            </ul>
            <h5>Page <?php echo $page_no." of ".$total_no_of_pages." (Total ".$total_records.")" ; ?></h5>
    </div>
</div>

<script>
    
    $(function () {
        // initDropdown('donor_party', '<?php echo json_encode($donor_parties); ?>');
        // initDropdown('procured_by_party', '<?php echo json_encode($procured_by_parties); ?>');
        // initDropdown('supplier_party', '<?php echo json_encode($supplier_parties); ?>');
        // initDropdown('manufactured_party', '<?php echo json_encode($manufactured_parties); ?>');
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
                // if (!query.length) return callback();
                selectize[0].selectize.setValue(null);
            },

        });
    }

    function doPost(){
        var page_no_hidden = document.getElementById("page_no");
  	    page_no_hidden.value=page_no;
        $('#equipment_data').submit();   
    }
    function onchange_page_dropdown(dropdownobj){
       doPost(dropdownobj.value);    
    }

</script>

