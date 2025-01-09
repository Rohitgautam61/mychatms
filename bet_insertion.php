<?php 
require_once('connection.php');
require_once('constant.php');

if(isset($_GET['action']) && $_GET['action'] == 'party_bet_details') {
    // Fetch Draw Number based on the selected Game ID
    $game_id = isset($_GET['game_id']) ? $_GET['game_id'] : null;
    $party_id = isset($_GET['party_id']) ? $_GET['party_id'] : null;
    
    // Initialize the response array
    $response = array();
    
    if (!$game_id || !$party_id) {
        $response['error'] = "Invalid or missing parameters.";
        echo json_encode($response);
        exit;
    }
    
    // Query to fetch Draw Number
    $query = "SELECT crd_id, p.p_name, crd_bet_string, crd_amount 
              FROM `coupon_row_data` crd 
              INNER JOIN `parties` p ON crd.p_id = p.p_id 
              WHERE p.`p_id` = '$party_id' AND `g_id` = '$game_id'";
    
    // Execute the query
    $result = mysqli_query($con, $query);
    
    // Check for query errors
    if (!$result) {
        $response['error'] = "Database query failed: " . mysqli_error($con);
        echo json_encode($response);
        exit;
    }
    
    // Prepare the HTML and JSON response
    if (mysqli_num_rows($result) > 0) {
        $response['data'] = array();
        $response['html'] = '';
        $i = 1;
    
        // Iterate over the result and prepare the JSON response and HTML rows
        while ($row = mysqli_fetch_assoc($result)) {
            // Prepare data
            $truncated_bet_string = formatBetString($row['crd_bet_string']);
            $edit_link = '<a href="#"><img style="height: 18px;" src="assets/images/edit.gif" onclick="edit_bet(' . $row['crd_id'] . ')"></a>';
            $delete_link = '<a href="#"><img style="height: 18px;" src="assets/images/delete.gif" onclick="delete_bet(' . $row['crd_id'] . ');"></a>';
        
            // Add to JSON data
            $response['data'][] = array(
                'index' => $i,
                'bet_string' => $row['crd_bet_string'],
                'truncated_bet_string' => $truncated_bet_string,
                'amount' => $row['crd_amount'],
                'edit_link' => $edit_link,
                'delete_link' => $delete_link
            );
        
            // Add to HTML string
            $response['html'] .= '<tr>';
            $response['html'] .= '<td>' . $i++ . '</td>';
            $response['html'] .= '<td title="' . $row['crd_bet_string'] . '"><span class="truncated-text">' . $truncated_bet_string . '</span></td>';
            $response['html'] .= '<td>' . $row['crd_amount'] . '</td>';
            $response['html'] .= '<td style="padding-left:2px;">' . $edit_link . ' || ' . $delete_link . '</td>';
            $response['html'] .= '</tr>';
        }
    } else {
        $response['message'] = "No entries found.";
        $response['html'] = '<tr><td colspan="4">No entries found.</td></tr>';
    }
    
    // Return the JSON-encoded response
    echo json_encode($response);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'row_input') {
    // Establish database connection
    // Assuming $con is your database connection

    // Fetching input values with proper validation and escaping
    $party_id = mysqli_real_escape_string($con, $_GET['party_id']);
    $user_id = $_SESSION['user_id']; // Ensure user_id is properly set in the session
    $game_id = mysqli_real_escape_string($con, $_GET['game_id']);
    $bet_string = mysqli_real_escape_string($con, $_GET['bet_string']);
    $amount = floatval($_GET['amount']); // Convert to float to ensure proper arithmetic
    $betStringResponse = $_GET['betStringResponse']; // This should be an array in JSON format
    $noOfPair = intval($_GET['noOfPair']);
    $pati = floatval($_GET['pati']);
    $date = mysqli_real_escape_string($con, $_GET['date']); // Get the date from GET request
    $crd_id = mysqli_real_escape_string($con, $_GET['crd_id']);
    $action_type = $_GET['action_type'];

    // Convert betStringResponse to array if it's a JSON string
    if (is_string($betStringResponse)) {
        $betStringResponse = json_decode($betStringResponse, true);
    }

    if (!is_array($betStringResponse)) {
        echo json_encode(['error' => 'Invalid betStringResponse format.']);
        exit;
    }

    $bet_number_string = implode(',', $betStringResponse);

    // Calculate amount without pati
    if (isset($pati) && $pati > 0) {
        $amount_without_pati = $amount - format_decimal(($amount * $pati) / 100);        
    } else {
        $amount_without_pati = $amount;
    }

    // Calculate grand totals
    $grand_total_without_pati = $amount_without_pati * $noOfPair;
    $grand_total_with_pati = $amount * $noOfPair;

    // Step 1: Insert data into `coupon_row_data` table
    if($action_type == 'edit'){
        $insert_row_query = "UPDATE coupon_row_data 
        SET crd_bet_string = '$bet_string', crd_bet_number_string = '$bet_number_string', crd_amount = '$amount', bet_total = '$grand_total_with_pati', bet_pati = '$pati', modified_at = '$datetime', edit_cbd_bit = '0' WHERE p_id = '$party_id' AND u_id = '$user_id' AND g_id = '$game_id' AND date = '$date' AND crd_id = '$crd_id'";
    }else{
        $insert_row_query = "INSERT INTO coupon_row_data 
        (p_id, date, g_id, crd_bet_string, crd_bet_number_string, crd_amount, u_id, created_at, modified_at, bet_total, bet_pati, insert_cbd_bit) 
        VALUES 
        ('$party_id', '$date', '$game_id', '$bet_string', '$bet_number_string', '$amount', '$user_id', '$datetime', '$datetime', '$grand_total_with_pati', '$pati', '0')";
    }
    $insert_row_result = mysqli_query($con, $insert_row_query);

    if ($insert_row_result) {
        // if($action_type == 'edit'){
        //     $column_names = array();
        //     $values = array();
        //     $result = counting($betStringResponse, $amount_without_pati);
            
        //     $insert_bet_query = "UPDATE coupon_bet_data SET ";
        //     foreach ($result as $key => $value) {
        //         $column_names[] = "`$key` = '".mysqli_real_escape_string($con, $value)."'";
        //     }
        //     $insert_bet_query .= implode(',', $column_names) . ", bet_total = '$grand_total_without_pati', modified_at = '$datetime' WHERE crd_id = '".$_GET['crd_id']."' AND u_id = '$user_id' AND g_id = '$game_id' AND p_id = '$party_id' AND date = '$date'";
        // } else {
        //     // Step 2: Retrieve the inserted crd_id
        //     $crd_id = mysqli_insert_id($con);

        //     // Step 3: Insert each bet pair into `coupon_bet_data` table
        //     $insert_bet_query = "INSERT INTO coupon_bet_data (crd_id, date, u_id, g_id, p_id,";
            
        //     // Generate column names and values for the insert query
        //     $column_names = array();
        //     $values = array();
        //     $result = counting($betStringResponse, $amount_without_pati);

        //     foreach ($result as $key => $value) {
        //         $column_names[] = "`$key`";
        //         $values[] = "'" . mysqli_real_escape_string($con, $value) . "'";
        //     }
        //     $insert_bet_query .= implode(',', $column_names) . ", bet_total, created_at, modified_at) VALUES ";
        //     $insert_bet_query .= "('$crd_id', '$date', '$user_id', '$game_id', '$party_id', " . implode(',', $values) . ", '$grand_total_without_pati', '$datetime', '$datetime')";
        // }

        // $insert_bet_result = mysqli_query($con, $insert_bet_query);

        // if ($insert_row_result) {
        //     echo json_encode(['success' => 'Bet data inserted successfully.']);
        // } else {
        //     echo json_encode(['error' => 'Error inserting bet data.']);
        // }
        echo json_encode(['success' => 'Bet data inserted successfully.']);
    } else {
        echo json_encode(['error' => 'Error inserting row data.']);
    }
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'delete_bet') {
    $user_id = $_SESSION['user_id']; // Ensure user_id is properly set in the session
    $game_id = mysqli_real_escape_string($con, $_GET['game_id']);
    $date = mysqli_real_escape_string($con, $_GET['date']); // Get the date from GET request
    $crd_id = mysqli_real_escape_string($con, $_GET['crd_id']);

    // Step 1: Delete data from `coupon_bet_data` table
    $delete_bet_query = "DELETE FROM coupon_bet_data WHERE crd_id = '$crd_id' AND u_id = '$user_id' AND g_id = '$game_id' AND date = '$date'";
    $delete_bet_result = mysqli_query($con, $delete_bet_query);

    if ($delete_bet_result) {
        // Step 2: Delete data from `coupon_row_data` table
        $delete_row_query = "DELETE FROM coupon_row_data WHERE crd_id = '$crd_id' AND u_id = '$user_id' AND g_id = '$game_id' AND date = '$date'";
        $delete_row_result = mysqli_query($con, $delete_row_query);

        if ($delete_row_result) {
            echo json_encode(['success' => 'Bet data deleted successfully.']);
        } else {
            echo json_encode(['error' => 'Error deleting row data.']);
        }
    } else {
        echo json_encode(['error' => 'Error deleting bet data.']);
    }
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'save_sheet') {
    $sheet_array = $_POST;
    $value_array = array();
    $data_array = array();
    $bet_number_string = "";
    $bet_string = mysqli_real_escape_string($con, $_POST['sheet']);
    $party_id = mysqli_real_escape_string($con, $_GET['party_id']);
    $user_id = $_SESSION['user_id']; // Ensure user_id is properly set in the session
    $game_id = mysqli_real_escape_string($con, $_GET['game_id']);
    $pati = floatval($_GET['pati']);
    $date = mysqli_real_escape_string($con, $_GET['date']); // Get the date from GET request
    $total_with_patti = 0;
    $total_without_patti = 0;
    
    if(!is_array($sheet_array) || count($sheet_array) == 0) {
        echo json_encode(['error' => 'Invalid sheet data.']);
        exit;
    }else{
        foreach ($sheet_array as $number => $value) {
            if($number != 'sheet' && $number != 'game_total'){
                $value = $value != '' ? $value : 0;
                // Calculate amount without pati
                if (isset($pati) && $pati > 0 && $value > 0) {
                    $value_array[$number] = $number."-".$value;
                    $total_with_patti += $value;
                    $value = $value - format_decimal(($value * $pati) / 100);
                    $data_array[$number] = mysqli_real_escape_string($con, $value);
                    $total_without_patti += $value;
                } else {
                    $value_array[$number] = $number."-".$value;
                    $data_array[$number] = mysqli_real_escape_string($con, $value);
                    $total_with_patti += $value;
                    $total_without_patti += $value;
                }
            }
        }
    }

    $bet_number_string = implode(',', $value_array);

    // Step 1: Insert data into `coupon_row_data` table
    $insert_row_query = "INSERT INTO coupon_row_data 
        (p_id, date, g_id, crd_bet_string, crd_bet_number_string, crd_amount, u_id, created_at, modified_at, bet_total, bet_pati) 
        VALUES 
        ('$party_id', '$date', '$game_id', '$bet_string', '$bet_number_string', '$total_with_patti', '$user_id', '$datetime', '$datetime', '$total_with_patti', '$pati')";

    $insert_row_result = mysqli_query($con, $insert_row_query);

    if ($insert_row_result) {
        // Step 2: Retrieve the inserted crd_id
        $crd_id = mysqli_insert_id($con);

        // Step 3: Insert each bet pair into `coupon_bet_data` table
        $insert_bet_query = "INSERT INTO coupon_bet_data (crd_id, date, u_id, g_id, p_id,";
        
        // Generate column names and values for the insert query
        $column_names = array();
        $values = array();
        $result = sheet_counting($data_array);

        foreach ($result as $key => $value) {
            // key is 01 to 09 remove the zero
            if($key < 10){
                $key = ltrim($key, '0');
                $column_names[] = "`$key`";
            }else{
                $column_names[] = "`$key`";
            }
            $values[] = "'" . mysqli_real_escape_string($con, $value) . "'";
        }
        
        $insert_bet_query .= implode(',', $column_names) . ", bet_total, created_at, modified_at) VALUES ";
        $insert_bet_query .= "('$crd_id', '$date', '$user_id', '$game_id', '$party_id', " . implode(',', $values) . ", '$total_without_patti', '$datetime', '$datetime')";

        $insert_bet_result = mysqli_query($con, $insert_bet_query);

        if ($insert_bet_result) {
            echo json_encode(['success' => 'Bet data inserted successfully.']);
        } else {
            echo json_encode(['error' => 'Error inserting bet data.']);
        }
    } else {
        echo json_encode(['error' => 'Error inserting row data.']);
    }

}

if(isset($_GET['action']) && $_GET['action'] == 'edit_bet'){
    $crd_id = $_GET['crd_id'];
    $user_id = $_SESSION['user_id']; // Ensure user_id is properly set in the session
    $party_id = mysqli_real_escape_string($con, $_GET['party_id']);
    $date = mysqli_real_escape_string($con, $_GET['date']); // Get the date from GET request
    $game_id = mysqli_real_escape_string($con, $_GET['game_id']);
    
    $query = "SELECT * FROM `coupon_row_data` WHERE `crd_id` = '$crd_id' AND `g_id` = '$game_id' AND `date` = '$date'";

    $result = mysqli_query($con, $query);
    $data = array();
    $response = array();
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        if($data['crd_bet_string'] == 's1' || $data['crd_bet_string'] == 's2' || $data['crd_bet_string'] == 'S1' || $data['crd_bet_string'] == 'S2'){
            $data['crd_bet_number_string'] = explode(',', $data['crd_bet_number_string']);
            $sheet = $data['crd_bet_string'];
            $sheet_array = array();
            foreach($data['crd_bet_number_string'] as $key => $value){
                $temp = explode('-', $value);
                $sheet_array[$temp[0]] = $temp[1];
            }
            // Fetch total bet for the selected party
            $total_bet = get_party_bet_sum($party_id, $user_id, $date, $game_id, $con);
            $total_bet_array = json_decode($total_bet,true);
            $total_array = jantri_total($sheet_array, $data['crd_bet_string'],$total_bet_array['total']);
            if(strtolower($sheet) == 's1'){
                $number_string = explode(',', SHEET1);
                $tally = '<div class="section-wise-pricing">
                                    <div>
                                        <div>
                                            <label for="">01-10</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_01_10'].'" name="" id="01-10" readonly>
                                        </div>
                                        <div>
                                            <label for="">11-20</label> <input type="number" style ="font-weight: 700;"  value="'.$total_array['total_11_20'].'" name="" id="11-20" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">21-30</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_21_30'].'" name="" id="21-30" readonly>
                                        </div>
                                        <div>
                                            <label for="">31-40</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_31_40'].'" name="" id="31-40" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">41-50</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_41_50'].'" name="" id="41-50" readonly>
                                        </div>
                                        <div>
                                            <label for="">51-60</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_51_60'].'" name="" id="51-60" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">61-70</label> <input type="number" style ="font-weight: 700;" name="" value="'.$total_array['total_61_70'].'" id="61-70" readonly>
                                        </div>
                                        <div>
                                            <label for="">71-80</label> <input type="number" style ="font-weight: 700;" name="" value="'.$total_array['total_71_80'].'" id="71-80" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">81-90</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_81_90'].'" name="" id="81-90" readonly>
                                        </div>
                                        <div>
                                            <label for="">91-100</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_91_100'].'" name="" id="91-100" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">A0-A9</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_a0_a9'].'" name="" id="a0-a9" readonly>
                                        </div>
                                        <div>
                                            <label for="">B0-B9</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_b0_b9'].'" name="" id="b0-b9" readonly>
                                        </div>
                                    </div>
                                </div>';
            }else if(strtolower($sheet) == 's2'){
                $number_string = explode(',', SHEET2);
                $tally = '<div class="section-wise-pricing">
                                    <div>
                                        <div>
                                            <label for="">01-91</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_01_91'].'" name="" id="01-91" readonly>
                                        </div>
                                        <div>
                                            <label for="">02-92</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_02_92'].'" name="" id="02-92" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">03-93</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_03_93'].'" name="" id="03-93" readonly>
                                        </div>
                                        <div>
                                            <label for="">04-94</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_04_94'].'" name="" id="04-94" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">05-95</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_05_95'].'" name="" id="05-95" readonly>
                                        </div>
                                        <div>
                                            <label for="">06-96</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_06_96'].'" name="" id="06-96" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">07-97</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_07_97'].'" name="" id="07-97" readonly>
                                        </div>
                                        <div>
                                            <label for="">08-98</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_08_98'].'" name="" id="08-98" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">09-99</label> <input type="number" style ="font-weight: 700;"  value="'.$total_array['total_09_99'].'" name="" id="09-99" readonly>
                                        </div>
                                        <div>
                                            <label for="">10-100</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_10_100'].'"  name="" id="10-100" readonly>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label for="">A0-A9</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_a0_a9'].'" name="" id="a0-a9" readonly>
                                        </div>
                                        <div>
                                            <label for="">B0-B9</label> <input type="number" style ="font-weight: 700;" value="'.$total_array['total_b0_b9'].'" name="" id="b0-b9" readonly>
                                        </div>
                                    </div>
                                </div>';
            }
        
            $tbody_data = '';
            // create a chunk of 6 elements
            $tbody_data = '';
            $chunk_size = 6;
            $counter = 0;
            
            // Single loop for generating the HTML
            foreach($sheet_array as $number => $value) {
                // Open a new row when counter is 0
                if ($counter % $chunk_size == 0) {
                    $tbody_data .= '<tr>';
                }
            
                // Check if this is the '01' to set autofocus
                $focus = ($number == '01') ? 'autofocus' : '';
                
                // Generate the table data for each chunk
                $tbody_data .= '<td>'.$number.'</td>';
                $tbody_data .= '<td style="margin: 0px; padding: 0px;">';
                $tbody_data .= '<input type="number" style="font-weight: 700; width: 57px;" value="'.$value.'" ';
                $tbody_data .= 'name="'.strtolower($number).'" id="'.strtolower($number).'" ';
                $tbody_data .= 'onkeypress="moveFocus(event)" '.$focus.'>';
                $tbody_data .= '</td>';
            
                // Close the row when the chunk size is met
                if ($counter % $chunk_size == ($chunk_size - 1)) {
                    $tbody_data .= '</tr>';
                }
            
                $counter++;
            }
            
            // If the last row is not closed (in case the sheet_array size isn't a multiple of 6)
            if ($counter % $chunk_size != 0) {
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
                                        Game Total : <input type="number" style ="font-weight: 700; width: 90px;" name="" id="total_bet" value="'.$total_array['game_total'].'" readonly>
                                    </div>
                                    <div class="1-100">
                                        Total 1-100 : <input type="number" style ="font-weight: 700; width: 90px;" name="" value="'.$total_array['total_01_100'].'" id="01-100" readonly>
                                    </div>
                                    <div class="AB_total">
                                        Total AB : <input type="number" style ="font-weight: 700; width: 90px;" name="" value="'.$total_array['total_AB'].'" id="AB" readonly>
                                    </div>
                                    <div class="jantri_total">
                                        Jantri Total : <input type="number" style ="font-weight: 700; width: 90px;" value="'.$total_array['jantri_total'].'" name="" id="jantri_total" readonly>
                                    </div>
                                </div>
                                '.$tally.'
                            </div>
                    <input type="hidden" name="game_total" id="game_total" value="'.$total_array['game_total'].'">
                    <input type="hidden" name="sheet" id="sheet" value="'.$data['crd_bet_string'].'">
                </div>';
            $response['data'] = $data;
            $response['type'] = 'sheet';

        }else{
            $data['crd_bet_number_string'] = explode(',', $data['crd_bet_number_string']);
            $response['type'] = 'normal';
            $response['no_of_pair'] = count($data['crd_bet_number_string']);
            $response['bet_string'] = $data['crd_bet_string'];
            $response['amount'] = $data['crd_amount'];
        }
        echo json_encode($response);
    }else{
        echo json_encode(['error' => 'No data found.']);
    }
    exit;
}

if(isset($_GET['action']) && $_GET['action'] == 'save_updated_sheet'){
    $sheet_array = $_POST;
    $value_array = array();
    $data_array = array();
    $bet_number_string = "";
    $bet_string = mysqli_real_escape_string($con, $_POST['sheet']);
    $party_id = mysqli_real_escape_string($con, $_GET['party_id']);
    $user_id = $_SESSION['user_id']; // Ensure user_id is properly set in the session
    $game_id = mysqli_real_escape_string($con, $_GET['game_id']);
    $pati = floatval($_GET['pati']);
    $date = mysqli_real_escape_string($con, $_GET['date']); // Get the date from GET request
    $total_with_patti = 0;
    $total_without_patti = 0;
    
    if(!is_array($sheet_array) || count($sheet_array) == 0) {
        echo json_encode(['error' => 'Invalid sheet data.']);
        exit;
    }else{
        foreach ($sheet_array as $number => $value) {
            if($number != 'sheet' && $number != 'game_total'){
                $value = $value != '' ? $value : 0;
                // Calculate amount without pati
                if (isset($pati) && $pati > 0 && $value > 0) {
                    $value_array[$number] = $number."-".$value;
                    $total_with_patti += $value;
                    $value = $value - format_decimal(($value * $pati) / 100);
                    $data_array[$number] = mysqli_real_escape_string($con, $value);
                    $total_without_patti += $value;
                } else {
                    $value_array[$number] = $number."-".$value;
                    $data_array[$number] = mysqli_real_escape_string($con, $value);
                    $total_with_patti += $value;
                    $total_without_patti += $value;
                }
            }
        }
    }

    $bet_number_string = implode(',', $value_array);

    // Step 1: Insert data into `coupon_row_data` table
    $insert_row_query = "UPDATE coupon_row_data 
        SET crd_bet_string = '$bet_string', crd_bet_number_string = '$bet_number_string', crd_amount = '$total_with_patti', bet_total = '$total_with_patti', bet_pati
        = '$pati', modified_at = '$datetime' WHERE p_id = '$party_id' AND u_id = '$user_id' AND g_id = '$game_id' AND date = '$date' AND crd_id = '".$_GET['crd_id']."'";
    $insert_row_result = mysqli_query($con, $insert_row_query);

    if ($insert_row_result) {
        // Step 2: Retrieve the inserted crd_id
        $crd_id = mysqli_insert_id($con);

        // Step 3: Insert each bet pair into `coupon_bet_data` table
        $insert_bet_query = "UPDATE coupon_bet_data SET ";
        
        // Generate column names and values for the insert query
        $column_names = array();
        $values = array();
        $result = sheet_counting($data_array);

        foreach ($result as $key => $value) {
            // key is 01 to 09 remove the zero
            if($key < 10){
                $key = ltrim($key, '0');
                $column_names[] = "`$key` = '".mysqli_real_escape_string($con, $value)."'";
            }else{
                $column_names[] = "`$key` = '".mysqli_real_escape_string($con, $value)."'";
            }
        }
        
        $insert_bet_query .= implode(',', $column_names) . ", bet_total = '$total_without_patti', modified_at = '$datetime' WHERE crd_id = '".$_GET['crd_id']."' AND u_id = '$user_id' AND g_id = '$game_id' AND p_id = '$party_id' AND date = '$date'";

        $insert_bet_result = mysqli_query($con, $insert_bet_query);

        if ($insert_bet_result) {
            echo json_encode(['success' => 'Bet data updated successfully.']);
        } else {
            echo json_encode(['error' => 'Error updating bet data.']);
        }
    } else {
        echo json_encode(['error' => 'Error updating row data.']);
    }

}
