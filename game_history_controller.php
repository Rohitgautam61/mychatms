<?php
include('header_php.php');
require_once('constant.php');
require_once('game_history_crud.php');

$game_total = get_game_total('43', '2024-11-13', $con);
print_r($game_total);

echo '<br>';
$parsing = get_total_parsing('08','43', '2024-11-13', $con);
print_r($parsing);
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div>
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Game History</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">History</li>
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
                    <h5 class="card-title mb-4">Filter</h5>
                        <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <input type="date" onchange="fetch_data(this.value)" class="form-control" id="date" placeholder="Date" name = 'g_date_added' value = '<?php if(empty_check($g_date)){ echo $g_date;}?>'>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
        <div class="container-fluid">
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
                                    <thead>
                                        <tr>
                                            <th style="background: #f1b44c;">S. No.</th>
                                            <th style="background: #f1b44c;">Date</th>
                                            <th style="background: #f1b44c;">Game Name</th>
                                            <th style="background: #f1b44c;">Draw</th>
                                            <th style="background: #f1b44c;">Status</th>
                                            <th style="background: #f1b44c;">Declare Number</th>
                                            <th style="background: #f1b44c;">Game Total / Passing</th>
                                            <th style="background: #f1b44c;">Declare Date/time</th>
                                            <th style="background: #f1b44c;">Result</th>
                                            <?php if(isset($_SESSION['user_type']) && strtolower($_SESSION['user_type']) == 'admin' ){ ?>
                                            <th style="background: #f1b44c;">Created By</th>
                                            <?php } ?>
                                            <th style="background: #f1b44c;">Open Game</th>
                                            <th style="background: #f1b44c;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($game_history_result) {
                                            $i = 1;
                                            while ($game_history_array = mysqli_fetch_assoc($game_history_result)) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php if (empty_check($i)) {
                                                                        echo $i;
                                                                    } ?></th>
                                                    <td><?php if (empty_check($game_history_array['g_date_added'])) {
                                                            echo $game_history_array['g_date_added'];
                                                        } ?></td>
                                                    <td><?php if (empty_check($game_history_array['g_name'])) {
                                                            echo $game_history_array['g_name'];
                                                        } ?></td>
                                                    <td><?php if (empty_check($game_history_array['g_draw'])) {
                                                            echo $game_history_array['g_draw'];
                                                        } ?></td>
                                                    <td><?php if (empty_check($game_history_array['g_status'])) {
                                                            echo strtoupper($game_history_array['g_status']);
                                                        } ?></td>
                                                    <td><?php if (isset($game_history_array['g_declare_number']) && $game_history_array['g_declare_number'] != 0) {
                                                            echo $game_history_array['g_declare_number'];
                                                        }else if($game_history_array['g_declare_number'] == 0){
                                                            echo '00';
                                                        } ?></td>
                                                    <td><?php $game_total = get_game_total($game_history_array['g_id'], $game_history_array['g_date_added'], $con);
                                                        if (isset($game_history_array['g_declare_number']) && $game_history_array['g_declare_number'] != 0) {
                                                            $d_number =  $game_history_array['g_declare_number'];
                                                        }else if($game_history_array['g_declare_number'] == 0 || $game_history_array['g_declare_number'] == '00'){
                                                            $d_number = '100';
                                                        }
                                                        $parsing = get_total_parsing($d_number, $game_history_array['g_id'],$game_history_array['g_date_added'], $con);
                                                        echo $game_total['total'] . ' / ' . $parsing['total'];
                                                    ?></td>
                                                    <td><?php if (empty_check($game_history_array['modified_at'])) {
                                                            echo $game_history_array['modified_at'];
                                                        } ?></td>
                                                    <td>
                                                        <a href="#" onclick="showResult('<?php echo $game_history_array['g_id']; ?>', '<?php echo $game_history_array['g_date_added']; ?>')">
                                                            <img style="height: 25px;" src="assets/images/icon_print.gif">
                                                        </a>
                                                    </td>
                                                    <?php if(isset($_SESSION['user_type']) && strtolower($_SESSION['user_type']) == 'admin'){ ?>
                                                    <td><?php if(empty_check($game_history_array['user_name'])){echo $game_history_array['user_name'];} ?></td>
                                                    <?php } ?>
                                                    <td><a href="#" onclick="open_old_game(<?php echo $game_history_array['g_draw'] . ',' . $game_history_array['g_id'] . ',\'' . $game_history_array['g_name'] . '\''; ?>)"><img style="height: 25px;" src="assets/images/newspaper.gif"></a></td>
                                                    <td> 
                                                        <a href="#" onclick="copy_party_details('<?php echo $game_history_array['g_id']; ?>', '<?php echo $game_history_array['g_date_added']; ?>', <?php echo $game_history_array['g_declare_number']; ?>)">
                                                            <img style="height: 25px;" src="assets/images/result.gif">
                                                        </a> / 
                                                        <a href="#" onclick="copy_game_result(<?php echo $game_history_array['g_id']; ?>, '<?php echo $game_history_array['g_date_added']; ?>')">
                                                            <img style="height: 25px;" src="assets/images/cost.gif">
                                                        </a> /
                                                        <a href="javascript:void(0);" class="text-danger" onclick="undeclare_game(<?php echo $game_history_array['g_id']; ?>)">
                                                            <img style="height: 25px;" src="assets/images/building.gif">
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
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
    <script>
        function showResult(g_id,date) {
            var g_id = g_id;
            var date = date;

            // ajax call to get the result of the game
            $.ajax({
                url: 'game_history_crud.php',
                type: 'GET',
                data: {
                    'action': 'get_result',
                    'g_id': g_id,
                    'date': date,
                },
                success: function(response) {
                    // check the response is an array then show error else show the result using swal by putting the response html
                    if (Array.isArray(response)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response['error'],
                        });
                    } else {
                        Swal.fire({
                            title: 'Result',
                            html: response,
                            width: 1200,
                            confirmButtonText: 'Close',
                        });
                    }
                }
            });
        }

        // open the old game
        function open_old_game(draw, g_id, g_name) {
            debugger;
            var draw = draw;
            var g_id = g_id;
            var g_name = g_name;

            // load the url with the draw, u_id and date
            window.location.href = 'coupon_controller.php?draw=' + draw + '&g_id=' + g_id + '&g_name=' + g_name;
        }

        // undeclare the game
        function undeclare_game(g_id) {
            var g_id = g_id;
            Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to undeclare this game?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, undeclare it!'
            }).then((result) => {
            if (result.isConfirmed) {
            // ajax call to undeclare the game
            $.ajax({
                url: 'game_history_crud.php',
                type: 'GET',
                data: {
                    'action': 'undeclare_game',
                    'g_id': g_id,
                },
                success: function(response) {
                    // check the response is an array then show error else show the success message
                    if (Array.isArray(response)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response['error'],
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'The game has be undeclared successfully and restore to Game Tab.',
                        }).then((result) => {
                            // reload the page
                            location.reload();
                        });
                    }
                }
            });
            }
        });
        }
        

        // copy the game result
        function copy_game_result(g_id, date) {
            var g_id = g_id;
            var date = date;

            // ajax call to copy the game result
            $.ajax({
                url: 'game_history_crud.php',
                type: 'GET',
                data: {
                    'action': 'copy_game_result',
                    'g_id': g_id,
                    'date': date
                },
                success: function(response) {
                    // check the response is an array then show error else show the success message
                    if (Array.isArray(response)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response['error'],
                        });
                    } else {
                         // Use the Clipboard API to copy the data
                         navigator.clipboard.writeText(response)
                        .then(() => {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'The game result has been copied successfully.',
                            });
                        })
                        .catch(err => {
                                Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'system is not able to copy the data.',
                            });
                        });
                    }
                }
            });
        }

        // copy the party details
        function copy_party_details(g_id, date, declare_number) {
            var g_id = g_id;
            var date = date;
            var declare_number = declare_number;

            // ajax call to copy the party details
            $.ajax({
                url: 'game_history_crud.php',
                type: 'GET',
                data: {
                    'action': 'copy_party_details',
                    'g_id': g_id,
                    'date': date,
                    'd_number': declare_number
                },
                success: function(response) {
                    // check the response is an array then show error else show the success message
                    if (Array.isArray(response)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response['error'],
                        });
                    } else {
                        // Use the Clipboard API to copy the data
                        navigator.clipboard.writeText(response)
                        .then(() => {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'The game and passing total details has been copied successfully.',
                            });
                        })
                        .catch(err => {
                                Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'system is not able to copy the data.',
                            });
                        });
                    }
                }
            });
        }

        function fetch_data(date){
            // reload the page with the date
            window.location.href = 'game_history_controller.php?date=' + date;
        }
    </script>
    <!-- End Page-content -->
    <?php require('footer.php') ?>