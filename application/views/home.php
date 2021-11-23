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
    .pages-info{
        display: flex;
        justify-content: center;
    }
    .page_dropdown{
        position: relative;
        float: left;
        padding: 0.5rem 0.75rem;
        width: auto;
        height: 38px;
        line-height: 1.25;
        text-decoration: none;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
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
    /* .equipment_actions{
        padding:1.5rem;
        text-decoration:none;
    } */
    .round-button{
        border-radius:100%;
        border: solid 1px;
        margin-left:1.2rem
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
    $page_no = 1;
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

    $total_records = $equipment_count->count;		
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    if ($total_no_of_pages==0)
        $total_no_of_pages = 1;
    $second_last = $total_no_of_pages - 1; 
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";	
?>
<?php
    //  fetching default party_id of loggedIn user
    if($this->session->userdata('logged_in')){
        $default_party_id = $this->session->userdata('logged_in')['default_party_id'];
    }
    $to_date = $this->input->post('to_date');
    $from_date = $this->input->post('from_date');
    $donor_party = $this->input->post('donor_party');
    $selected_equipment_type_id = $this->input->post('equipment_type');
    $procured_by_party = $this->input->post('procured_by_party');
    $supplier_party = $this->input->post('supplier_party');
    $manufactured_party = $this->input->post('manufactured_party');
?>
<div class="container">
    <form id="equipment_data" action="<?= base_url('home'); ?>" method="POST">
        <div class="row">
            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                <label for="equipment_category">Equipment Category</label>
                <select class="form-control" name="equipment_category" id="equipment_category" onchange="filter_equipment_type('equipment_category','equipment_type')">
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
                <label for="equipment_type">Equipment Type</label>
                <select class="form-control" name="equipment_type" id="equipment_type">
                    <option value="0" selected>----------Select----------</option>
                    <?php
                        foreach($equipment_type as $r){ ?>
                        <option value="<?php echo $r->equipment_type_id;?>"    
                        <?php if($this->input->post('equipment_type') == $r->equipment_type_id || $selected_equipment_type_id == $r->equipment_type_id) echo " selected "; ?>
                        ><?php echo $r->equipment_type;?></option>    
                        <?php }  ?>
                </select>
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
                <select name="donor_party" id="donor_party" placeholder="----------Select----------">
                </select>
            </div>
            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                <label for="procured_by_party">Procured by</label>
                <select name="procured_by_party" id="procured_by_party" placeholder="----------Select----------">
                </select>
            </div>
            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                <label for="supplier_party">Supplier</label>
                <select  name="supplier_party" id="supplier_party" placeholder="----------Select----------">
                </select>
            </div>
            <div class="form-group col-md-4 col-lg-3 col-xs-12">
                <label for="manufactured_party">Manufacturer</label>
                <select  name="manufactured_party" id="manufactured_party" placeholder="----------Select----------">
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
            <input type="hidden" name="page_no" id="page_no" value='<?php echo "$page_no"; ?>'/>	
            <div class="form-group col-md-2">
            <label for="rows_per_page">Rows per page</label>
                <input type="number" class="rows_per_page" name="rows_per_page" id="rows_per_page" min=<?php echo $pagination->lower_range; ?> max= <?php echo $pagination->upper_range;; ?> step="1" value= <?php if($this->input->post('rows_per_page')) { echo $this->input->post('rows_per_page'); }else{echo $pagination->value;}  ?> onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" /> 
            </div>
            <div class="form-group col-md-2 col-lg-1 col-xs-12">
                <button type="submit" class='btn btn-info' style="margin-top:1.75rem;">Submit</button>                        
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 col-lg-12" style='padding: 0px 0.1rem 0.5rem'>
            <span>Report as on <?php echo date("j-M-Y h:i A"); ?></span>
        </div>
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
        <div class="col-md-12 col-lg-12" style='padding: 0.5rem 0.1rem'>
            <span>Page <?php echo $page_no." of ".$total_no_of_pages." (Total ".$total_records.")" ; ?></span>
        </div>
    </div>
    <div class="row">
        <table id="table-sort" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align:center">#</th>
                    <th style="text-align:center">Equipment Type</th>
                    <th style="text-align:center">Equipment Name</th>
                    <th style="text-align:center">Serial Number</th>
                    <th style="text-align:center">Current Location</th>
                    <th style="text-align:center">Invoice Date</th>
                    <th style="text-align:center">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=(($page_no - 1)* $total_records_per_page) + 1;
                    foreach($equipment_data as $r){ ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $r->equipment_type; ?></td>
                        <td><?php echo $r->equipment_name; ?></td>
                        <td><?php echo $r->serial_number; ?></td>
                        <td><?php echo $r->location; ?></td>
                        <td style="text-align:center"><?php echo  date("d-M-Y", strtotime($r->invoice_date)); ?></td>
                        <td>
                            <button class="btn btn-info btn-sm round-button" onclick="show_equipment(<?=$r->equipment_id; ?>);"><i class='fa fa-external-link' aria-hidden='true'></i></button>
                            <?php if($edit_equipment_access && $default_party_id==$r->procured_by_party_id){ ?>
                                <button class="btn btn-info btn-sm round-button" onclick="update_equipment(<?=$r->equipment_id; ?>)"><i class='fa fa-pencil' aria-hidden='true'></i></button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }  ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12" style='padding: 0 0.1rem 0.5rem'>
            <span>Page <?php echo $page_no." of ".$total_no_of_pages." (Total ".$total_records.")" ; ?></span>
        </div>
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
    </div>
</div>

<script>
    
    $(function () {
        initDropdown('donor_party', '<?php echo json_encode($donor_parties); ?>', <?php echo $donor_party; ?>);
        initDropdown('procured_by_party', '<?php echo json_encode($procured_by_parties); ?>', <?php echo $procured_by_party ?>);
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
                resizable_widths: [ '5%', '10%', '20%','20%','20%','10%', '20%'],
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

    function doPost(page_no){
        var page_no_hidden = document.getElementById("page_no");
  	    page_no_hidden.value=page_no;
        $('#equipment_data').submit();   
    }
    
    function onchange_page_dropdown(dropdownobj){
       doPost(dropdownobj.value);    
    }
    
    function show_equipment(id){
        window.open("<?php echo base_url()."equipments/view/";?>"+id, '_blank');
    }

    function update_equipment(id){
        window.open("<?php echo base_url()."equipments/edit/";?>"+id, '_blank');
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

</script>

