<?php
# The database connection file.
if (require_once('connection.php')) {
    // echo "connection successfully";
} else {
    echo "connection failed. connection file not found.";
}
# Check the user is login into the system or not.x
if ($_SESSION['user_id'] == "") {
    header("location: login.php");
}


if(isset($_GET['action']) && $_GET['action'] == 'bet_numbers') {
    $game_id = $_GET['game_id'];
    $player_id = $_GET['player_id'];
    #row query
    /*SELECT
          `crd_bet_number_string`,
          `crd_amount`
      FROM
          `coupon_row_data`
      WHERE
          `g_id` = 2 AND `p_id` = 6;
     */   
    $query = "SELECT `crd_bet_number_string`, `crd_amount` FROM `coupon_row_data` WHERE `g_id` = $game_id AND `p_id` = $player_id";
    
    // Execute the query
    $result = mysqli_query($con, $query);
    
    $bet_number_array = array();
    // check the selected rows count and if the count if > 0  
    if(mysqli_num_rows($result) > 0) {
        // Iterate over the result and prepare the tr like mentioned below:
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $bet_number_array[$i]['string'] = $row['crd_bet_number_string'];
            $bet_number_array[$i]['rupee'] = $row['crd_amount'];
            $i++;
        }
    } 

    $bet_array = array();
    if(!empty($bet_number_array)) {
        $i = 1;
        foreach($bet_number_array as $key => $value) {
                $bet_number = explode(',', $value['string']);
                foreach($bet_number as $bn) {
                    $bet_array[$i][$bn] = $value['rupee'];
                    $i++;    
                }
        }
    } 
    
    // code to count number of keys in the bet array and prepare the response for the ajax call. as below mentioned. In one row there will be 8 columns.
    /*                                  <tr><td style = "font-weight: 600;">bet_number</td>
                                        <td style = "font-weight: 600;">rupee</td>
                                        <td style = "font-weight: 600;">bet_number</td>
                                        <td style = "font-weight: 600;">rupee</td>
                                        <td style = "font-weight: 600;">bet_number</td>
                                        <td style = "font-weight: 600;">rupee</td>
                                        <td style = "font-weight: 600;">bet_number</td>
                                        <td style = "font-weight: 600;">rupee</td></tr>
     */
    $response = '<tr>';
    $count = count($bet_array);
    
    foreach($bet_array as $key => $value) {
        foreach($value as $bet_number => $rupee) {
            $response .= '<td style = "font-weight: bolder;">'.$bet_number.'</td>';
            $response .= '<td style = "font-weight: bolder;">'.$rupee.'</td>';
        }
        if( $key % 4  == 0) {
            $response .= '</tr><tr>';
        }
    }

    $response .= '</tr>';
    echo $response;

    exit; // Stop further execution
}