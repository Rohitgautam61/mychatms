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
        $g_query = "SELECT g.g_id, g.g_date_added, g.g_name, g.g_draw, g.g_status, g.g_declare_number, g.modified_at, u.user_name, g.u_id FROM users u INNER JOIN games g ON u.user_id = g.u_id WHERE g.u_id IN (".$_SESSION['all_user_id'].") AND g.g_status != 'declare'";
        // $g_query = "SELECT g.g_id, g.g_date_added, g.g_name, g.g_draw, g.g_status, g.g_declare_number, g.modified_at FROM games g WHERE g.u_id IN (".$_SESSION['all_user_id'].") AND g.g_status != 'declare'";
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
        $g_query = "SELECT g.g_id, g.g_date_added, g.g_name, g.g_draw, g.g_status, g.g_declare_number, g.modified_at, g.u_id FROM games g WHERE g.u_id = '".$_SESSION['user_id']."' AND g.g_status != 'declare'";
    }
    $g_result = mysqli_query($con, $g_query);
    
    if($g_result){
        // data has fetched successfully.
    }else{
        $game = 'No Game Found!';
    }


#code to handle the form data at the time of new p creation.
if ((isset($_GET['action']) && $_GET['action'] == 'add') || (isset($_GET['action']) && $_GET['action'] == 'update')) {   
    #variable declaration
    $g_date_added = "";
    $g_name = "";
    $g_draw = "";
    $g_status = "";
    $g_declare_number = "";
    $u_id = "";

    $g_date_added = $_GET['date'];
    $g_name = $_GET['g_name'];
    $g_draw = $_GET['g_draw'];
    $g_status = $_GET['status'];
    $g_declare_number = $_GET['g_declare_number'];
    $u_id = $_SESSION['user_id'];


    #Validate the data
    if (!empty_check($g_date_added)) {
        $response['error'] = 'Please Select Game Date.';
        echo json_encode($response);
        die;
    }

    if (!empty_check($g_name)) {
        $response['error'] = 'Please Enter Game Name.';
        echo json_encode($response);
        die;
    }

    if (!empty_check($g_draw)) {
        $response['error'] = 'Please Enter Draw Number.';
        echo json_encode($response);
        die;
    }

    if (!empty_check($g_status)) {
        $response['error'] = 'Please Enter Select Status of Game.';
        echo json_encode($response);
        die;
    }

    if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['g_id']) && $_GET['g_id'] != '') {

        #code to update the game
        $g_id = $_GET['g_id'];
        $update_p_query = "UPDATE games SET g_date_added = '" . $g_date_added . "',g_name = '" . $g_name . "',g_draw = '" . $g_draw . "',g_status = '" . $g_status . "',g_declare_number = '" . $g_declare_number . "',modified_at = '$datetime' WHERE g_id =" . $g_id;
        $update_p_result = mysqli_query($con, $update_p_query);
        if ($update_p_result) {
            $response['success'] = "Game Updated Successfully.";
            echo json_encode($response);
            die;
        } else {
            $response['error'] = "Error in updating the game.";
            echo json_encode($response);
            die;
        }
    } else {
         // check the game name is already exist with same draw number
        $check_g_query = "SELECT * FROM `games` WHERE `g_name` = '".$g_name."' AND `g_draw` = '".$g_draw."' AND `u_id` = '".$u_id."' AND `g_date_added` = '".$g_date_added."'";
        $check_g_result = mysqli_query($con, $check_g_query);
        if($check_g_result){
            if(mysqli_num_rows($check_g_result) > 0){
                $response['error'] = 'Game Name already exist with Same Draw Number.';
                echo json_encode($response);
                die;
            }
        }
        #code to add the new party
        /*INSERT INTO `games`(
                        `g_id`,
                        `g_date_added`,
                        `g_name`,
                        `g_draw`,
                        `g_status`,
                        `g_declare_number`,
                        `u_id`,
                        `created_at`,
                        `modified_at`
                    )
                    VALUES(
                        NULL,
                        '2024-05-04',
                        'GZB',
                        '2',
                        'undeclare',
                        NULL,
                        NULL,
                        CURRENT_TIMESTAMP,
                        CURRENT_TIMESTAMP
                    );
                    */
        $g_declare_number = isset($g_declare_number) && $g_declare_number != ""  ? $g_declare_number : 'NULL';
        $add_g_query = "INSERT INTO `games` ( `g_date_added`, `g_name`, `g_draw`, `g_status`, `g_declare_number`, `u_id`, `created_at`, `modified_at`) VALUES ( '" . $g_date_added . "', '" . $g_name . "', '" . $g_draw . "', '" . $g_status . "',$g_declare_number, '" . $u_id . "', '$datetime', '$datetime');";
        $add_g_result = mysqli_query($con, $add_g_query);
        if ($add_g_result) {
            $response['success'] = "Game Created Successfully.";
            echo json_encode($response);
            die;
        } else {
            $response['error'] = "Error in creating the game.";
            echo json_encode($response);
            die;
        }
    }
    die;
}

#code to delete the Game
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['g_id']) && $_GET['g_id'] != '') {
    $g_id = $_GET['g_id'];
    $delete_game_query = "DELETE FROM `games` WHERE `g_id` = $g_id";
    $delete_game_result = mysqli_query($con, $delete_game_query);
    if ($delete_game_result) {
        # Redirect to the p list page
        header('Location: game_controller.php');
        die;
    } else {
        $error[5] = "Error in deleting game.";
    }
}

#code to edit the Game
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['g_id']) && $_GET['g_id'] != '') {
    $g_id = $_GET['g_id'];
    $edit_g_query = "SELECT * FROM `games` WHERE `g_id` = $g_id LIMIT 1";
    $edit_g_result = mysqli_query($con, $edit_g_query);
    if ($edit_g_result) {
        $edit_g = mysqli_fetch_assoc($edit_g_result);
        $response['g_date_added'] = $edit_g['g_date_added'];
        $response['g_name'] = $edit_g['g_name'];
        $response['g_draw'] = $edit_g['g_draw'];
        $response['g_status'] = $edit_g['g_status'];
        $response['g_declare_number'] = $edit_g['g_declare_number'];
    } else {
        $response['error'] = "Error in feting game details.";
    }
    echo json_encode($response);
    die;
}
ob_end_flush(); // End output buffering and flush the buffer
$con->close();
?>