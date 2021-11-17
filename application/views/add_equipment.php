<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
    </div>
</div>