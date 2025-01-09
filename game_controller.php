<?php
include('header_php.php');
require_once('constant.php');
require_once('game_crud.php');
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
                        <h4 class="mb-0 font-size-18">Game Control</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Game</li>
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
                            <h5 class="card-title mb-4">Add/Edit Game</h5>
                            <form class="" id="game" method="post">              
                            <font color="#f00000" size="2px"><?php if (isset($error[5])) {
                                                                        echo $error[5];
                                                                    } ?></font>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2">
                                        <label   for="date">Date</label>
                                        <input type="date" onkeypress="moveFocus()" class="form-control" id="date" placeholder="Date" name = 'g_date_added' value = '<?php if(empty_check($g_date_added)){ echo $g_date_added;}?>'>
                                        <font color="#f00000" size="2px"><?php if (isset($error[1])) {
                                                                        echo $error[1];
                                                                    } ?></font>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label   for="game_name">Game Name</label>
                                        <input type="text" onkeypress="moveFocus()" class="form-control" name = 'g_name' id="g_name" placeholder="Game Name" value = '<?php if(empty_check($g_name)){ echo $g_name;}?>'  autocomplete="off">
                                        <font color="#f00000" size="2px"><?php if (isset($error[2])) {
                                                                        echo $error[2];
                                                                    } ?></font>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <label   for="draw">Draw</label>
                                        <input type="text" onkeypress="moveFocus()" class="form-control" name = 'g_draw' id="g_draw" placeholder="Draw" value = '<?php if(empty_check($g_draw)){ echo $g_draw;}?>'  autocomplete="off">
                                        <font color="#f00000" size="2px"><?php if (isset($error[3])) {
                                                                        echo $error[3];
                                                                    } ?></font>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label   for="status">Status</label>
                                        <select class="form-control" id="status" name="g_status"  onkeypress="moveFocus()">
                                        <option value="undeclare" <?php if(empty_check($g_status) && $g_status == 'undeclare'){echo 'selected';} ?>>Un-Declare</option>
                                        <option value="declare" <?php if(empty_check($g_status) && $g_status == 'declare'){echo 'selected';} ?>>Declare</option>
                                        </select>
                                        <font color="#f00000" size="2px"><?php if (isset($error[4])) {
                                                                        echo $error[4];
                                                                    } ?></font>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <label   for="g_declare_number">Declare Number</label>
                                        <input type="text" onkeypress="moveFocus()" class="form-control" id="g_declare_number" name = 'g_declare_number' placeholder="Declare Number" value = '<?php if(empty_check($g_declare_number)){ echo $g_declare_number;}?>' autocomplete="off"> 
                                    </div>
                                </div>
                                <input type="hidden" name="type" id="type" value="">
                                <input type="hidden" name="g_id" id="g_id" value="">
                                <div class="row" style="padding-top: 5px;">
                                    <div class="col-lg-12 col-md-12 text-right">
                                        <button type="submit"  id="submitButton"  name="submitBtn" class="btn btn-primary mb-2" onclick="addnewGame()">Submit</button>
                                    </div>
                                </div>
                                
                            </form>
                            
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
										<h4 class="card-title">Game List</h4>
									</div>											
								</div>
							</div>	
                            <div class="table-responsive">
                                <table class="table mb-0 listingData dt-responsive" id="datatable">
                                    <thead >
                                        <tr> 
                                            <th style="background: #f1b44c;">S. No.</th>
                                            <th style="background: #f1b44c;">Date</th>
                                            <th style="background: #f1b44c;">Game Name</th>
                                            <th style="background: #f1b44c;">Draw</th>
                                            <th style="background: #f1b44c;">Status</th>
                                            <th style="background: #f1b44c;">Declare Number</th>
                                            <th style="background: #f1b44c;">Declare Date/time</th>
                                            <?php if(isset($_SESSION['user_type']) && strtolower($_SESSION['user_type']) == 'admin'){ ?>
                                            <th style="background: #f1b44c;">Created By</th>
                                            <?php } ?>
                                            <th style="background: #f1b44c;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        if($g_result){
                                         $i = 1;
                                         while($game = mysqli_fetch_assoc($g_result)) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php if(empty_check($i)){echo $i;} ?></th>
											<td><?php if(empty_check($game['g_date_added'])){echo $game['g_date_added'];} ?></td>
                                            <td><?php if(empty_check($game['g_name'])){echo $game['g_name'];} ?></td>
                                            <td><?php if(empty_check($game['g_draw'])){echo $game['g_draw'];} ?></td>
                                            <td><?php if(empty_check($game['g_status'])){echo strtoupper($game['g_status']);} ?></td>
                                            <td><?php if(empty_check($game['g_declare_number'])){echo $game['g_declare_number'];}else{echo "To Be Declare";} ?></td>
                                            <td><?php if(empty_check($game['modified_at'])){echo $game['modified_at'];} ?></td>
                                            <?php if(isset($_SESSION['user_type']) && strtolower($_SESSION['user_type']) == 'admin'){ ?>
                                            <td><?php if(empty_check($game['user_name'])){echo $game['user_name'];} ?></td>
                                            <?php } ?>
                                            <td>
												<a href="javascript:void(0);" class="text-danger" onclick="fetchGameDetails('<?php echo urlencode($game['g_id']); ?>');"><img style="height: 25px;" src="assets/images/edit.gif"></a>
												<a href="javascript:void(0);" class="text-danger" onclick="confirmGameDeletion('<?php echo urlencode($game['g_id']); ?>');"><img style="height: 25px;" src="assets/images/delete.gif"></a>
											</td>
                                        </tr>
                                        <?php 
                                        $i++; 
                                        }} 
                                        ?>
                                    </tbody>
                                </table>
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
            if (currentElement == 'date') {
                document.getElementById('g_name').focus();
            } else if (currentElement == 'g_name') {
                document.getElementById('g_draw').focus();
            } else if (currentElement == 'g_draw') {
                document.getElementById('status').focus();
            } else if (currentElement == 'status') {
                document.getElementById('g_declare_number').focus();
            } else if (currentElement == 'g_declare_number') {
                document.getElementById('submitButton').focus();
            }
        }
    }

    function confirmGameDeletion(gameId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this game?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX call to delete the game
                $.ajax({
                    url: 'game_crud.php?action=delete&g_id=' + gameId,
                    type: 'GET',
                    success: function(response) {
                        // Assuming the response is a success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The game has been deleted successfully.',
                        }).then(() => {
                            // Optionally, refresh the page or remove the game row from the DOM
                            location.reload(); // Refresh the page
                        });
                    },
                    error: function() {
                        // Handle errors here
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'There was an error deleting the game. Please try again.',
                        });
                    }
                });
            }
        });
    }
    
    function addnewGame() {
        event.preventDefault();
        // collect all the form data 
        var date = $('#date').val();
        var g_name = $('#g_name').val();
        var g_draw = $('#g_draw').val();
        var status = $('#status').val();
        var g_declare_number = $('#g_declare_number').val();
        var g_id = '';

        // check the declare value is not greater than 100 and less than 0
        if (g_declare_number != ""  && (g_declare_number > 100 || g_declare_number < 0)) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Declare number should be between 0 and 100.',
            });
            return;
        }

        if(g_declare_number != "" && status == 'undeclare'){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Declare number should be empty when status is Undeclare Game.',
            });
            return;
        }

        // check the type field value
        var action = $('#type').val();
        if (action == 'edit') {
            action = 'update';
            g_id = $('#g_id').val();
        } else {
            // If the type is not edit, then add the game
            action = 'add';
        }

        // AJAX call to add the game
        $.ajax({
            url: 'game_crud.php',
            type: 'GET',
            data: {
                action: action,
                date: date,
                g_name: g_name,
                g_draw: g_draw,
                status: status,
                g_declare_number: g_declare_number,
                g_id: g_id
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
                            $('#g_id').val('');
                        }
                        // Optionally, refresh the page or add the game row to the DOM
                        location.reload(); // Refresh the page
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

    function fetchGameDetails(game_id){
        // AJAX call to fetch the game details
        $.ajax({
            url: 'game_crud.php?action=edit&g_id=' + game_id,
            type: 'GET',
            success: function(response) {
                var game = JSON.parse(response);
                // check the response and if error found show the error message
                if (game.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: game.error,
                    });
                }else{
                    // Populate the form fields with the game details
                    $('#date').val(game.g_date_added);
                    $('#g_name').val(game.g_name);
                    $('#g_draw').val(game.g_draw);
                    $('#status').val(game.g_status);
                    $('#g_declare_number').val(game.g_declare_number);
                    $('#type').val('edit');
                    $('#g_id').val(game_id);
                    // shift the scroll to the top of the page
                    window.scrollTo(0, 0);
                }
            },
            error: function() {
                // Handle errors here
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error fetching the game details. Please try again.',
                });
            }
        });
    }
</script>
<?php require('footer.php') ?>