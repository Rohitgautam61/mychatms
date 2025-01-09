<?php 
require_once('connection.php');
require_once('constant.php');

if (isset($_GET['action']) && $_GET['action'] == 'fetch_game_draw_data') {
    // Fetch game draw data based on the selected Game ID
    $game_id = $_GET['game_id'];
    $date = $_GET['date']; // Assuming today's date, adjust if necessary
    $user_id = $_SESSION['user_id']; // Assuming the session is already started and user is logged in
    
    // Example query, replace with your actual query to fetch game draw data
    $query = "
        SELECT crd.p_id,p.p_name,p.sheet, g.g_name, g.g_draw, SUM(crd.bet_total) AS total_bet
        FROM coupon_row_data crd
        INNER JOIN parties p ON p.p_id = crd.p_id
        INNER JOIN games g ON g.g_id = crd.g_id
        WHERE crd.g_id = '$game_id' AND crd.date = '$date'
        GROUP BY crd.p_id
        ORDER BY crd.created_at ASC
    ";
    try{
        $result = mysqli_query($con, $query);
    }catch(Exception $e){
        echo $e->getMessage();
    }
    
    // Check the selected rows count and if the count is > 0  
    if (mysqli_num_rows($result) > 0) {
        // Initialize $i
        $i = 1;
        // Iterate over the result and prepare the tr like mentioned below:
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['sheet'] == 'yes'){
                $color = 'style="background-color: #ffc107;"';
            }else{
                $color = '';
            }
            echo '<tr>';
            echo '<td>' . $i++ . '</td>'; // Increment $i for each row
            echo '<td '.$color.'>' . $row['p_name'] . '</td>';
            echo '<td '.$color.'>' . $row['g_name'] . '</td>';
            $last_modified = fetch_last_bet($row['p_id'], $user_id, $game_id, $date,$con);
            echo '<td '.$color.'>'. $last_modified .'</td>';
            echo '<td '.$color.'>' . $row['g_draw'] . '</td>';
            echo '<td '.$color.'>' . $row['total_bet'] . '</td>';
            echo '<td '.$color.'>';
            echo '<a href="#" class="text-danger"><img style="height: 18px;" src="assets/images/sheet.gif" onclick=create_sheet('.$row['p_id'].')></a>';
            echo ' || ';
            echo '<a href="#" class="text-danger"><img style="height: 18px;" src="assets/images/delete.gif" onclick=delete_party_work('.$row['p_id'].')></a>';
            echo '</td>';
            echo '</tr>';        }
    } else {
        echo '<b>No entry found.</b>';
    }
    exit; // Stop further execution
}

if (isset($_GET['action']) && $_GET['action'] == 'delete_party_work') {
    // Get the parameters
    $game_id = mysqli_real_escape_string($con, $_GET['game_id']);
    $date = mysqli_real_escape_string($con, $_GET['date']);
    $party_id = mysqli_real_escape_string($con, $_GET['party_id']);

    // Check for missing parameters
    if (empty($game_id) || empty($date) || empty($party_id)) {
        echo json_encode(['error' => 'Missing parameters.']);
        exit;
    }

    // SQL query to delete from coupon_bet_data
    $delete_bet_data_query = "DELETE FROM coupon_bet_data WHERE g_id = '$game_id' AND date = '$date' AND p_id = '$party_id'";
    
    // Execute the query
    $delete_bet_data_result = mysqli_query($con, $delete_bet_data_query);

    // Check if the deletion was successful in coupon_bet_data
    if (!$delete_bet_data_result) {
        echo json_encode(['error' => 'Error deleting data from coupon_bet_data.']);
        exit;
    }

    // SQL query to delete from coupon_bet_sum
    $delete_bet_row_data_query = "DELETE FROM coupon_row_data WHERE g_id = '$game_id' AND date = '$date' AND p_id = '$party_id'";
    
    // Execute the query
    $delete_bet_row_data_result = mysqli_query($con, $delete_bet_row_data_query);

    // Check if the deletion was successful in coupon_bet_sum
    if (!$delete_bet_row_data_result) {
        echo json_encode(['error' => 'Error deleting data from coupon_bet_sum.']);
        exit;
    }

    // If both deletions are successful, return a success response
    echo json_encode(['success' => 'Party work deleted successfully.']);
    exit;
} 