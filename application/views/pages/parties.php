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

    .round-button{
        border-radius:100%;
        border: solid 1px;
        margin-left:15px;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white">
           <h4> Parties </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <table id="table-sort" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="text-align:center">#</th>
                            <th style="text-align:center">Party Name</th>
                            <th style="text-align:center">Party Type</th>
                            <th style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=1;
                            foreach($parties as $r){ ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $r->party_name; ?></td>
                                <td><?php echo $r->party_type; ?></td>
                                <td>
                                    <button id="view-party" class="btn btn-info btn-sm round-button" onclick="view_party(<?=$r->party_id; ?>)"><i class='fa fa-external-link' aria-hidden='true'></i></button>
                                   <?php if($edit_party_access && in_array( $r->party_id,$user_party_ids)) { ?> 
                                        <button id="edit-party" class="btn btn-info btn-sm round-button" onclick="update_party(<?=$r->party_id; ?>)"><i class='fa fa-pencil' aria-hidden='true'></i></button>
                                    <?php } ?>
                                    <!-- <button id="delete-party" class="btn btn-info btn-sm round-button" onclick="delete_party(<?=$r->party_id; ?>)"><i class='fa fa-trash' aria-hidden='true'></i></button> -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
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
                resizable_widths: ['5%', '40%', '30%', '25%'],
                uitheme : 'jui'
            }
        };
        // $.tablesorter.fixColumnWidth("table-sort");
        $("table").tablesorter(options);
    });

    function view_party(id){
        window.open("<?php echo base_url()."parties/view/";?>"+id, '_blank');
    }

    function update_party(id){
        window.open("<?php echo base_url()."parties/edit/";?>"+id, '_blank');
    }

    function delete_party($id){
        // TODO:
    }
</script>