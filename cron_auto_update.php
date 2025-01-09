<?php
require_once('connection.php');
require_once('constant.php');

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