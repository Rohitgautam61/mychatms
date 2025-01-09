<?php 
require_once('connection.php');
require_once('constant.php');

if (isset($_GET['action']) && $_GET['action'] == 'game_details') {
    // Fetch Draw Number and Date Added based on the selected Game ID
    $game_id = mysqli_real_escape_string($con, $_GET['game_id']); // Prevent SQL Injection

    // Example query, replace with your actual query to fetch Draw Number and Date Added
    $query = "SELECT g_draw, g_date_added FROM games WHERE g_id = $game_id";
    
    // Execute query and fetch results
    $result = mysqli_query($con, $query);
    
    // Check if the query was successful and if we have results
    if ($result && mysqli_num_rows($result) > 0) {
        $game = mysqli_fetch_assoc($result);
        
        // Send game details as JSON response
        $response = array(
            'draw' => $game['g_draw'], 
            'date_added' => $game['g_date_added']
        );
        echo json_encode($response);
        exit;
    } else {
        // Handle case where no data is found for the selected game
        $response = array('error' => 'No data found for the selected game.');
        echo json_encode($response);
        exit;
    }
}


// Handling AJAX request for fetching the party list
if (isset($_GET['action']) && $_GET['action'] == 'party_list') {
    // Fetch party list based on the user ID
    $user_id = $_SESSION['user_id']; // Assuming the session is already started and user is logged in
    $fetch_party = $_GET['fetch_party'];
    if($fetch_party == 'all'){
        // $condition = 'WHERE u_id IN ('.$_SESSION['all_user_id'].')';
    }else{
        $condition = "WHERE u_id = $user_id";
    }
    $party_dp_query = "SELECT `p_id`, `p_name` FROM `parties` ".$condition;
    
    // Execute the query
    $party_result = mysqli_query($con, $party_dp_query);
    
    if ($party_result && mysqli_num_rows($party_result) > 0) {
        // Fetch and output options for the select dropdown
        $party_list = '<option class="font"></option>';
        while ($party = mysqli_fetch_assoc($party_result)) {
            $party_list .=  '<option class="font" name="party" value="' . $party['p_id'] . '">' . $party['p_name'] . '</option>';
        }
        echo $party_list;
    } else {
        // No parties found, return a default option
        echo '<option value="">No Parties Found</option>';
    }
    
    exit; // Terminate the script after outputting the options
}

// Handling AJAX request for fetching party details
if (isset($_GET['action']) && $_GET['action'] == "party_details") {
    $party_id = $_GET['party_id'];
    $game_id = $_GET['game_id'];
    $user_id = $_GET['user_id'];
    $date = $_GET['date'];

    // Fetch party details
    $party_details = fetch_party_details($party_id, $con);

    // Fetch party bet sum
    $bet_sum = json_decode(get_party_bet_sum($party_id, $user_id, $date, $game_id, $con), true);

    // Handle errors if any
    if (isset($party_details['error'])) {
        $response = array('error' => "Error fetching party details: " . $party_details['error']);
        echo json_encode($response);
        exit;
    }

    if (isset($bet_sum['error'])) {
        $response = array('error' => "Error fetching bet sum: " . $bet_sum['error']);
        echo json_encode($response);
        exit;
    }

    // If no errors, combine responses
    $response = array_merge($party_details, $bet_sum);
    echo json_encode($response);
    exit;
} 

// Action to search party list
if ($_GET['action'] == 'party_search' && isset($_GET['term'])) {
    $term = $_GET['term'];
    $user_id = $_SESSION['user_id'];  // Assuming user is logged in
    $fetch_party = $_GET['fetch_party'];
    if($fetch_party == 'all'){
        $condition = '';
    }else{
        $condition = " AND u_id = $user_id";
    }
    
    // SQL query to fetch matching parties
    $query = "SELECT p_id, p_name FROM parties WHERE p_name LIKE '$term%'".$condition;
    $result = mysqli_query($con, $query);

    $parties = [];
    if (mysqli_num_rows($result) > 0) {
        while ($party = mysqli_fetch_assoc($result)) {
            $parties[] = [
                'p_id' => $party['p_id'],
                'p_name' => $party['p_name']
            ];
        }
    }

    // Return results as JSON
    echo json_encode($parties);
    exit;
}

