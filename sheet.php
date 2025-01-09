<?php 
require_once('connection.php');
require_once('constant.php');

// Check if action is 'game_details'
if(isset($_GET['action']) && $_GET['action'] == 'final_sheet') {
    // Fetch Draw Number based on the selected Game ID
    $response = array();
    $party_sheet_array = array();
    $game_id = $_GET['game_id'];
    $date = $_GET['date'];
    $party_id = $_GET['party'];
    $sheet_type = $_GET['sheet_type'];
    $user_id = $_SESSION['user_id'];
    $round_by = $_GET['round_by'];

    if(isset($sheet_type) && $sheet_type == 1 && $party_id == ""){
        $response['sheet_type'] = 1;
        $response['sheet_title'] = 'Main Sheet';
        $condition = "`g_id` = '$game_id' AND  `date` = '$date'";
        $sheet = 'main';
    }else if(isset($sheet_type) && $sheet_type == 2 && $party_id == ""){
        $response['sheet_type'] = 0;
        $response['sheet_title'] = 'Final Sheet';
        $condition = "`g_id` = '$game_id' AND  `date` = '$date'";
        $sheet = 'final';
    }else if(isset($sheet_type) && $sheet_type == 3 && $party_id == ""){
        $response['sheet_type'] = 1;
        $get_game_name_query = "SELECT g_name, g_draw FROM `games` WHERE `g_id` =".$game_id;
        $get_game_name_result = mysqli_query($con,$get_game_name_query);
        if(mysqli_num_rows($get_game_name_result) > 0) {
        // Iterate over the result and prepare the tr like mentioned below:
            while($row = mysqli_fetch_assoc($get_game_name_result)) {
                $get_game_name = $row['g_name'];
                $get_game_draw = $row['g_draw'];
            }
        } else {
            $get_game_name = 'Game';
        }
        $game_id_array = array();
        $get_game_id_query = "SELECT g_id FROM `games` WHERE `g_draw` =".$get_game_draw." AND `g_date_added` = '".$date."'";
        $get_game_id_result = mysqli_query($con,$get_game_id_query);
        if(mysqli_num_rows($get_game_id_result) > 0) {
        // Iterate over the result and prepare the tr like mentioned below:
            while($row = mysqli_fetch_assoc($get_game_id_result)) {
                $game_id_array[] = $row['g_id'];
            }
        } else {
            $game_id_array[] = $game_id;
        }
        $condition = "`g_id` IN (" . implode(',', $game_id_array) . ") AND `date` = '$date'";
        $response['sheet_title'] = $get_game_name.' Master Sheet';
        $sheet = 'main';
    }else if(isset($sheet_type) && $sheet_type == 4 && $party_id == ""){
        $response['sheet_type'] = 0;
        $get_game_name_query = "SELECT g_name, g_draw FROM `games` WHERE `g_id` =".$game_id;
        $get_game_name_result = mysqli_query($con,$get_game_name_query);
        if(mysqli_num_rows($get_game_name_result) > 0) {
        // Iterate over the result and prepare the tr like mentioned below:
            while($row = mysqli_fetch_assoc($get_game_name_result)) {
                $get_game_name = $row['g_name'];
                $get_game_draw = $row['g_draw'];
            }
        } else {
            $get_game_name = 'Game';
        }
        $game_id_array = array();
        $get_game_id_query = "SELECT g_id FROM `games` WHERE `g_draw` =".$get_game_draw." AND `g_date_added` = '".$date."'";
        $get_game_id_result = mysqli_query($con,$get_game_id_query);
        if(mysqli_num_rows($get_game_id_result) > 0) {
        // Iterate over the result and prepare the tr like mentioned below:
            while($row = mysqli_fetch_assoc($get_game_id_result)) {
                $game_id_array[] = $row['g_id'];
            }
        } else {
            $game_id_array[] = $game_id;
        }
        $condition = "`g_id` IN (" . implode(',', $game_id_array) . ") AND `date` = '$date'";
        $response['sheet_title'] = $get_game_name.' Master Final Sheet';
        $sheet = 'final';
    }else if(isset($party_id) && $party_id != ""){
        $response['sheet_type'] = 1;
        $get_party_name_query = "SELECT crd.bet_pati, p.p_name FROM `coupon_row_data` crd INNER JOIN `parties` p ON p.p_id = crd.p_id WHERE g_id = '$game_id' AND crd.p_id = '$party_id' AND `date` = '".$date."'";
        $get_party_name_result = mysqli_query($con, $get_party_name_query);
        if(mysqli_num_rows($get_party_name_result) > 0) {
            // Iterate over the result and prepare the tr like mentioned below:
            while($row = mysqli_fetch_assoc($get_party_name_result)) {
                $get_party_name = $row['p_name'];
                $get_patii = $row['bet_pati'];
            }
        } else {
            $result['error'] = 'Party is undefined to create the party sheet. Please connect to Dev!';
            return json_encode($result);
        }
        $get_game_name_query = "SELECT g_name FROM `games` WHERE `g_id` =".$game_id;
        $get_game_name_result = mysqli_query($con,$get_game_name_query);
        if(mysqli_num_rows($get_game_name_result) > 0) {
        // Iterate over the result and prepare the tr like mentioned below:
            while($row = mysqli_fetch_assoc($get_game_name_result)) {
                $get_game_name = $row['g_name'];
            }
        } else {
            $get_game_name = 'Game';
        }
        $response['sheet_title'] = strtoupper($get_party_name)." ".strtoupper($get_game_name).' Sheet';
        $condition = "`g_id` = '$game_id' AND  `date` = '$date' AND `p_id` = '$party_id'";
        $sheet = 'main';
    }else{
        $result['error'] = 'Undefined Input for system. Please connect to Dev!';
        return json_encode($result);
    }
    if(isset($sheet) && $sheet == 'main'){
        if($party_id != ""){
            $i = 0;
            // Construct the query to sum all columns
            $query = "SELECT `crd_bet_string`,`crd_bet_number_string`,`crd_amount` FROM `coupon_row_data` WHERE ".$condition;

            // Execute the query
            $result = mysqli_query($con, $query);

            // check the selected rows count and if the count if > 0  
            if(mysqli_num_rows($result) > 0) {
            // Iterate over the result and prepare the tr like mentioned below:
                while($row = mysqli_fetch_assoc($result)) {
                    if(strtolower($row['crd_bet_string']) == 's1' || strtolower($row['crd_bet_string']) == 's2' ){
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
            $final_array = created_party_sheet_data($party_sheet_array);
            $response['sheet_data'] = copy_sheet($final_array);
            $final_array = rounding_the_values($final_array, $round_by);
            $response['sheet'] = party_sheet($final_array);
            $response['sum'] = sum_array_by_key_ranges($final_array);
        }else{
            // Construct the query to sum all columns
            $query = "SELECT ".NORMAL_SHEET_DATA." FROM `coupon_bet_data` crd WHERE ".$condition;

            // Execute the query
            $result = mysqli_query($con, $query);

            // check the selected rows count and if the count if > 0  
            if(mysqli_num_rows($result) > 0) {
            // Iterate over the result and prepare the tr like mentioned below:
                while($row = mysqli_fetch_assoc($result)) {
                    $row = rounding_the_values($row, $round_by);
                    $response['sheet_data'] = copy_sheet($row);
                    $response['sheet'] = sheet($row);
                    $response['sum'] = sum_array_by_key_ranges($row);
                }
            } else {
                $response['sheet'] = sheet('');
                $response['sum'] = array('01-10' => '0', '11-20' => '0', '21-30' => '0', '31-40' => '0', '41-50' => '0', '51-60' => '0', '61-70' => '0', '71-80' => '0', '81-90' => '0', '91-100' => '0', 'a0-a9' => '0', 'b0-b9' => '0', 'total_bet' => '0');
            }
        }
    }else if(isset($sheet) && $sheet == 'final'){
        // Construct the query to sum all columns
        $query = "SELECT ".FINAL_SHEET_DATA." FROM `coupon_bet_data` crd WHERE ".$condition;

        // Execute the query
        $result = mysqli_query($con, $query);

        // check the selected rows count and if the count if > 0  
        if(mysqli_num_rows($result) > 0) {
        // Iterate over the result and prepare the tr like mentioned below:
            while($row = mysqli_fetch_assoc($result)) {
                $row = rounding_the_values($row, $round_by);
                $response['sheet_data'] = copy_sheet($row);
                $response['sheet'] = final_sheet($row);
                $response['sum'] = sum_array_by_key_ranges($row);
            }
        } else {
            $response['sheet'] = final_sheet('');
            $response['sum'] = array('01-10' => '0', '11-20' => '0', '21-30' => '0', '31-40' => '0', '41-50' => '0', '51-60' => '0', '61-70' => '0', '71-80' => '0', '81-90' => '0', '91-100' => '0', 'a0-a9' => '0', 'b0-b9' => '0', 'total_bet' => '0');
        }
    }else{
        $response['error'] = 'Undefined Input for system. Please connect to Dev!';
        return json_encode($response);
    }
    
    // if($party_id != ""){
    //     $response['sum'] = sum_array_by_key_ranges($final_array);
    // }else{
    //     $query = "SELECT ".GET_COLUMN_SUM." FROM `coupon_bet_data` crd WHERE ".$condition;

    //     // Execute the query
    //     $result = mysqli_query($con, $query);
        
    //     // check the selected rows count and if the count if > 0  
    //     if(mysqli_num_rows($result) > 0) {
    //         // Iterate over the result and prepare the tr like mentioned below:
    //         while($row = mysqli_fetch_assoc($result)) {
    //            // Example response array, replace with your actual response array
    //            $response['sum'] = array('01-10' => trimDecimal($row['1-10']), '11-20' => trimDecimal($row['11-20']), '21-30' => trimDecimal($row['21-30']), '31-40' => trimDecimal($row['31-40']), '41-50' => trimDecimal($row['41-50']), '51-60' => trimDecimal($row['51-60']), '61-70' => trimDecimal($row['61-70']), '71-80' => trimDecimal($row['71-80']), '81-90' => trimDecimal($row['81-90']), '91-100' => trimDecimal($row['91-100']), 'a0-a9' => trimDecimal($row['a0-a9']), 'b0-b9' => trimDecimal($row['b0-b9']), 'total_bet' => trimDecimal($row['total_bet']));
    //         }
    //     } else {
    //          $response['sum'] = array('01-10' => '0', '11-20' => '0', '21-30' => '0', '31-40' => '0', '41-50' => '0', '51-60' => '0', '61-70' => '0', '71-80' => '0', '81-90' => '0', '91-100' => '0', 'a0-a9' => '0', 'b0-b9' => '0', 'total_bet' => '0');
    //     }
    // }
    
    // Return the response
    echo json_encode($response);
    exit; // Stop further execution
}

if(isset($_GET['action']) && $_GET['action'] == 'sheet') {
    $sheet = $_GET['inputValue'];
    $party_id = $_GET['party_id'];
    $user_id = $_SESSION['user_id'];
    $game_id = $_GET['game_id'];
    $date = $_GET['date'];
    $total_bet = 0;

    
    // Fetch total bet for the selected party
    $total_bet = get_party_bet_sum($party_id, $user_id, $date, $game_id, $con);
    $total_bet_array = json_decode($total_bet,true);
    $total_bet = $total_bet_array['total'];
    if(strtolower($sheet) == 's1'){
        $number_string = explode(',', SHEET1);
        $tally = '<div class="section-wise-pricing">
                            <div>
                                <div>
                                    <label for="">01-10</label> <input type="number" style ="font-weight: 700;" name="" id="01-10" readonly>
                                </div>
                                <div>
                                    <label for="">11-20</label> <input type="number" style ="font-weight: 700;" name="" id="11-20" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">21-30</label> <input type="number" style ="font-weight: 700;" name="" id="21-30" readonly>
                                </div>
                                <div>
                                    <label for="">31-40</label> <input type="number" style ="font-weight: 700;" name="" id="31-40" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">41-50</label> <input type="number" style ="font-weight: 700;" name="" id="41-50" readonly>
                                </div>
                                <div>
                                    <label for="">51-60</label> <input type="number" style ="font-weight: 700;" name="" id="51-60" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">61-70</label> <input type="number" style ="font-weight: 700;" name="" id="61-70" readonly>
                                </div>
                                <div>
                                    <label for="">71-80</label> <input type="number" style ="font-weight: 700;" name="" id="71-80" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">81-90</label> <input type="number" style ="font-weight: 700;" name="" id="81-90" readonly>
                                </div>
                                <div>
                                    <label for="">91-100</label> <input type="number" style ="font-weight: 700;" name="" id="91-100" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">A0-A9</label> <input type="number" style ="font-weight: 700;" name="" id="a0-a9" readonly>
                                </div>
                                <div>
                                    <label for="">B0-B9</label> <input type="number" style ="font-weight: 700;" name="" id="b0-b9" readonly>
                                </div>
                            </div>
                        </div>';
    }else if(strtolower($sheet) == 's2'){
        $number_string = explode(',', SHEET2);
        $tally = '<div class="section-wise-pricing">
                            <div>
                                <div>
                                    <label for="">01-91</label> <input type="number" style ="font-weight: 700;" name="" id="01-91" readonly>
                                </div>
                                <div>
                                    <label for="">02-92</label> <input type="number" style ="font-weight: 700;" name="" id="02-92" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">03-93</label> <input type="number" style ="font-weight: 700;" name="" id="03-93" readonly>
                                </div>
                                <div>
                                    <label for="">04-94</label> <input type="number" style ="font-weight: 700;" name="" id="04-94" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">05-95</label> <input type="number" style ="font-weight: 700;" name="" id="05-95" readonly>
                                </div>
                                <div>
                                    <label for="">06-96</label> <input type="number" style ="font-weight: 700;" name="" id="06-96" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">07-97</label> <input type="number" style ="font-weight: 700;" name="" id="07-97" readonly>
                                </div>
                                <div>
                                    <label for="">08-98</label> <input type="number" style ="font-weight: 700;" name="" id="08-98" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">09-99</label> <input type="number" style ="font-weight: 700;" name="" id="09-99" readonly>
                                </div>
                                <div>
                                    <label for="">10-100</label> <input type="number" style ="font-weight: 700;" name="" id="10-100" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">A0-A9</label> <input type="number" style ="font-weight: 700;" name="" id="a0-a9" readonly>
                                </div>
                                <div>
                                    <label for="">B0-B9</label> <input type="number" style ="font-weight: 700;" name="" id="b0-b9" readonly>
                                </div>
                            </div>
                        </div>';
    }

    $tbody_data = '';
    // create a chunk of 6 elements
    $chunks = array_chunk($number_string, 6);
    foreach($chunks as $key => $chunk){
        $tbody_data .= '<tr>';
        foreach($chunk as $number){
            $number == '01'? $focus = 'autofocus' : $focus = '';
            $tbody_data .= '<td>'.$number.'</td>';
            $tbody_data .= '<td style = "margin: 0px; padding: 0px;"><input type="number" style ="font-weight: 700; width: 57px;" name='.strtolower($number).' id='.strtolower($number).'  onkeypress="moveFocus(event)"'.$focus.'></td>';
        }
        $tbody_data .= '</tr>';
    }

    $data = '<form id = "jantri_sheet"><div class="second-table-wrapper">
                        <table class="second-table">
                            <thead style ="position: sticky; top: 0; background-color: #f1f1f1; z-index: 1;">
                                 <tr>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                </tr>
                            </thead>
                            <tbody>
                                '.
                                $tbody_data
                                .'
                            </tbody>
                        </table>
                    </div>
                    <hr></hr>
                    <div class="second-table-content-section">
                        <div class="pricing-details">
                            <div class="game_total">
                                Game Total : <input type="number" style ="font-weight: 700; width: 90px;" name="" id="total_bet" value='.$total_bet.' readonly>
                            </div>
                            <div class="1-100">
                                Total 1-100 : <input type="number" style ="font-weight: 700; width: 90px;" name="" id="01-100" readonly>
                            </div>
                            <div class="AB_total">
                                Total AB : <input type="number" style ="font-weight: 700; width: 90px;" name="" id="AB" readonly>
                            </div>
                            <div class="jantri_total">
                                Jantri Total : <input type="number" style ="font-weight: 700; width: 90px;" name="" id="jantri_total" readonly>
                            </div>
                        </div>
                        '.$tally.'
                    </div>
                    <input type="hidden" name="game_total" id="game_total" value="'.$total_bet.'">
                    <input type="hidden" name="sheet" id="sheet" value="'.$sheet.'">
                    </div>';
    echo $data;
    exit;
}
