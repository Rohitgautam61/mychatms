<?php
require_once('connection.php');
require_once('constant.php');

if(isset($_GET['action']) && $_GET['action'] == 'edit_bet_data') {
    $update_query = "SELECT crd_bet_number_string,crd_amount,`date`, u_id, p_id,g_id,crd_id,bet_pati FROM `coupon_row_data` WHERE `edit_cbd_bit` = '0' AND `crd_bet_string` NOT IN ('S1','S2')";
    $update_result = $con->query($update_query);
    if ($update_result->num_rows > 0) {
        while($row =  mysqli_fetch_assoc($update_result)){
            $crd_bet_number_string = $row['crd_bet_number_string'];
            $crd_amount = $row['crd_amount'];
            $date = $row['date'];
            $u_id = $row['u_id'];
            $p_id = $row['p_id'];
            $g_id = $row['g_id'];
            $crd_id = $row['crd_id']; 
            $bet_pati = $row['bet_pati'];
            // Calculate amount without pati
            if (isset($bet_pati) && $bet_pati > 0) {
                $amount_without_pati = $crd_amount - format_decimal(($crd_amount * $bet_pati) / 100);        
            } else {
                $amount_without_pati = $crd_amount;
            }
        
            // Calculate grand totals
            $grand_total_without_pati = $amount_without_pati * count(explode(',', $crd_bet_number_string));
            $column_names = array();
            $result = counting(explode(',', $crd_bet_number_string), $amount_without_pati);
            $insert_bet_query = "UPDATE coupon_bet_data SET ";
            foreach ($result as $key => $value) {
                $column_names[] = "`$key` = '".mysqli_real_escape_string($con, $value)."'";
            }
            $insert_bet_query .= implode(',', $column_names) . ", bet_total = '$grand_total_without_pati', modified_at = '$datetime' WHERE crd_id = '".$crd_id."'";
            $insert_bet_result = mysqli_query($con, $insert_bet_query);
            if ($insert_bet_result) {
                // update the edit_cbd_bit to 1
                $update_cbd_bit_query = "UPDATE coupon_row_data SET edit_cbd_bit = '1' WHERE crd_id = '$crd_id'";
                $update_cbd_bit_result = mysqli_query($con, $update_cbd_bit_query);
                $return['0'] = json_encode(['success' => 'Bet data updated successfully.']);
            } else {
                $return['0'] = json_encode(['error' => 'Error updating bet data.']);
            }
        }
    }else{
        $return['0'] = json_encode(['error' => 'No data found to update.']);
    }
    echo $return['0'];
    die;
}

if(isset($_GET['action']) && $_GET['action'] == 'insert_bet_data') {
    // fetch data from coupon_row_data table
    $sql = "SELECT crd_bet_number_string,crd_amount,`date`, u_id, p_id,g_id,crd_id,bet_pati FROM `coupon_row_data` WHERE `insert_cbd_bit` = '0' AND `crd_bet_string` NOT IN ('S1','S2')";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while($row =  mysqli_fetch_assoc($result)){
            $crd_bet_number_string = $row['crd_bet_number_string'];
            $crd_amount = $row['crd_amount'];
            $date = $row['date'];
            $u_id = $row['u_id'];
            $p_id = $row['p_id'];
            $g_id = $row['g_id'];
            $crd_id = $row['crd_id']; 
            $bet_pati = $row['bet_pati'];
            // Calculate amount without pati
            if (isset($bet_pati) && $bet_pati > 0) {
                $amount_without_pati = $crd_amount - format_decimal(($crd_amount * $bet_pati) / 100);        
            } else {
                $amount_without_pati = $crd_amount;
            }
        
            // Calculate grand totals
            $grand_total_without_pati = $amount_without_pati * count(explode(',', $crd_bet_number_string));

            // Step 3: Insert each bet pair into `coupon_bet_data` table
            $insert_bet_query = "INSERT INTO coupon_bet_data (crd_id, date, u_id, g_id, p_id,";

            // Generate column names and values for the insert query
            $column_names = array();
            $values = array();
            $result_counting = counting(explode(',', $crd_bet_number_string), $amount_without_pati); 
            foreach ($result_counting as $key => $value) {
                $column_names[] = "`$key`";
                $values[] = "'" . mysqli_real_escape_string($con, $value) . "'";
            }
            $insert_bet_query .= implode(',', $column_names) . ", bet_total, created_at, modified_at) VALUES ";
            $insert_bet_query .= "('$crd_id', '$date', '$u_id', '$g_id', '$p_id', " . implode(',', $values) . ", '$grand_total_without_pati', '$datetime', '$datetime')";
            $insert_bet_result = mysqli_query($con, $insert_bet_query);
            if ($insert_bet_result) {
                // update the insert_cbd_bit to 1
                $update_cbd_bit_query = "UPDATE coupon_row_data SET insert_cbd_bit = '1' WHERE crd_id = '$crd_id'";
                $update_cbd_bit_result = mysqli_query($con, $update_cbd_bit_query); 
                if($update_cbd_bit_result){
                    $return['0'] = json_encode(['success' => 'Bet data inserted successfully.']);
                }else{
                    $return['0'] = json_encode(['error' => 'Error updating bet data.']);
                }
            } else {
                $return['0'] = json_encode(['error' => 'Error inserting bet data.']);
            }
        }
    }else{
        $return['0'] = json_encode(['error' => 'No data found to insert.']);
    }
    echo $return['0'];
    die();
}

if(isset($_GET['action']) && $_GET['action'] == 'entry_checker') {
    // fetch data from coupon_row_data table
    $sql = "SELECT crd_bet_number_string,crd_amount,`date`, u_id, p_id,g_id,crd_id,bet_pati FROM `coupon_row_data` WHERE `insert_cbd_bit` = '0' AND `crd_bet_string` NOT IN ('S1','S2')";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo json_encode(['error' => 'No data found to insert.']);
    }else if(($result->num_rows == 0)){
        $update_query = "SELECT crd_bet_number_string,crd_amount,`date`, u_id, p_id,g_id,crd_id,bet_pati FROM `coupon_row_data` WHERE `edit_cbd_bit` = '0' AND `crd_bet_string` NOT IN ('S1','S2')";   
        $update_result = $con->query($update_query);
        if ($update_result->num_rows > 0) {
            echo json_encode(['error' => 'No data found to insert.']);
        }else{
            echo json_encode(['success' => 'true']);    
        }
    }else{
        echo json_encode(['success' => 'true']);
    }
    die();
}