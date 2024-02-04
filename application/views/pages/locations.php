<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style type="text/css">
    label {
        font-weight: bold;
    }

    .card {
        margin-top: 2rem;
    }

    .card-header {
        text-align: center;
    }

    select {
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

    .round-button {
        border-radius: 100%;
        border: solid 1px;
        margin-left: 15px;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.default.css">
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4> Locations </h4>
        </div>
        <div class="card-body">
        <form id="index" action="<?= base_url('location/'); ?>" method="POST">
            <div class="row">
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <select class="form-control" name="state" id="state" onchange="filter_districts()"
                        required>
                        <option value="0" selected>State</option>
                        <?php
                        foreach ($states as $r) { ?>
                            <option value="<?php echo $r->state_id; ?>" <?php if ($this->input->post('state') == $r->state_id)
                                  echo " selected "; ?>>
                                <?php echo $r->state; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                        <select class="form-control" name="district" id="district" required>
                            <option value="0" selected>District</option>
                            <?php
                                foreach($districts as $r){ ?>
                                <option value="<?php echo $r->district_id;?>"    
                                <?php if($this->input->post('district') == $r->district_id) echo " selected "; ?>
                                ><?php echo $r->district;?></option>    
                                <?php }  ?>
                        </select>
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <button type="submit" class='btn btn-primary'>Submit</button>
                </div>
            </div>
            <div class="row">
                <table id="table-sort" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="text-align:center">#</th>
                            <th style="text-align:center">State</th>
                            <th style="text-align:center">District</th>
                            <th style="text-align:center">Location Name</th>
                            <!-- <th style="text-align:center">Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($locations as $location) { ?>
                            <tr>
                                <td>
                                    <?php echo $i++; ?>
                                </td>
                                <td>
                                    <?php echo $location->state; ?>
                                </td>
                                <td>
                                    <?php echo $location->district; ?>
                                </td>
                                <td>
                                    <?php echo $location->location; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            </form>
        </div>
        
    </div>
</div>

<script>
    $(function () {

        let currentState = $('#state').val();
        if (currentState !== '0') {
            // If state is selected, trigger filter_districts function
            filter_districts();
        }
        var options = {
            widthFixed: false,
            showProcessing: true,
            headerTemplate: '{content} {icon}', // Add icon for jui theme; new in v2.7!
            cssInfoBlock: "tablesorter-no-sort",
            widgets: ['default', 'zebra', 'print', 'columns', 'stickyHeaders', 'filter', 'resizable'],
            widgetOptions: {
                print_title: 'table',          // this option > caption > table id > "table"
                print_dataAttrib: 'data-name', // header attrib containing modified header name
                print_rows: 'f',         // (a)ll, (v)isible or (f)iltered
                print_columns: 's',         // (a)ll, (v)isible or (s)elected (columnSelector widget)
                print_extraCSS: '.table{border:1px solid #ccc;} tr,td{background:white}',          // add any extra css definitions for the popup window here
                print_styleSheet: '', // add the url of your print stylesheet
                // callback executed when processing completes - default setting is null
                print_callback: function (config, $table, printStyle) {
                    // do something to the $table (jQuery object of table wrapped in a div)
                    // or add to the printStyle string, then...
                    // print the table using the following code
                    $.tablesorter.printTable.printOutput(config, $table.html(), printStyle);
                },
                // extra class name added to the sticky header row
                stickyHeaders: '',
                // number or jquery selector targeting the position:fixed element
                stickyHeaders_offset: 0,
                // added to table ID, if it exists
                stickyHeaders_cloneId: '-sticky',
                // trigger "resize" event on headers
                stickyHeaders_addResizeEvent: true,
                // if false and a caption exist, it won't be included in the sticky header
                stickyHeaders_includeCaption: false,
                // The zIndex of the stickyHeaders, allows the user to adjust this to their needs
                stickyHeaders_zIndex: 2,
                // jQuery selector or object to attach sticky header to
                stickyHeaders_attachTo: null,
                // scroll table top into view after filtering
                stickyHeaders_filteredToTop: true,

                // adding zebra striping, using content and default styles - the ui css removes the background from default
                // even and odd class names included for this demo to allow switching themes
                // zebra   : ["ui-widget-content even", "ui-state-default odd"],
                // use uitheme widget to apply defauly jquery ui (jui) class names
                // see the uitheme demo for more details on how to change the class names
                resizable: false,
                resizable_widths: ['5%', '30%', '20%', '45%'],
                uitheme: 'jui'
            }
        };
        // $.tablesorter.fixColumnWidth("table-sort");
        $("table").tablesorter(options);
    });

    function filter_districts(){
        let districts = <?php echo json_encode($districts); ?>;
        let selected_state = $(`#state`).val();
        let filtered_ditricts;
        $(`#district`).empty().append(`<option value="0" selected>----------Select----------</option>`);
        filtered_ditricts = $.grep(districts , function(v){
            return v.state_id == selected_state;
        }) ;
        console.log(filtered_ditricts);  
        // iterating the filtered equipment types
        $.each(filtered_ditricts, function (indexInArray, valueOfElement) { 
            const {district_id ,district} = valueOfElement;
            $(`#district`).append($('<option></option>').val(district_id).html(district));
        });
    }

</script>