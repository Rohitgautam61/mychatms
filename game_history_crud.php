<?php
ob_start(); // Start output buffering
require_once('connection.php');
require_once('constant.php');

#variable declaration
$g_date_added = "";
$g_name = "";
$g_draw = "";
$g_status = "";
$g_declare_number = "";
$u_id = "";

# date for draw
$g_date_added = $date;

// check get data value and if the value is set then assign the value to the variable $g_date = $g_date_added - 1 day else assign get data value to the variable $g_date
if(isset($_GET['date']) && $_GET['date'] != ''){
    $g_date = $_GET['date'];
}else{
    $g_date = date('Y-m-d', strtotime($g_date_added . ' -1 day'));
}

# fetch party from parties table
if(isset($_SESSION['user_type']) && strtolower($_SESSION['user_type']) == 'admin'){
    # Query for fetching the data for admin
    /*SELECT
        g.g_id,
        g.g_date_added,
        g.g_name,
        g.g_draw,
        g.g_status,
        g.g_declare_number,
        g.modified_at
    FROM
        users u1
    INNER JOIN users u2 ON
        u1.user_id = u2.user_created_by
    INNER JOIN games g ON
        u2.user_id = g.u_id
    WHERE
        u1.user_id = '1';
     */
    $g_query = "SELECT g.g_id, g.g_date_added, g.g_name, g.g_draw, g.g_status, g.g_declare_number, g.modified_at, u1.user_name, g.u_id FROM users u1 INNER JOIN games g ON u1.user_id = g.u_id WHERE u1.user_id IN (".$_SESSION['all_user_id'].") AND g.g_status = 'declare' AND g.g_date_added = '".$g_date."' ORDER BY g.g_date_added DESC";
}else{
    # Query for fetching the data for admin
    /*SELECT
        g.g_id,
        g.g_date_added,
        g.g_name,
        g.g_draw,
        g.g_status,
        g.g_declare_number,
        g.modified_at
    FROM
        games g
    WHERE
        g.u_id = '1';
    */
    $g_query = "SELECT g.g_id, g.g_date_added, g.g_name, g.g_draw, g.g_status, g.g_declare_number, g.modified_at, g.u_id FROM games g WHERE g.u_id = '".$_SESSION['user_id']."' AND g.g_status = 'declare' AND g.g_date_added = '".$g_date."' ORDER BY g.g_date_added DESC";
}

$game_history_result = mysqli_query($con, $g_query);

if($game_history_result){
    // data has fetched successfully.
}else{
    $game = 'No Game Found!';
}

if(isset($_GET['action']) && $_GET['action'] == 'get_result'){
    $g_id = $_GET['g_id'];
    $g_date_added = $_GET['date'];
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];

    // fetch declared number for the game
    $declare_number_query = "SELECT g_id, g_declare_number FROM games WHERE g_id = '".$g_id."' AND g_date_added = '".$g_date_added."' AND g_status = 'declare'";
    $declare_number_result = mysqli_query($con, $declare_number_query);
    if($declare_number_result){
        $declare_number_array = mysqli_fetch_assoc($declare_number_result);
        $declare_number = $declare_number_array['g_declare_number'];
        $game_id = $declare_number_array['g_id'];
    }else{
        $response['error'] = 'No Number Declared!';
        echo json_encode($response);
        exit();
    }
    
    // check the declare number is empty or not
    if(isset($declare_number)){
        if($declare_number == '0' || $declare_number == '100'){
            $declare_number = '100';
        }

        if($declare_number == '100'){
            $declare_number = '100';
            $andar_number = 'a0';
            $bahar_number = 'b0';
        }else{
            // split the declared number by first place
            $declare_number_array = str_split($declare_number);
            $first_place = $declare_number_array[0];
            $second_place = $declare_number_array[1];

            $declare_number = $first_place.$second_place;
            $andar_number = 'a'.$first_place;
            $bahar_number = 'b'.$second_place;
        }

        // fetch the party details for the declared number from the coupon_bet_data table
        $winning_party_id_query = "SELECT DISTINCT p_id FROM coupon_bet_data WHERE g_id = '".$game_id."' AND date = '".$g_date_added."' AND ($declare_number != '0'  OR $andar_number != '0' OR $bahar_number != '0')";
        $winning_party_id_result = mysqli_query($con, $winning_party_id_query);
        if(mysqli_num_rows($winning_party_id_result) > 0){
            while($winning_party_id_array = mysqli_fetch_assoc($winning_party_id_result)){
                $winning_party_id[] = $winning_party_id_array['p_id'];
            }
        }else{
            $response['Success'] = 'No Party Won the Game!';
            echo json_encode($response);
            exit();
        }
        // fetch the result bet data for the winning party and show the result.
        if(count($winning_party_id) > 0){
            foreach($winning_party_id as $party_id){
                $i = 0;
                $game_sheet = false;
                // Construct the query to sum all columns
                $query = "SELECT `crd_bet_string`,`crd_bet_number_string`,`crd_amount` FROM `coupon_row_data` WHERE `g_id` = '$game_id' AND  `date` = '$g_date_added' AND `p_id` = '$party_id'";
                // Execute the query
                $result = mysqli_query($con, $query);
    
                // check the selected rows count and if the count if > 0  
                if(mysqli_num_rows($result) > 0) {
                // Iterate over the result and prepare the tr like mentioned below:
                    while($row = mysqli_fetch_assoc($result)) {
                        if(strtolower($row['crd_bet_string']) == 's1' || strtolower($row['crd_bet_string']) == 's2' ){
                            $game_sheet = true;
                            $party_sheet_array[$i]['sheet'] = 'yes';
                            $sheet_party_array = explode(',', $row['crd_bet_number_string']);
                            foreach($sheet_party_array as $sheet_party){
                                $split = explode('-', $sheet_party);
                                $party_sheet_array[$i]['sheet_data'][$split[0]] = $split[1];
                            }
                        }else{
                            $party_sheet_array[$i]['sheet'] = 'no';
                            $party_sheet_array[$i]['bet_number'] = $row['crd_bet_number_string'];
                            $party_sheet_array[$i]['amount'] = $row['crd_amount'];
                        }
                        $i++;
                    }
                } else {
                    $response['sheet'] = sheet('');
                }
                $party_array = array();
                $final_array = created_party_sheet_data($party_sheet_array);
                // if($game_sheet){
                //     $party_data[$party_id]['number'] = $final_array[$declare_number];
                // }else{
                    // Left trim the zero from declare number
                    $tdeclare_number = ltrim($declare_number, '0');
                    $party_data[$party_id]['number'] = $final_array[$tdeclare_number];
                // }                
                $party_data[$party_id]['andar'] = $final_array[$andar_number];
                $party_data[$party_id]['bahar'] = $final_array[$bahar_number];
                $party_data[$party_id]['sum'] = sum_array_by_key_ranges($final_array);
                $party_data[$party_id]['d_number'] = $declare_number;
                $party_data[$party_id]['a_number'] = $andar_number;
                $party_data[$party_id]['b_number'] = $bahar_number;
                
                // fetch party details from party details from party table
                $party_query = "SELECT * FROM parties WHERE p_id = '".$party_id."'";
                $party_result = mysqli_query($con, $party_query);
                if($party_result){
                    $party_array = mysqli_fetch_assoc($party_result);
                    $party_data[$party_id]['party_name'] = $party_array['p_name'];
                    $party_data[$party_id]['1-100'] = $party_array['p_1_to_100'];
                    $party_data[$party_id]['a0-9'] = $party_array['p_a0_to_a9'];
                    $party_data[$party_id]['b0-9'] = $party_array['p_b0_to_b9'];
                }
                // winning amount calculation
                $winning_amount = 0;
                $winning_amount = $party_data[$party_id]['number'] * $party_data[$party_id]['1-100'] + $party_data[$party_id]['andar'] * $party_data[$party_id]['a0-9'] + $party_data[$party_id]['bahar'] * $party_data[$party_id]['b0-9'];
                $party_data[$party_id]['winning_amount'] = $winning_amount;
                $last_modified = fetch_last_bet($party_id, '', $game_id, $g_date_added, $con);
                $party_data[$party_id]['last_modified'] = $last_modified;
                $final_array = array();
                $party_sheet_array = array();
            }
        }

        // show the data in table form
        if(count($party_data) > 0){
            $j = 1;
            // show header
            echo '<table class="table table-bordered table-striped">';
            echo '<tr>';
            echo '<th scope="row">S.No</th>';
            echo '<th>Party Name</th>';
            echo '<th>Result Return</th>';
            echo '<th>Last Timestamp</th>';
            echo '<th>Total Amount</th>';
            echo '<th>Pay Amount</th>';
            echo '<th>Result</th>';
            echo '</tr>';

            foreach($party_data as $party_id => $party){
                if($party['winning_amount'] > 0){
                    if($party['d_number'] < 10){
                        $party['d_number'] = $party['d_number'];
                    }else if($party['d_number'] == 100){
                        $party['d_number'] = '00';
                    }
                    $parsing = $party['number'] + (($party['bahar']+$party['andar'])/10);
                    echo '<tr>';
                    echo '<td>' . $j++ . '</td>';
                    echo '<td>' . strtoupper($party['party_name']) . '</td>';
                    echo '<td>' . " P-".$party['1-100'] . " /  A-".$party['a0-9'] . " / B-".$party['a0-9'].'</td>';
                    echo '<td>' . $party['last_modified'] . '</td>';
                    echo '<td>' . $party['sum']['total_bet'] . '</td>';
                    echo '<td>' . $party['winning_amount'] . '</td>';
                    echo '<td>' ." J". $party['d_number'] ." - ".$party['number'] . " / ".strtoupper($party['a_number'])." - ".$party['andar'] . " / ".strtoupper($party['b_number'])." - ".$party['bahar']." => $parsing " .'</td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
        }
        exit();
    }else{
        $response['error'] = 'No Number Declared!';
        echo json_encode($response);
        exit();
    }
    exit();
} 

if(isset($_GET['action']) && $_GET['action'] == 'copy_game_result'){
    $g_id = $_GET['g_id'];
    $g_date_added = $_GET['date'];
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];

    // fetch declared number for the game
    $declare_number_query = "SELECT g_id,g_name, g_declare_number FROM games WHERE g_id = '".$g_id."' AND g_date_added = '".$g_date_added."' AND g_status = 'declare'";
    $declare_number_result = mysqli_query($con, $declare_number_query);
    if($declare_number_result){
        $declare_number_array = mysqli_fetch_assoc($declare_number_result);
        $declare_number = $declare_number_array['g_declare_number'];
        $game_id = $declare_number_array['g_id'];
        $g_name = $declare_number_array['g_name'];
    }else{
        $response['error'] = 'No Number Declared!';
        echo json_encode($response);
        exit();
    }
    
    // check the declare number is empty or not
    if(isset($declare_number)){
        if($declare_number == '0' || $declare_number == '100'){
            $declare_number = '100';
        }

        if($declare_number == '100'){
            $declare_number = '100';
            $andar_number = 'a0';
            $bahar_number = 'b0';
        }else{
            // split the declared number by first place
            $declare_number_array = str_split($declare_number);
            $first_place = $declare_number_array[0];
            $second_place = $declare_number_array[1];

            $declare_number = $first_place.$second_place;
            $andar_number = 'a'.$first_place;
            $bahar_number = 'b'.$second_place;
        }

        // fetch the party details for the declared number from the coupon_bet_data table
        $winning_party_id_query = "SELECT DISTINCT p_id FROM coupon_bet_data WHERE g_id = '".$game_id."' AND date = '".$g_date_added."' AND ($declare_number != '0'  OR $andar_number != '0' OR $bahar_number != '0')";
        $winning_party_id_result = mysqli_query($con, $winning_party_id_query);
        if(mysqli_num_rows($winning_party_id_result) > 0){
            while($winning_party_id_array = mysqli_fetch_assoc($winning_party_id_result)){
                $winning_party_id[] = $winning_party_id_array['p_id'];
            }
        }else{
            $response['Success'] = 'No Party Won the Game!';
            echo json_encode($response);
            exit();
        }
        // fetch the result bet data for the winning party and show the result.
        if(count($winning_party_id) > 0){
            foreach($winning_party_id as $party_id){
                $i = 0;
                $game_sheet = false;
                // Construct the query to sum all columns
                $query = "SELECT `crd_bet_string`,`crd_bet_number_string`,`crd_amount` FROM `coupon_row_data` WHERE `g_id` = '$game_id' AND  `date` = '$g_date_added' AND `p_id` = '$party_id'";
                // Execute the query
                $result = mysqli_query($con, $query);
    
                // check the selected rows count and if the count if > 0  
                if(mysqli_num_rows($result) > 0) {
                // Iterate over the result and prepare the tr like mentioned below:
                    while($row = mysqli_fetch_assoc($result)) {
                        if(strtolower($row['crd_bet_string']) == 's1' || strtolower($row['crd_bet_string']) == 's2' ){
                            $game_sheet = true;
                            $party_sheet_array[$i]['sheet'] = 'yes';
                            $sheet_party_array = explode(',', $row['crd_bet_number_string']);
                            foreach($sheet_party_array as $sheet_party){
                                $split = explode('-', $sheet_party);
                                $party_sheet_array[$i]['sheet_data'][$split[0]] = $split[1];
                            }
                        }else{
                            $party_sheet_array[$i]['sheet'] = 'no';
                            $party_sheet_array[$i]['bet_number'] = $row['crd_bet_number_string'];
                            $party_sheet_array[$i]['amount'] = $row['crd_amount'];
                        }
                        $i++;
                    }
                } else {
                    $response['sheet'] = sheet('');
                }
                $party_array = array();
                $final_array = created_party_sheet_data($party_sheet_array);
                // if($game_sheet){
                //     $party_data[$party_id]['number'] = $final_array[$declare_number];
                // }else{
                //     // Left trim the zero from declare number
                    $tdeclare_number = ltrim($declare_number, '0');
                    $party_data[$party_id]['number'] = $final_array[$tdeclare_number];
                // }                
                $party_data[$party_id]['andar'] = $final_array[$andar_number];
                $party_data[$party_id]['bahar'] = $final_array[$bahar_number];
                $party_data[$party_id]['sum'] = sum_array_by_key_ranges($final_array);
                $party_data[$party_id]['d_number'] = $declare_number;
                $party_data[$party_id]['a_number'] = $andar_number;
                $party_data[$party_id]['b_number'] = $bahar_number;
                
                // fetch party details from party details from party table
                $party_query = "SELECT * FROM parties WHERE p_id = '".$party_id."'";
                $party_result = mysqli_query($con, $party_query);
                if($party_result){
                    $party_array = mysqli_fetch_assoc($party_result);
                    $party_data[$party_id]['party_name'] = $party_array['p_name'];
                    $party_data[$party_id]['1-100'] = $party_array['p_1_to_100'];
                    $party_data[$party_id]['a0-9'] = $party_array['p_a0_to_a9'];
                    $party_data[$party_id]['b0-9'] = $party_array['p_b0_to_b9'];
                }
                // winning amount calculation
                $winning_amount = 0;
                $winning_amount = $party_data[$party_id]['number'] * $party_data[$party_id]['1-100'] + $party_data[$party_id]['andar'] * $party_data[$party_id]['a0-9'] + $party_data[$party_id]['bahar'] * $party_data[$party_id]['b0-9'];
                $party_data[$party_id]['winning_amount'] = $winning_amount;
                $last_modified = fetch_last_bet($party_id, '', $game_id, $g_date_added, $con);
                $party_data[$party_id]['last_modified'] = $last_modified;
                $final_array = array();
                $party_sheet_array = array();
            }
        }

        // show the data in table form
        if(count($party_data) > 0){
            foreach($party_data as $party_id => $party){
                echo $party['party_name'] . "\t" . $g_name."-".$party['last_modified'] . "\t" . $party['sum']['total_bet'] . "\t" . $party['winning_amount'] . "\n";
            }
        }
        exit();
    }else{
        $response['error'] = 'No able to copy the data!';
        echo json_encode($response);
        exit();
    }
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'undeclare_game'){
    $g_id = $_GET['g_id'];

    // update the game status to undeclare
    $update_query = "UPDATE games SET g_status = 'undeclare', g_declare_number = '0' WHERE g_id = '".$g_id."'";
    $update_result = mysqli_query($con, $update_query);
    if($update_result){
        $response['success'] = 'Game Undeclared Successfully!';
        echo json_encode($response);
        exit();
    }else{
        $response['error'] = 'Game Undeclare Failed!';
        echo json_encode($response);
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'copy_party_details') {
    // Fetch game draw data based on the selected Game ID
    $game_id = $_GET['g_id'];
    $date = $_GET['date']; // Assuming today's date, adjust if necessary
    $declare_number = $_GET['d_number'];
    
    $game_total = get_game_total($game_id, $date, $con);
    if (isset($declare_number) && $declare_number != '0' && $declare_number != '00') {
        $d_number = $declare_number;
    } else if ($declare_number == 0 || $declare_number == '00') {
        $d_number = '100';
    }
    $parsing = get_total_parsing($d_number,$game_id, $date, $con);
    
    echo $game_total['total'] . "\t" . $parsing['total'];
    exit; // Stop further execution
}