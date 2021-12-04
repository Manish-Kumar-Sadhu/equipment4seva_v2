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
    .round-button{
        border-radius:100%;
        border: solid 1px;
    }
    .selectize-control .selectize-input.disabled{
        opacity: 1;
        background-color:#e9ecef;
    }
</style>
<?php
    $logged_in=$this->session->userdata('logged_in');
?>
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="row">
                <div class="col-md-10">
                    <h4>  Party Details : <?php echo $party->party_name; ?> </h4>
                </div>
                <?php if($logged_in) { ?>   
                    <div class="col-md-2">
                        <button id="edit-party" class="btn btn-light round-button" onclick="update_party('<?= $party_id; ?>')" ><i class='fa fa-pencil' aria-hidden='true'></i></button> 
                        <button id="delete-party" class="btn btn-light round-button"><i class='fa fa-trash' aria-hidden='true'></i></button> 
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="party_name">Party Name</label>
                    <input class="form-control" name="party_name" type="text" value="<?= $party->party_name; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="party_type">Party Type</label>
                    <input class="form-control" name="party_type" type="text" value="<?= $party->party_type; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="party_address">Party Address</label>
                    <input class="form-control" name="party_address" type="text" value="<?= $party->party_address; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="place">Place</label>
                    <input class="form-control" name="place" type="text" value="<?= $party->place; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="bank_account_no">Bank Account No.</label>
                    <input class="form-control" name="bank_account_no" type="text" value="<?= $party->bank_account_no; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="bank_name">Bank Name</label>
                    <input class="form-control" name="bank_name" type="text" value="<?= $party->bank_name; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="bank_branch">Bank Branch</label>
                    <input class="form-control" name="bank_branch" type="text" value="<?= $party->bank_branch; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="bank_branch_ifsc">Branch IFSC Code</label>
                    <input class="form-control" name="bank_branch_ifsc" type="text" value="<?= $party->bank_branch_ifsc; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="party_email">Party Email</label>
                    <input class="form-control" name="party_email" type="text" value="<?= $party->party_email; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="party_phone">Party Phone</label>
                    <input class="form-control" name="party_phone" type="number" value="<?= $party->party_phone; ?>" disabled >
                </div>
                <div class="form-group col-md-4 col-lg-3 col-xs-12">
                    <label for="party_pan">Party Pan No.</label>
                    <input class="form-control" name="party_pan" type="number" value="<?= $party->party_pan; ?>" disabled >
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b> Created By :</b> <?php echo $party->created_user_first_name ? $party->created_user_first_name :''; echo $party->created_user_last_name ? ' '.$party->created_user_last_name.', ' : ''; echo $party->party_created_datetime ? date("d-M-Y h:i A", strtotime($party->party_created_datetime)) : ''; ?>
                </div>
                <div class="col-md-6">
                    <b> Last Updated By :</b> <?php echo $party->last_updated_user_first_name ? $party->last_updated_user_first_name : ''; echo  $party->last_updated_user_last_name ? ' '.$party->last_updated_user_last_name.', ' : ''; echo $party->party_last_updated_datetime ? date("d-M-Y h:i A", strtotime($party->party_last_updated_datetime)) : ''; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    // tooltips
    tippy("#edit-party",{
        content: 'edit party'
    });
    tippy("#delete-party",{
        content: 'delete party'
    });
</script>