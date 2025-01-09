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

require_once('constant.php');

# date for draw
date_default_timezone_set('Europe/London');
$g_date_added = date('Y-m-d');

/**
 * Get the sum of bet_total for a specific party, user, date, and game.
 *
 * @param int $party_id The ID of the party.
 * @param int $user_id The ID of the user.
 * @param string $date The date of the bets in 'YYYY-MM-DD' format.
 * @param int $game_id The ID of the game.
 * @param mysqli $con The MySQLi connection object.
 * @return string JSON encoded response with the sum of bets or error message.
 */
// function get_party_bet_sum($party_id, $user_id, $date, $game_id, $con) {
//     // Prepare the SQL query with placeholders
//     $query = "SELECT SUM(bet_total) AS total_bet FROM `coupon_row_data` WHERE p_id = ? AND g_id = ? AND u_id = ? AND date = ?";

//     // Initialize response array
//     $response = array();

//     // Prepare the statement
//     if ($stmt = mysqli_prepare($con, $query)) {
//         // Bind the parameters to the SQL query
//         mysqli_stmt_bind_param($stmt, "iiis", $party_id, $game_id, $user_id, $date);

//         // Execute the statement
//         mysqli_stmt_execute($stmt);

//         // Bind the result variables
//         mysqli_stmt_bind_result($stmt, $total_bet);

//         // Fetch the results
//         if (mysqli_stmt_fetch($stmt)) {
//             // Check if the total bet is not null
//             if (!is_null($total_bet)) {
//                 $response['total'] = $total_bet;
//             } else {
//                 $response['total'] = 0;
//             }
//         } else {
//             $response['error'] = "No records found.";
//         }

//         // Close the statement
//         mysqli_stmt_close($stmt);
//     } else {
//         $response['error'] = "Failed to prepare the SQL query.";
//     }

//     // Return the JSON encoded response
//     return json_encode($response);
// }

// Example usage:
// Assuming you have a valid MySQLi connection in $con
// $party_id = 6;
// $user_id = 1;
// $date = '2024-06-19';
// $game_id = 4;
// echo get_party_bet_sum($party_id, $user_id, $date, $game_id, $con);

/**
 * Fetch the party details like pati and limit based on the party ID.
 *
 * @param int $party_id The ID of the party.
 * @param mysqli $con The MySQLi connection object.
 * @return array The party details including pati and limit.
 */
// function fetch_party_details($party_id, $con) {
//     // Prepare the SQL query
//     $query = "SELECT p_limit, p_pati FROM parties WHERE p_id = ?";

//     // Prepare the statement
//     if ($stmt = mysqli_prepare($con, $query)) {
//         // Bind the parameters to the SQL query
//         mysqli_stmt_bind_param($stmt, "i", $party_id);

//         // Execute the statement
//         mysqli_stmt_execute($stmt);

//         // Bind the result variables
//         mysqli_stmt_bind_result($stmt, $p_limit, $p_pati);

//         // Fetch the results
//         if (mysqli_stmt_fetch($stmt)) {
//             $response = array('pati' => $p_pati, 'limit' => $p_limit);
//         } else {
//             $response = array('error' => "No party details found.");
//         }

//         // Close the statement
//         mysqli_stmt_close($stmt);
//     } else {
//         $response = array('error' => "Failed to prepare the SQL query.");
//     }

//     // Return the response
//     return $response;
// }






// // Check if the action is set and is "party_details"
// if (isset($_GET['action']) && $_GET['action'] == "party_details") {
//     $party_id = $_GET['party_id'];
//     $game_id = $_GET['game_id'];
//     $user_id = $_GET['user_id'];
//     $date = $_GET['date'];

//     // Fetch party details
//     $party_details = fetch_party_details($party_id, $con);

//     // Fetch party bet sum
//     $bet_sum = json_decode(get_party_bet_sum($party_id, $user_id, $date, $game_id, $con), true);

//     // Combine responses
//     if (!isset($party_details['error']) && !isset($bet_sum['error'])) {
//         $response = array_merge($party_details, $bet_sum);
//         // Return the JSON encoded response
//         echo json_encode($response);
//         exit;
//     } else {
//         $response = "Failed to fetch party details or bet sum.";
//         // Return the response
//         echo $response;
//         exit;
//     }
// }

// Check if action is 'game_details'
// if (isset($_GET['action']) && $_GET['action'] == 'game_details') {
//     // Fetch Draw Number and Date Added based on the selected Game ID
//     $game_id = $_GET['game_id'];
//     // Example query, replace with your actual query to fetch Draw Number and Date Added
//     $query = "SELECT g_draw, g_date_added FROM games WHERE g_id = $game_id";
//     // Execute query and fetch results
//     $result = mysqli_query($con, $query);
    
//     if ($result) {
//         $game = mysqli_fetch_assoc($result);
//         if (!empty($game)) {
//             // Example response array, replace with your actual response array
//             $response = array('draw' => $game['g_draw'], 'date_added' => $game['g_date_added']);
//             echo json_encode($response);
//         } else {
//             $response =  'No data found for the selected game.';
//             echo $response;
//         }
//     } else {
//         echo 'Error fetching game details.';
//     }
//     exit;
// }
/* **********************************************************************************************
* END: Code for the Party Details Block
* **********************************************************************************************
*/
// function counting($betStringResponse, $amount) {
//     $counting = array();

//     // Add numbers from 1 to 100
//     for ($i = 1; $i <= 100; $i++) {
//         $counting[$i] = 0;
//     }

//     // Add letters A0 to A9
//     for ($i = 0; $i <= 9; $i++) {
//         $counting['a' . $i] = 0;
//     }

//     // Add letters B0 to B9
//     for ($i = 0; $i <= 9; $i++) {
//         $counting['b' . $i] = 0;
//     }

//     // Update $counting array based on $betStringResponse
//     foreach ($betStringResponse as $value) {
//         if (array_key_exists($value, $counting)) {
//             $counting[$value] += $amount;
//         }
//     }

//     return $counting;
// }


/**
 * Handle row input action, insert data into `coupon_row_data` and `coupon_bet_data` tables.
 *
 * @param mysqli $con The MySQLi connection object.
 */
// function handle_row_input($con) {
//     // Fetching input values
//     $party_id = $_GET['party_id'];
//     $user_id = $_SESSION['user_id'];
//     $game_id = $_GET['game_id'];
//     $bet_string = $_GET['bet_string'];
//     $amount = $_GET['amount'];
//     $betStringResponse = $_GET['betStringResponse'];
//     $noOfPair = $_GET['noOfPair'];
//     $pati = $_GET['pati'];
//     $date = $_GET['date']; // Get the date from GET request
//     $bet_number_string = implode(',', $betStringResponse);

//     // Assuming $amount and $pati are defined earlier in the script
//     if (isset($pati) && $pati > 0) {
//         $amount_without_pati = $amount - format_decimal(($amount * $pati) / 100);
//     } else {
//         $amount_without_pati = $amount;
//     }

//     $grand_total_without_pati = $amount_without_pati * $noOfPair;
//     $grand_total_with_pati = $amount * $noOfPair;

//     // Step 1: Insert data into `coupon_row_data` table
//     $insert_row_query = "INSERT INTO coupon_row_data (p_id, date, g_id, crd_bet_string, crd_bet_number_string, crd_amount, u_id, created_at, modified_at, bet_total, bet_pati) 
//                         VALUES ('$party_id', '$date' ,'$game_id', '".$bet_string."', '$bet_number_string', '$amount', '$user_id', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'$grand_total_with_pati','$pati')";
    
//     $insert_row_result = mysqli_query($con, $insert_row_query);

//     if($insert_row_result) {
//         // Step 2: Retrieve the inserted crd_id
//         $crd_id = mysqli_insert_id($con);

//         // Step 3: Insert each bet pair into `coupon_bet_data` table
//         $insert_bet_query = "INSERT INTO coupon_bet_data (crd_id, date, u_id, g_id, p_id,";
//         $result = counting($betStringResponse, $amount_without_pati);

//         // Generate column names and values for the insert query
//         $column_names = array();
//         $values = array();
//         foreach($result as $key => $value) {
//             $column_names[] = "`$key`";
//             $values[] = "'$value'";
//         }
//         $insert_bet_query .= implode(',', $column_names) . ",bet_total, created_at, modified_at) VALUES ";
//         $insert_bet_query .= "('$crd_id', '$date', '$user_id' ,'$game_id', '$party_id', " . implode(',', $values) . ",'$grand_total_without_pati', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
//         $insert_bet_result = mysqli_query($con, $insert_bet_query);

//         if($insert_bet_result) {
//             echo "Data inserted successfully.";
//         } else {
//             echo "Error: Unable to insert bet data.";
//         }
//     } else {
//         echo "Error: Unable to insert row data.";
//     }
// }

// if ($_GET['action'] == 'row_input') {
//     // Fetching input values
//     $party_id = $_GET['party_id'];
//     $user_id = $_SESSION['user_id'];
//     $game_id = $_GET['game_id'];
//     $bet_string = $_GET['bet_string'];
//     $amount = $_GET['amount'];
//     $betStringResponse = $_GET['betStringResponse'];
//     $noOfPair = $_GET['noOfPair'];
//     $pati = $_GET['pati'];
//     $date = $_GET['date']; // Get the date from GET request
//     $bet_number_string = implode(',', $betStringResponse);

//     // Assuming $amount and $pati are defined earlier in the script
//     if (isset($pati) && $pati > 0) {
//         $amount_without_pati = $amount - format_decimal(($amount * $pati) / 100);
//     } else {
//         $amount_without_pati = $amount;
//     }

//     $grand_total_without_pati = $amount_without_pati * $noOfPair;
//     $grand_total_with_pati = $amount * $noOfPair;

//     // Step 1: Insert data into `coupon_row_data` table
//     $insert_row_query = "INSERT INTO coupon_row_data (p_id, date, g_id, crd_bet_string, crd_bet_number_string, crd_amount, u_id, created_at, modified_at, bet_total, bet_pati) 
//                         VALUES ('$party_id', '$date' ,'$game_id', '".$bet_string."', '$bet_number_string', '$amount', '$user_id', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'$grand_total_with_pati','$pati')";
    
//     $insert_row_result = mysqli_query($con, $insert_row_query);

//     if($insert_row_result) {
//         // Step 2: Retrieve the inserted crd_id
//         $crd_id = mysqli_insert_id($con);

//         // Step 3: Insert each bet pair into `coupon_bet_data` table
//         $insert_bet_query = "INSERT INTO coupon_bet_data (crd_id, date, u_id, g_id, p_id,";
//         $result = counting($betStringResponse, $amount_without_pati);

//         // Generate column names and values for the insert query
//         $column_names = array();
//         $values = array();
//         foreach($result as $key => $value) {
//             $column_names[] = "`$key`";
//             $values[] = "'$value'";
//         }
//         $insert_bet_query .= implode(',', $column_names) . ",bet_total, created_at, modified_at) VALUES ";
//         $insert_bet_query .= "('$crd_id', '$date', '$user_id' ,'$game_id', '$party_id', " . implode(',', $values) . ",'$grand_total_without_pati', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
//         $insert_bet_result = mysqli_query($con, $insert_bet_query);

//         if($insert_bet_result) {
//             echo "Data inserted successfully.";
//         } else {
//             echo "Error: Unable to insert bet data.";
//         }
//     } else {
//         echo "Error: Unable to insert row data.";
//     }
//     exit;
// }


// if (isset($_GET['action']) && $_GET['action'] == 'fetch_game_draw_data') {
//     // Fetch game draw data based on the selected Game ID
//     $game_id = $_GET['game_id'];
//     $date = $_GET['date']; // Assuming today's date, adjust if necessary
    
//     // Example query, replace with your actual query to fetch game draw data
//     $query = "
//         SELECT crd.p_id,p.p_name, crd.created_at, g.g_name, g.g_draw, SUM(crd.bet_total) AS total_bet
//         FROM coupon_row_data crd
//         INNER JOIN parties p ON p.p_id = crd.p_id
//         INNER JOIN games g ON g.g_id = crd.g_id
//         WHERE crd.g_id = '$game_id' AND crd.date = '$date'
//         GROUP BY crd.p_id
//         ORDER BY crd.created_at DESC
//     ";
    
//     $result = mysqli_query($con, $query);

//     // Check the selected rows count and if the count is > 0  
//     if (mysqli_num_rows($result) > 0) {
//         // Initialize $i
//         $i = 1;
//         // Iterate over the result and prepare the tr like mentioned below:
//         while ($row = mysqli_fetch_assoc($result)) {
//             echo '<tr>';
//             echo '<td>' . $i++ . '</td>'; // Increment $i for each row
//             echo '<td>' . $row['p_name'] . '</td>';
//             echo '<td>' . $row['g_name'] . '</td>';
//             echo '<td>' . $row['created_at'] . '</td>';
//             echo '<td>' . $row['g_draw'] . '</td>';
//             echo '<td>' . $row['total_bet'] . '</td>';
//             echo '<td>';
//             echo '<a href="#" class="text-danger"><img src="assets/images/icon_edit3.gif" onclick=create_party_sheet('.$game_id.','.$row['p_id'].')></a>';
//             echo '</td>';
//             echo '</tr>';        }
//     } else {
//         echo '<b>No entry found.</b>';
//     }
//     exit; // Stop further execution
// }


// Check if action is 'game_details'
// if(isset($_GET['action']) && $_GET['action'] == 'party_bet_details') {
//     // Connect to database
//     // Fetch Draw Number based on the selected Game ID
//     $game_id = $_GET['game_id'];
//     $date = $g_date_added;
//     $party_id = $_GET['party_id'];
//     // Example query, replace with your actual query to fetch Draw Number
//     $query = "SELECT crd_id, p.p_name, crd_bet_string, crd_amount FROM `coupon_row_data` crd INNER JOIN `parties` p ON crd.p_id = p.p_id WHERE p.`p_id` = '$party_id' AND `g_id` = '$game_id'";
//     // Example response, replace with your actual response
//     $result = mysqli_query($con, $query);
//     // check the selected rows count and if the count if > 0  
//     if(mysqli_num_rows($result) > 0) {
//         // Initialize $i
//         $i = 1;
//         // Iterate over the result and prepare the tr like mentioned below:
//         while($row = mysqli_fetch_assoc($result)) {
//             echo '<tr>';
//             echo '<td>' . $i++ . '</td>'; // Increment $i for each row
//             echo '<td>' . $row['crd_bet_string'] . '</td>';
//             echo '<td>' . $row['crd_amount'] . '</td>';
//             echo '<td style="padding-left:2px;">';
//             echo '<a href = "#"><img src="assets/images/edit.gif"></a>';
//             echo ' || ';
//             echo '<a href="#"><img src="assets/images/delete.gif" onclick="return confirmDeletion();"></a>';
//             echo '</td>';
//             echo '</tr>';
//         }
//     } else {
//         echo '<b> No entry found. </b>';
//     }
//     exit; // Stop further execution
// }

// Check if action is 'game_details'
if(isset($_GET['action']) && $_GET['action'] == 'bet_details') {
    // Connect to database
    // Fetch Draw Number based on the selected Game ID
    $game_id = $_GET['game_id'];
    $date = $_GET['date'];

    // Construct the query to sum all columns
    $query = "SELECT 
               SUM(`1`) as `1`,SUM(`2`) as `2`,SUM(`3`) as `3`,SUM(`4`) as `4`,SUM(`5`) as `5`,SUM(`6`) as `6`,SUM(`7`) as `7`,SUM(`8`) as `8`,SUM(`9`) as `9`,SUM(`10`) as `10`,SUM(`11`) as `11`,SUM(`12`) as `12`,SUM(`13`) as `13`,SUM(`14`) as `14`,SUM(`15`) as `15`,SUM(`16`) as `16`,SUM(`17`) as `17`,SUM(`18`) as `18`,SUM(`19`) as `19`,SUM(`20`) as `20`,SUM(`21`) as `21`,SUM(`22`) as `22`,SUM(`23`) as `23`,SUM(`24`) as `24`,SUM(`25`) as `25`,SUM(`26`) as `26`,SUM(`27`) as `27`,SUM(`28`) as `28`,SUM(`29`) as `29`,SUM(`30`) as `30`,SUM(`31`) as `31`,SUM(`32`) as `32`,SUM(`33`) as `33`,SUM(`34`) as `34`,SUM(`35`) as `35`,SUM(`36`) as `36`,SUM(`37`) as `37`,SUM(`38`) as `38`,SUM(`39`) as `39`,SUM(`40`) as `40`,SUM(`41`) as `41`,SUM(`42`) as `42`,SUM(`43`) as `43`,SUM(`44`) as `44`,SUM(`45`) as `45`,SUM(`46`) as `46`,SUM(`47`) as `47`,SUM(`48`) as `48`,SUM(`49`) as `49`,SUM(`50`) as `50`,SUM(`51`) as `51`,SUM(`52`) as `52`,SUM(`53`) as `53`,SUM(`54`) as `54`,SUM(`55`) as `55`,SUM(`56`) as `56`,SUM(`57`) as `57`,SUM(`58`) as `58`,SUM(`59`) as `59`,SUM(`60`) as `60`,SUM(`61`) as `61`,SUM(`62`) as `62`,SUM(`63`) as `63`,SUM(`64`) as `64`,SUM(`65`) as `65`,SUM(`66`) as `66`,SUM(`67`) as `67`,SUM(`68`) as `68`,SUM(`69`) as `69`,SUM(`70`) as `70`,SUM(`71`) as `71`,SUM(`72`) as `72`,SUM(`73`) as `73`,SUM(`74`) as `74`,SUM(`75`) as `75`,SUM(`76`) as `76`,SUM(`77`) as `77`,SUM(`78`) as `78`,SUM(`79`) as `79`,SUM(`80`) as `80`,SUM(`81`) as `81`,SUM(`82`) as `82`,SUM(`83`) as `83`,SUM(`84`) as `84`,SUM(`85`) as `85`,SUM(`86`) as `86`,SUM(`87`) as `87`,SUM(`88`) as `88`,SUM(`89`) as `89`,SUM(`90`) as `90`,SUM(`91`) as `91`,SUM(`92`) as `92`,SUM(`93`) as `93`,SUM(`94`) as `94`,SUM(`95`) as `95`,SUM(`96`) as `96`,SUM(`97`) as `97`,SUM(`98`) as `98`,SUM(`99`) as `99`,SUM(`100`) as `100`,SUM(`a0`) as `a0`,SUM(`a1`) as `a1`,SUM(`a2`) as `a2`,SUM(`a3`) as `a3`,SUM(`a4`) as `a4`,SUM(`a5`) as `a5`,SUM(`a6`) as `a6`,SUM(`a7`) as `a7`,SUM(`a8`) as `a8`,SUM(`a9`) as `a9`,SUM(`b0`) as `b0`,SUM(`b1`) as `b1`,SUM(`b2`) as `b2`,SUM(`b3`) as `b3`,SUM(`b4`) as `b4`,SUM(`b5`) as `b5`,SUM(`b6`) as `b6`,SUM(`b7`) as `b7`,SUM(`b8`) as `b8`,SUM(`b9`) as `b9`
            FROM 
                `coupon_bet_data` crd 
            WHERE 
                `g_id` = '$game_id' AND 
                `date` = '$date'";

    // Execute the query
    $result = mysqli_query($con, $query);
    
    // check the selected rows count and if the count if > 0  
    if(mysqli_num_rows($result) > 0) {
        // Iterate over the result and prepare the tr like mentioned below:
        while($row = mysqli_fetch_assoc($result)) {
            sheet($row);
        }
    } else {
        sheet('default');
    }
    exit; // Stop further execution
}

// // Check if action is 'game_details'
// if(isset($_GET['action']) && $_GET['action'] == 'final_sheet') {
//     // Connect to database
//     // Fetch Draw Number based on the selected Game ID
//     $game_id = $_GET['game_id'];
//     $date = $_GET['date'];

//     // Construct the query to sum all columns
//     $query = "SELECT 
//                SUM(`1`) +SUM(`b1`)/10+SUM(`a0`)/10 AS `1`,SUM(`2`)+SUM(`b2`)/10+SUM(`a0`)/10 AS `2`,SUM(`3`)+SUM(`b3`)/10+SUM(`a0`)/10 AS `3`,SUM(`4`)+SUM(`b4`)/10+SUM(`a0`)/10 AS `4`,SUM(`5`)+SUM(`b5`)/10+SUM(`a0`)/10 AS `5`,SUM(`6`)+SUM(`b6`)/10+SUM(`a0`)/10 AS `6`,SUM(`7`)+SUM(`b7`)/10+SUM(`a0`)/10 AS `7`,SUM(`8`)+SUM(`b8`)/10+SUM(`a0`)/10 AS `8`,SUM(`9`)+SUM(`b9`)/10+SUM(`a0`)/10 AS `9`,SUM(`10`)+SUM(`b0`)/10+SUM(`a1`)/10 AS `10`,SUM(`11`)+SUM(`b1`)/10+SUM(`a1`)/10 AS `11`,SUM(`12`)+SUM(`b2`)/10+SUM(`a1`)/10 AS `12`,SUM(`13`)+SUM(`b3`)/10+SUM(`a1`)/10 AS `13`,SUM(`14`)+SUM(`b4`)/10+SUM(`a1`)/10 AS `14`,SUM(`15`)+SUM(`b5`)/10+SUM(`a1`)/10 AS `15`,SUM(`16`)+SUM(`b6`)/10+SUM(`a1`)/10 AS `16`,SUM(`17`)+SUM(`b7`)/10+SUM(`a1`)/10 AS `17`,SUM(`18`)+SUM(`b8`)/10+SUM(`a1`)/10 AS `18`,SUM(`19`)+SUM(`b9`)/10+SUM(`a1`)/10 AS `19`,SUM(`20`)+SUM(`b0`)/10+SUM(`a2`)/10 AS `20`,SUM(`21`)+SUM(`b1`)/10+SUM(`a2`)/10 AS `21`,SUM(`22`)+SUM(`b2`)/10+SUM(`a2`)/10 AS `22`,SUM(`23`)+SUM(`b3`)/10+SUM(`a2`)/10 AS `23`,SUM(`24`)+SUM(`b4`)/10+SUM(`a2`)/10 AS `24`,SUM(`25`)+SUM(`b5`)/10+SUM(`a2`)/10 AS `25`,SUM(`26`)+SUM(`b6`)/10+SUM(`a2`)/10 AS `26`,SUM(`27`)+SUM(`b7`)/10+SUM(`a2`)/10 AS `27`,SUM(`28`)+SUM(`b8`)/10+SUM(`a2`)/10 AS `28`,SUM(`29`)+SUM(`b9`)/10+SUM(`a2`)/10 AS `29`,SUM(`30`)+SUM(`b0`)/10+SUM(`a3`)/10 AS `30`,SUM(`31`)+SUM(`b1`)/10+SUM(`a3`)/10 AS `31`,SUM(`32`)+SUM(`b2`)/10+SUM(`a3`)/10 AS `32`,SUM(`33`)+SUM(`b3`)/10+SUM(`a3`)/10 AS `33`,SUM(`34`)+SUM(`b4`)/10+SUM(`a3`)/10 AS `34`,SUM(`35`)+SUM(`b5`)/10+SUM(`a3`)/10 AS `35`,SUM(`36`)+SUM(`b6`)/10+SUM(`a3`)/10 AS `36`,SUM(`37`)+SUM(`b7`)/10+SUM(`a3`)/10 AS `37`,SUM(`38`)+SUM(`b8`)/10+SUM(`a3`)/10 AS `38`,SUM(`39`)+SUM(`b9`)/10+SUM(`a3`)/10 AS `39`,SUM(`40`)+SUM(`b0`)/10+SUM(`a4`)/10 AS `40`,SUM(`41`)+SUM(`b1`)/10+SUM(`a4`)/10 AS `41`,SUM(`42`)+SUM(`b2`)/10+SUM(`a4`)/10 AS `42`,SUM(`43`)+SUM(`b3`)/10+SUM(`a4`)/10 AS `43`,SUM(`44`)+SUM(`b4`)/10+SUM(`a4`)/10 AS `44`,SUM(`45`)+SUM(`b5`)/10+SUM(`a4`)/10 AS `45`,SUM(`46`)+SUM(`b6`)/10+SUM(`a4`)/10 AS `46`,SUM(`47`)+SUM(`b7`)/10+SUM(`a4`)/10 AS `47`,SUM(`48`)+SUM(`b8`)/10+SUM(`a4`)/10 AS `48`,SUM(`49`)+SUM(`b9`)/10+SUM(`a4`)/10 AS `49`,SUM(`50`)+SUM(`b0`)/10+SUM(`a5`)/10 AS `50`,SUM(`51`)+SUM(`b1`)/10+SUM(`a5`)/10 AS `51`,SUM(`52`)+SUM(`b2`)/10+SUM(`a5`)/10 AS `52`,SUM(`53`)+SUM(`b3`)/10+SUM(`a5`)/10 AS `53`,SUM(`54`)+SUM(`b4`)/10+SUM(`a5`)/10 AS `54`,SUM(`55`)+SUM(`b5`)/10+SUM(`a5`)/10 AS `55`,SUM(`56`)+SUM(`b6`)/10+SUM(`a5`)/10 AS `56`,SUM(`57`)+SUM(`b7`)/10+SUM(`a5`)/10 AS `57`,SUM(`58`)+SUM(`b8`)/10+SUM(`a5`)/10 AS `58`,SUM(`59`)+SUM(`b9`)/10+SUM(`a5`)/10 AS `59`,SUM(`60`)+SUM(`b0`)/10+SUM(`a6`)/10 AS `60`,SUM(`61`)+SUM(`b1`)/10+SUM(`a6`)/10 AS `61`,SUM(`62`)+SUM(`b2`)/10+SUM(`a6`)/10 AS `62`,SUM(`63`)+SUM(`b3`)/10+SUM(`a6`)/10 AS `63`,SUM(`64`)+SUM(`b4`)/10+SUM(`a6`)/10 AS `64`,SUM(`65`)+SUM(`b5`)/10+SUM(`a6`)/10 AS `65`,SUM(`66`)+SUM(`b6`)/10+SUM(`a6`)/10 AS `66`,SUM(`67`)+SUM(`b7`)/10+SUM(`a6`)/10 AS `67`,SUM(`68`)+SUM(`b8`)/10+SUM(`a6`)/10 AS `68`,SUM(`69`)+SUM(`b9`)/10+SUM(`a6`)/10 AS `69`,SUM(`70`)+SUM(`b0`)/10+SUM(`a7`)/10 AS `70`,SUM(`71`)+SUM(`b1`)/10+SUM(`a7`)/10 AS `71`,SUM(`72`)+SUM(`b2`)/10+SUM(`a7`)/10 AS `72`,SUM(`73`)+SUM(`b3`)/10+SUM(`a7`)/10 AS `73`,SUM(`74`)+SUM(`b4`)/10+SUM(`a7`)/10 AS `74`,SUM(`75`)+SUM(`b5`)/10+SUM(`a7`)/10 AS `75`,SUM(`76`)+SUM(`b6`)/10+SUM(`a7`)/10 AS `76`,SUM(`77`)+SUM(`b7`)/10+SUM(`a7`)/10 AS `77`,SUM(`78`)+SUM(`b8`)/10+SUM(`a7`)/10 AS `78`,SUM(`79`)+SUM(`b9`)/10+SUM(`a7`)/10 AS `79`,SUM(`80`)+SUM(`b0`)/10+SUM(`a8`)/10 AS `80`,SUM(`81`)+SUM(`b1`)/10+SUM(`a8`)/10 AS `81`,SUM(`82`)+SUM(`b2`)/10+SUM(`a8`)/10 AS `82`,SUM(`83`)+SUM(`b3`)/10+SUM(`a8`)/10 AS `83`,SUM(`84`)+SUM(`b4`)/10+SUM(`a8`)/10 AS `84`,SUM(`85`)+SUM(`b5`)/10+SUM(`a8`)/10 AS `85`,SUM(`86`)+SUM(`b6`)/10+SUM(`a8`)/10 AS `86`,SUM(`87`)+SUM(`b7`)/10+SUM(`a8`)/10 AS `87`,SUM(`88`)+SUM(`b8`)/10+SUM(`a8`)/10 AS `88`,SUM(`89`)+SUM(`b9`)/10+SUM(`a8`)/10 AS `89`,SUM(`90`)+SUM(`b0`)/10+SUM(`a9`)/10 AS `90`,SUM(`91`)+SUM(`b1`)/10+SUM(`a9`)/10 AS `91`,SUM(`92`)+SUM(`b2`)/10+SUM(`a9`)/10 AS `92`,SUM(`93`)+SUM(`b3`)/10+SUM(`a9`)/10 AS `93`,SUM(`94`)+SUM(`b4`)/10+SUM(`a9`)/10 AS `94`,SUM(`95`)+SUM(`b5`)/10+SUM(`a9`)/10 AS `95`,SUM(`96`)+SUM(`b6`)/10+SUM(`a9`)/10 AS `96`,SUM(`97`)+SUM(`b7`)/10+SUM(`a9`)/10 AS `97`,SUM(`98`)+SUM(`b8`)/10+SUM(`a9`)/10 AS `98`,SUM(`99`)+SUM(`b9`)/10+SUM(`a9`)/10 AS `99`,SUM(`100`)+SUM(`b0`)/10+SUM(`a0`)/10 AS `100`
//             FROM 
//                 `coupon_bet_data` crd 
//             WHERE 
//                 `g_id` = '$game_id' AND 
//                 `date` = '$date'";

//     // Execute the query
//     $result = mysqli_query($con, $query);
    
//     // check the selected rows count and if the count if > 0  
//     if(mysqli_num_rows($result) > 0) {
//         // Iterate over the result and prepare the tr like mentioned below:
//         while($row = mysqli_fetch_assoc($result)) {
//             final_sheet($row);
//         }
//     } else {
//         final_sheet('default');
//     }
//     exit; // Stop further execution
// }

// Check if action is 'game_details'
// if(isset($_GET['action']) && $_GET['action'] == 'update_total') {
//     // Connect to database
//     // Fetch Draw Number based on the selected Game ID
//     $game_id = $_GET['game_id'];
//     $date = $_GET['date'];

//     // Construct the query to sum all columns
//     $query = "SELECT 
//                 SUM(`1`)+SUM(`2`)+SUM(`3`)+SUM(`4`)+SUM(`5`)+SUM(`6`)+SUM(`7`)+SUM(`8`)+SUM(`9`)+SUM(`10`) AS `1-10`,SUM(`11`)+SUM(`12`)+SUM(`13`)+SUM(`14`)+SUM(`15`)+SUM(`16`)+SUM(`17`)+SUM(`18`)+SUM(`19`)+SUM(`20`) AS `11-20`,SUM(`21`)+SUM(`22`)+SUM(`23`)+SUM(`24`)+SUM(`25`)+SUM(`26`)+SUM(`27`)+SUM(`28`)+SUM(`29`)+SUM(`30`) AS `21-30`,SUM(`31`)+SUM(`32`)+SUM(`33`)+SUM(`34`)+SUM(`35`)+SUM(`36`)+SUM(`37`)+SUM(`38`)+SUM(`39`)+SUM(`40`) AS `31-40`,SUM(`41`)+SUM(`42`)+SUM(`43`)+SUM(`44`)+SUM(`45`)+SUM(`46`)+SUM(`47`)+SUM(`48`)+SUM(`49`)+SUM(`50`) AS `41-50`,SUM(`51`)+SUM(`52`)+SUM(`53`)+SUM(`54`)+SUM(`55`)+SUM(`56`)+SUM(`57`)+SUM(`58`)+SUM(`59`)+SUM(`60`) AS `51-60`,SUM(`61`)+SUM(`62`)+SUM(`63`)+SUM(`64`)+SUM(`65`)+SUM(`66`)+SUM(`67`)+SUM(`68`)+SUM(`69`)+SUM(`70`) AS `61-70`,SUM(`71`)+SUM(`72`)+SUM(`73`)+SUM(`74`)+SUM(`75`)+SUM(`76`)+SUM(`77`)+SUM(`78`)+SUM(`79`)+SUM(`80`) AS `71-80`,SUM(`81`)+SUM(`82`)+SUM(`83`)+SUM(`84`)+SUM(`85`)+SUM(`86`)+SUM(`87`)+SUM(`88`)+SUM(`89`)+SUM(`90`) AS `81-90`,SUM(`91`)+SUM(`92`)+SUM(`93`)+SUM(`94`)+SUM(`95`)+SUM(`96`)+SUM(`97`)+SUM(`98`)+SUM(`99`)+SUM(`100`) AS `91-100`,SUM(`a0`)+SUM(`a1`)+SUM(`a2`)+SUM(`a3`)+SUM(`a4`)+SUM(`a5`)+SUM(`a6`)+SUM(`a7`)+SUM(`a8`)+SUM(`a9`) AS `a0-a9`,SUM(`b0`)+SUM(`b1`)+SUM(`b2`)+SUM(`b3`)+SUM(`b4`)+SUM(`b5`)+SUM(`b6`)+SUM(`b7`)+SUM(`b8`)+SUM(`b9`) AS `b0-b9`,SUM(`1`)+SUM(`2`)+SUM(`3`)+SUM(`4`)+SUM(`5`)+SUM(`6`)+SUM(`7`)+SUM(`8`)+SUM(`9`)+SUM(`10`)+SUM(`11`)+SUM(`12`)+SUM(`13`)+SUM(`14`)+SUM(`15`)+SUM(`16`)+SUM(`17`)+SUM(`18`)+SUM(`19`)+SUM(`20`)+SUM(`21`)+SUM(`22`)+SUM(`23`)+SUM(`24`)+SUM(`25`)+SUM(`26`)+SUM(`27`)+SUM(`28`)+SUM(`29`)+SUM(`30`)+SUM(`31`)+SUM(`32`)+SUM(`33`)+SUM(`34`)+SUM(`35`)+SUM(`36`)+SUM(`37`)+SUM(`38`)+SUM(`39`)+SUM(`40`)+SUM(`41`)+SUM(`42`)+SUM(`43`)+SUM(`44`)+SUM(`45`)+SUM(`46`)+SUM(`47`)+SUM(`48`)+SUM(`49`)+SUM(`50`)+SUM(`51`)+SUM(`52`)+SUM(`53`)+SUM(`54`)+SUM(`55`)+SUM(`56`)+SUM(`57`)+SUM(`58`)+SUM(`59`)+SUM(`60`)+SUM(`61`)+SUM(`62`)+SUM(`63`)+SUM(`64`)+SUM(`65`)+SUM(`66`)+SUM(`67`)+SUM(`68`)+SUM(`69`)+SUM(`70`)+SUM(`71`)+SUM(`72`)+SUM(`73`)+SUM(`74`)+SUM(`75`)+SUM(`76`)+SUM(`77`)+SUM(`78`)+SUM(`79`)+SUM(`80`)+SUM(`81`)+SUM(`82`)+SUM(`83`)+SUM(`84`)+SUM(`85`)+SUM(`86`)+SUM(`87`)+SUM(`88`)+SUM(`89`)+SUM(`90`)+SUM(`91`)+SUM(`92`)+SUM(`93`)+SUM(`94`)+SUM(`95`)+SUM(`96`)+SUM(`97`)+SUM(`98`)+SUM(`99`)+SUM(`100`)+SUM(`a0`)+SUM(`a1`)+SUM(`a2`)+SUM(`a3`)+SUM(`a4`)+SUM(`a5`)+SUM(`a6`)+SUM(`a7`)+SUM(`a8`)+SUM(`a9`)+SUM(`b0`)+SUM(`b1`)+SUM(`b2`)+SUM(`b3`)+SUM(`b4`)+SUM(`b5`)+SUM(`b6`)+SUM(`b7`)+SUM(`b8`)+SUM(`b9`) AS `total_bet`
//             FROM 
//                 `coupon_bet_data` crd 
//             WHERE 
//                 `g_id` = '$game_id' AND 
//                 `date` = '$date'";
                
//     // Execute the query
//     $result = mysqli_query($con, $query);
    
//     // check the selected rows count and if the count if > 0  
//     if(mysqli_num_rows($result) > 0) {
//         // Iterate over the result and prepare the tr like mentioned below:
//         while($row = mysqli_fetch_assoc($result)) {
//            // Example response array, replace with your actual response array
//             $response = array('1-10' => $row['1-10'], '11-20' => $row['11-20'], '21-30' => $row['21-30'], '31-40' => $row['31-40'], '41-50' => $row['41-50'], '51-60' => $row['51-60'], '61-70' => $row['61-70'], '71-80' => $row['71-80'], '81-90' => $row['81-90'], '91-100' => $row['91-100'], 'a0-a9' => $row['a0-a9'], 'b0-b9' => $row['b0-b9'], 'total_bet' => $row['total_bet']);
//             echo json_encode($response);
//         }
//     } else {
//         $response = array('1-10' => '0', '11-20' => '0', '21-30' => '0', '31-40' => '0', '41-50' => '0', '51-60' => '0', '61-70' => '0', '71-80' => '0', '81-90' => '0', '91-100' => '0', 'a0-a9' => '0', 'b0-b9' => '0', 'total_bet' => '0');
//         echo json_encode($response);
//     }
//     exit; // Stop further execution
// }
?>
