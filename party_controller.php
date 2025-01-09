<?php
include('header_php.php');
require_once('constant.php');
require_once('party_crud.php');
?>
 <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div>

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Party Control</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Party</li>
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Add/Edit Party</h5>

                                        <form class="" id="party" method="post">              
                                            <div class="row">
                                                <p style="color: Red;"><?php if(isset($error) && empty_check($error)){echo $error[0];}?></p>
                                                <div class="col-lg-3 col-md-3">
                                                    <label for="party_name">Party Name</label>
                                                    <input type="text" class="form-control" id="party_name" name = "party_name" value="<?php if(empty_check($p_name)){echo $p_name;}?>" placeholder="Party Name" required autocomplete="off" onkeypress="moveFocus()">
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <label   for="phone_number">Phone Number</label>
                                                    <input type="text" class="form-control" id="phone_number" name = "phone_number" value="<?php if(empty_check($p_phone)){echo $p_phone;}?>" placeholder="Phone Number" autocomplete="off" onkeypress="moveFocus()">
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <label   for="pay_commission">Pay Commission</label>
                                                    <input type="text" class="form-control" id="pay_commission" name = "pay_commission" value="<?php if(empty_check($p_commission)){echo $p_commission;}?>" placeholder="Pay Commission" required autocomplete="off" onkeypress="moveFocus()">
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <label   for="a0toa9">A0toA9</label>
                                                    <input type="text" class="form-control" id="a0toa9" name = "a0toa9" value="<?php if(empty_check($p_a0to9)){echo $p_a0to9;}?>" placeholder="A0toA9" required autocomplete="off" onkeypress="moveFocus()">
                                                </div>
                                            </div>
                                            <div class="row" style="padding-top: 5px;">
                                                <div class="col-lg-3 col-md-3">
                                                    <label   for="b0tob9">B0toB9</label>
                                                    <input type="text" class="form-control" id="b0tob9" name = "b0tob9" value="<?php if(empty_check($p_b0to9)){echo $p_b0to9;}?>" placeholder="B0toB9" required autocomplete="off" onkeypress="moveFocus()">
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <label   for="1to100">1to100</label>
                                                    <input type="text" class="form-control" id="1to100" name = "1to100" value="<?php if(empty_check($p_1to100)){echo $p_1to100;}?>" placeholder="1to100" required autocomplete="off" onkeypress="moveFocus()">
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <label  for="referred_pati">Pati</label>
                                                    <input type="text" class="form-control" id="pati" name = "pati" value="<?php if(empty_check($p_pati)){echo $p_pati;}?>" placeholder="Pati" autocomplete="off" onkeypress="moveFocus()">
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                <label for="referred_party">Referred Party</label>
                                                    <select class="form-control" id="referred_party" name="referred_party" onkeypress="moveFocus()">
                                                        <option value="">Select Party</option>
                                                        <?php
                                                        // Fetch all parties                                                        
                                                        if ($party_result) {
                                                            while ($party = mysqli_fetch_assoc($party_result)) {
                                                                // Check if $p_referred_party is set before comparison
                                                                $selected = (isset($p_referred_party) && $party['p_id'] == $p_referred_party) ? 'selected' : '';
                                                                echo '<option value="' . htmlspecialchars($party['p_id'], ENT_QUOTES, 'UTF-8') . '" ' . $selected . '>' . htmlspecialchars($party['p_name'], ENT_QUOTES, 'UTF-8') . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="">No Parties Found</option>';
                                                        }                                                        
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" style="padding-top: 5px; padding-bottom: 8px;">
                                            <div class="col-lg-3 col-md-3">
                                                    <label  for="referred_pati">Referred Pati</label>
                                                    <input type="text" class="form-control" id="referred_pati" name = "referred_pati" value="<?php if(empty_check($p_refer_pati)){echo $p_refer_pati;}?>" placeholder="Referred Pati" autocomplete="off" onkeypress="moveFocus()">
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <label for="limit">Limit</label>
                                                    <input type="text" class="form-control" id="limit"  name = "limit" value="<?php if(empty_check($p_limit)){echo $p_limit;}?>" placeholder="Limit" autocomplete="off" onkeypress="moveFocus()">
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="status" data-rule-mandatory="true" onkeypress="moveFocus()">
                                                        <option value="active" <?php if(empty_check($p_status) && $p_status == 'active'){echo 'selected';} ?>>Active</option>
                                                        <option value="inactive" <?php if(empty_check($p_status) && $p_status == 'inactive'){echo 'selected';} ?>>Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <label for="status">Sheet Required</label>
                                                    <select class="form-control" id="final_sheet" name="final_sheet" data-rule-mandatory="true" onkeypress="moveFocus()">
                                                        <option value="no" <?php if(empty_check($sheet) && $sheet == 'no'){echo 'selected';} ?>>No</option>
                                                        <option value="yes" <?php if(empty_check($sheet) && $sheet == 'yes'){echo 'selected';} ?>>Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 text-right">
                                                    <button type="submit"  id="submitButton"  name="submitBtn" class="btn btn-primary mb-2" onclick="addnewparty()">Submit</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
						
						
						<div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
										<div class="TableHeader">
											<div class="row">
												<div class="col-lg-3">
													<h4 class="card-title">Party List</h4>
												</div>											
											</div>
										</div>	
                                        <div class="table-responsive">
                                            <table class="table mb-0 listingData dt-responsive" id="datatable">
                                                <thead >
                                                    <tr> 
                                                        <th style="background: #f1b44c;">S. No.</th>
                                                        <th style="background: #f1b44c;">Party Name</th>
                                                        <th style="background: #f1b44c;">Phone Number</th>
                                                        <th style="background: #f1b44c;">Pay Commission</th>
                                                        <th style="background: #f1b44c;">A0toA9</th>
                                                        <th style="background: #f1b44c;">B0toB9</th>
                                                        <th style="background: #f1b44c;">1to100</th>
                                                        <th style="background: #f1b44c;">Pati</th>
                                                        <th style="background: #f1b44c;">Referred Party</th>
                                                        <th style="background: #f1b44c;">Referred Pati</th>
                                                        <th style="background: #f1b44c;">Final Sheet</th>
                                                        <th style="background: #f1b44c;">Limit</th>
                                                        <th style="background: #f1b44c;">Status</th>
                                                        <th style="background: #f1b44c;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if($p_result){
                                                         $i = 1;
                                                         while($party = mysqli_fetch_assoc($p_result)) {
                                                        ?>
                                                    <tr>
                                                        <th scope="row"><?php if(empty_check($i)){echo $i;} ?></th>
                                                        <td><?php if(empty_check($party['p_name'])){echo $party['p_name'];} ?></td>
                                                        <td><?php if(empty_check($party['p_number'])){echo $party['p_number'];}else{ echo 'XXXXXXXXXX';} ?></td>
														<td><?php if(empty_check($party['p_pay_commission'])){echo $party['p_pay_commission'];}else{ echo '0';} ?></td>
														<td><?php if(empty_check($party['p_a0_to_a9'])){echo $party['p_a0_to_a9'];} ?></td>
														<td><?php if(empty_check($party['p_b0_to_b9'])){echo $party['p_b0_to_b9'];} ?></td>
														<td><?php if(empty_check($party['p_1_to_100'])){echo $party['p_1_to_100'];} ?></td>
														<td><?php if(empty_check($party['p_pati'])){echo $party['p_pati'];}else{ echo '0';} ?></td>
														<td><?php if(empty_check($party['p_referred_party'])){echo $party['p_referred_party'];}else{ echo 'N/A';} ?></td>
														<td><?php if(empty_check($party['p_referred_pati'])){echo $party['p_referred_pati'];}else{ echo '0';} ?></td>
                                                        <td><?php if($party['sheet'] == 'no'){echo 'No';}else{ echo 'Yes';} ?></td>
														<td><?php if(empty_check($party['p_limit'])){echo $party['p_limit'];}else{ echo '0';} ?></td>
                                                        <td><?php if(empty_check($party['p_status']) && $party['p_status'] == 'active'){echo '<span class="badge badge-pill badge-success">Active</span>';} else { echo '<span class="badge badge-pill badge-danger">Inactive</span>';}?></td>
                                                        <td>
                                                            <a href="party_controller.php?action=edit&p_id=<?php echo urlencode($party['p_id']); ?>" class="text-primary mr-2"><img style="height: 25px;" src="assets/images/edit.gif"></a>
															<a href="javascript:void(0);" class="text-danger" onclick="confirmPartyDeletion('<?php echo urlencode($party['p_id']); ?>');"><img style="height: 25px;" src="assets/images/delete.gif"></a>
														</td>
                                                    </tr>
                                                    <?php $i++;}}else{ echo 'There is no party to show.'; }?>
                                                </tbody>
                                            </table>
                                            <?php if(isset($_GET['action']) && $_GET['action'] == 'edit'){ ?>
                                            <input type="hidden" name="type" id="type" value= "<?php echo 'update';?>">
                                            <input type="hidden" name="p_id" id="p_id" value= "<?php echo urlencode($_GET['p_id']); ?>">
                                            <?php } ?>  
                                        </div>
        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
<script>
    function moveFocus() {
        // prevent the form from submitting
        if (event.keyCode == 13) {
            event.preventDefault();
            // get the id of the current element
            var currentElement = document.activeElement.id;
            if (currentElement == 'party_name') {
                document.getElementById('phone_number').focus();
            } else if (currentElement == 'phone_number') {
                document.getElementById('pay_commission').focus();
            } else if (currentElement == 'pay_commission') {
                document.getElementById('a0toa9').focus();
            } else if (currentElement == 'a0toa9') {
                document.getElementById('b0tob9').focus();
            } else if (currentElement == 'b0tob9') {
                document.getElementById('1to100').focus();
            } else if (currentElement == '1to100') {
                document.getElementById('pati').focus();
            } else if (currentElement == 'pati') {
                document.getElementById('referred_party').focus();
            } else if (currentElement == 'referred_party') {
                document.getElementById('referred_pati').focus();
            } else if (currentElement == 'referred_pati') {
                document.getElementById('limit').focus();
            } else if (currentElement == 'limit') {
                document.getElementById('status').focus();
            } else if (currentElement == 'status') {
                document.getElementById('final_sheet').focus();
            } else if (currentElement == 'final_sheet') {
                document.getElementById('submitButton').focus();
            }
        }
    }

    function confirmPartyDeletion(partyId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this party?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX call to delete the party
                $.ajax({
                    url: 'party_crud.php?action=delete&p_id=' + partyId,
                    type: 'GET',
                    success: function(response) {
                        // Assuming the response is a success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The party has been deleted successfully.',
                        }).then(() => {
                            // Optionally, refresh the page or remove the party row from the DOM
                            //reload to URL without query string
                            window.location.href= window.location.href.split('?')[0];
                        });
                    },
                    error: function() {
                        // Handle errors here
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'There was an error deleting the party. Please try again.',
                        });
                    }
                });
            }
        });
    }

    function addnewparty() {
        event.preventDefault();
        // collect all the form data 
        var p_name = $('#party_name').val();
        var p_phone = $('#phone_number').val();
        var p_commission = $('#pay_commission').val();
        var p_a0to9 = $('#a0toa9').val();
        var p_b0to9 = $('#b0tob9').val();
        var p_1to100 = $('#1to100').val();
        var p_pati = $('#pati').val();
        var p_referred_party = $('#referred_party').val();
        var p_referred_pati = $('#referred_pati').val();
        var p_limit = $('#limit').val();
        var p_status = $('#status').val();
        var sheet = $('#final_sheet').val();
        var p_id = '';

        // check the declare value is not greater than 100 and less than 0
        if (p_name == "" || p_commission == "" || p_a0to9 == "" || p_b0to9 == "" || p_1to100 == "" || p_status == "") {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Please provide data to create party.',
            });
            return;
        }

        // check the type field value
        var action = $('#type').val();
        if (action == 'update') {
            action = 'update';
            p_id = $('#p_id').val();
        } else {
            // If the type is not edit, then add the game
            action = 'add';
        }

        // AJAX call to add the game
        $.ajax({
            url: 'party_crud.php',
            type: 'GET',
            data: {
                action: action,
                p_name: p_name,
                p_phone: p_phone,
                p_commission: p_commission,
                p_a0to9: p_a0to9,
                p_b0to9: p_b0to9,
                p_1to100: p_1to100,
                p_pati: p_pati,
                p_referred_party: p_referred_party,
                p_referred_pati: p_referred_pati,
                p_limit: p_limit,
                p_status: p_status,
                sheet: sheet,
                p_id: p_id
            },
            success: function(data) {
                var response = JSON.parse(data);
                // check the response and if error found show the error message
                if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.error,
                    });
                    return;
                }else if(response.success){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.success,
                    }).then(() => {
                        // check the action and reset the values
                        if (action == 'update') {
                            $('#type').val('');
                            $('#p_id').val('');
                        }
                        // Optionally, refresh the page or add the game row to the DOM
                        //reload to URL without query string
                        window.location.href= window.location.href.split('?')[0];
                    });
                }
            },
            error: function() {
                // Handle errors here
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error adding the game. Please try again.',
                });
            }
        });
    }

    function fetchReferParty(){
        $.ajax({
            url:'party_crud.php' ,
            type: 'GET',
            success: function(response) {
                $('#referred_pati').val(response);
            },
            error: function() {
                // Handle errors here
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error fetching the referred pati. Please try again.',
                });
            }
        });
    }
</script>
<?php require('footer.php') ?>