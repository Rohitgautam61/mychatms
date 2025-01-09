<?php
ob_start(); // Start output buffering
require_once('connection.php');
require_once('constant.php');
#variable declaration
$p_name = "";
$p_phone = "";
$p_commission = "";
$p_a0to9 = "";
$p_b0to9 = "";
$p_1to100 = "";
$p_pati = "";
$p_refer_pati = "";
$p_refer_party = "";
$p_limit = "";
$p_status = "";
$sheet ="";

# fetch party from parties table
# fetch party from parties table
if(isset($_SESSION['user_type']) && strtolower($_SESSION['user_type']) == 'admin' || strtolower($_SESSION['user_type']) == 'manager'){
    # Query for fetching the data for admin
    /*SELECT
        p.`p_id`,
        p.`p_name`,
        p.`p_number`,
        p.`p_pay_commission`,
        p.`p_a0_to_a9`,
        p.`p_b0_to_b9`,
        p.`p_1_to_100`,
        p.`p_pati`,
        p.`p_referred_party`,
        p.`p_referred_pati`,
        p.`p_limit`,
        p.`p_status`,
        p.`u_id`,
        p.`created_at`,
        p.`modified_at`,
        p.sheet
    FROM
        users u1
    INNER JOIN users u2 ON
        u1.user_id = u2.user_created_by
    INNER JOIN parties p ON
        u2.user_id = p.u_id
    WHERE
        u1.user_id = '1';
     */
    $p_query = "SELECT p.`p_id`, p.`p_name`, p.`p_number`, p.`p_pay_commission`, p.`p_a0_to_a9`, p.`p_b0_to_b9`, p.`p_1_to_100`, p.`p_pati`, p.`p_referred_party`, p.`p_referred_pati`, p.`p_limit`, p.`p_status`, p.`u_id`, p.`created_at`, p.`modified_at`,p.`sheet` FROM users u1 INNER JOIN users u2 ON u1.user_id = u2.user_created_by INNER JOIN parties p ON u2.user_id = p.u_id WHERE u2.user_id IN (".$_SESSION['all_user_id'].")";
    // $p_query = "SELECT p.`p_id`, p.`p_name`, p.`p_number`, p.`p_pay_commission`, p.`p_a0_to_a9`, p.`p_b0_to_b9`, p.`p_1_to_100`, p.`p_pati`, p.`p_referred_party`, p.`p_referred_pati`, p.`p_limit`, p.`p_status`, p.`u_id`, p.`created_at`, p.`modified_at`, p.sheet FROM parties p WHERE p.u_id IN (SELECT user_id FROM users u WHERE user_created_by = ( SELECT user_created_by FROM users u WHERE user_id = '".$_SESSION['user_id']."'))";
    $party_dp_query = "SELECT p.`p_id`, p.`p_name` FROM users u1 INNER JOIN users u2 ON u1.user_id = u2.user_created_by INNER JOIN parties p ON u2.user_id = p.u_id WHERE u1.user_id = '".$_SESSION['user_id']."'";
}else{
    # Query for fetching the data for admin
    /*SELECT
        p.`p_id`,
        p.`p_name`,
        p.`p_number`,
        p.`p_pay_commission`,
        p.`p_a0_to_a9`,
        p.`p_b0_to_b9`,
        p.`p_1_to_100`,
        p.`p_pati`,
        p.`p_referred_party`,
        p.`p_referred_pati`,
        p.`p_limit`,
        p.`p_status`,
        p.`u_id`,
        p.`created_at`,
        p.`modified_at`,
        p.sheet
    FROM
       parties p 
    WHERE
        p.u_id = '1';
    */
    $p_query = "SELECT p.`p_id`, p.`p_name`, p.`p_number`, p.`p_pay_commission`, p.`p_a0_to_a9`, p.`p_b0_to_b9`, p.`p_1_to_100`, p.`p_pati`, p.`p_referred_party`, p.`p_referred_pati`, p.`p_limit`, p.`p_status`, p.`u_id`, p.`created_at`, p.`modified_at`,p.`sheet` FROM parties p WHERE p.u_id = '".$_SESSION['user_id']."'";
    $party_dp_query = "SELECT `p_id`, `p_name` FROM `parties` WHERE `u_id` = '".$_SESSION['user_id']."' AND `p_status` = 'active'";
}

$p_result = mysqli_query($con, $p_query);
$party_result = mysqli_query($con, $party_dp_query);

if($p_result){
    // data has fetched successfully.
}else{
    $error['0'] = 'No Party Found!';
}


#code to handle the form data at the time of new party creation.
if((isset($_GET['action']) && $_GET['action'] == 'add') || (isset($_GET['action']) && $_GET['action'] == 'update')){
#variable declaration
$p_name = $_GET['p_name'];
$p_phone = $_GET['p_phone'];
$p_commission = $_GET['p_commission'];
$p_a0to9 = $_GET['p_a0to9'];
$p_b0to9 = $_GET['p_b0to9'];
$p_1to100 = $_GET['p_1to100'];
$p_pati = $_GET['p_pati'];
$p_refer_pati = $_GET['p_referred_pati'];
$p_refer_party = $_GET['p_referred_party'];
$p_limit = $_GET['p_limit'];
$p_status = $_GET['p_status'];
$sheet = $_GET['sheet'];

#Validate the data
if (!empty_check($p_name)) {
    $response['error'] = 'Please enter party name';
    echo json_encode($response);
    die;
}

// add the code to check the party id existence
if($_GET['action'] != 'update'){
    $party_id_query = "SELECT `p_id` FROM `parties` WHERE `p_name` = '".$p_name."'";
    $party_id_result = mysqli_query($con, $party_id_query);
    if($party_id_result){
        $party_id = mysqli_fetch_assoc($party_id_result);
        if(isset($party_id['p_id']) && $party_id['p_id'] != ''){
            $response['error'] = 'Party name already exists.';
            echo json_encode($response);
            die;
        }
    }
}else{
    $party_id_query = "SELECT `p_name` FROM `parties` WHERE `p_id` = '".$_GET['p_id']."'";
    $party_id_result = mysqli_query($con, $party_id_query);
    if($party_id_result){
        $party_id = mysqli_fetch_assoc($party_id_result);
        if(isset($party_id['p_name']) && $party_id['p_name'] != $p_name){
            $response['error'] = 'You can not update party name.';
            echo json_encode($response);
            die;
        }
    }
    
}

if (!empty_check($p_commission)) {
    $p_commission = 0;
}


if (!empty_check($p_phone)) {
    $p_phone = 0;
}

if (!empty_check($p_a0to9)) {
    $response['error'] = 'Please enter A0 to A9 value';
    echo json_encode($response);
}

if (!empty_check($p_b0to9)) {
    $response['error'] = 'Please enter B0 to B9 value';
    echo json_encode($response);
}

if (!empty_check($p_status)) {
    $response['error'] = 'Please select status';
    echo json_encode($response);
}

if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['p_id']) && $_GET['p_id'] != ''){
    #code to update the p
    $p_id = $_GET['p_id'];
    /*
    UPDATE `parties` 
        SET 
            `p_name` = 'Updated Party Name', 
            `p_number` = '1234567890', 
            `p_pay_commission` = '500', 
            `p_a0_to_a9` = '100', 
            `p_b0_to_b9` = '200', 
            `p_1_to_100` = '300', 
            `p_pati` = '400', 
            `p_referred_party` = 'Referred Party Name', 
            `p_referred_pati` = 'Referred Pati Value', 
            `p_limit` = '1000', 
            `p_status` = 'Active', 
            `u_id` = '123', 
            `modified_at` = CURRENT_TIMESTAMP,
            `sheet` = 'yes'
        WHERE 
            `p_id` = '1';
     */
    $update_p_query = "UPDATE `parties` SET`p_name` = '".$p_name."',`p_number` = '".$p_phone."',`p_pay_commission` = '".$p_commission."',`p_a0_to_a9` = '".$p_a0to9."',`p_b0_to_b9` = '".$p_b0to9."',`p_1_to_100` = '".$p_1to100."',`p_pati` = '".$p_pati."',`p_referred_party` = '".$p_refer_party."',`p_referred_pati` = '".$p_refer_pati."',`p_limit` = '".$p_limit."',`p_status` = '".$p_status."',`modified_at` = '$datetime', `sheet` = '".$sheet."' WHERE`p_id` = '".$p_id."'";
    $update_p_result = mysqli_query($con, $update_p_query);
    if($update_p_result){
        $response['success'] = "Party Updated Successfully.";
        echo json_encode($response);
        die;
    }else{
        $response['error'] = "Error in updating the party.";
        echo json_encode($response);
        die;
    }
}else{
    #code to add the new party
    /*INSERT INTO `parties`(
                        `p_id`,
                        `p_name`,
                        `p_number`,
                        `p_pay_commission`,
                        `p_a0_to_a9`,
                        `p_b0_to_b9`,
                        `p_1_to_100`,
                        `p_pati`,
                        `p_referred_party`,
                        `p_referred_pati`,
                        `p_limit`,
                        `p_status`,
                        `u_id`,
                        `created_at`,
                        `modified_at`,
                        `sheet`
                    )
                    VALUES(
                        NULL,
                        'MP',
                        '1234567891',
                        '10',
                        '9',
                        '9',
                        '90',
                        '10',
                        '1',
                        '10',
                        '10000',
                        'active',
                        '1',
                        CURRENT_TIMESTAMP,
                        CURRENT_TIMESTAMP,
                        'yes'
                    );
                */
    $add_p_query = "INSERT INTO `parties` (`p_name`, `p_number`, `p_pay_commission`, `p_a0_to_a9`, `p_b0_to_b9`, `p_1_to_100`, `p_pati`, `p_referred_party`, `p_referred_pati`, `p_limit`, `p_status`, `u_id`, `created_at`, `modified_at`,`sheet`) VALUES ( '".$p_name."', '".$p_phone."', '".$p_commission."', '".$p_a0to9."', '".$p_b0to9."', '".$p_1to100."', '".$p_pati."', '".$p_refer_party."', '".$p_refer_pati."', '".$p_limit."', '".$p_status."', '".$_SESSION['user_id']."', '$datetime', '$datetime','".$sheet."');";
    $add_p_result = mysqli_query($con, $add_p_query);
    if($add_p_result){
        $response['success'] = "Party Created Successfully.";
        echo json_encode($response);
        die;
    }else{
        $response['error'] = "Error in creating the party.";
        echo json_encode($response);
        die;
    }
}    
}
#code to delete the p
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['p_id']) && $_GET['p_id'] != ''){
    $p_id = $_GET['p_id'];
    $delete_party_query = "DELETE FROM `parties` WHERE `p_id` = $p_id";
    $delete_party_result = mysqli_query($con, $delete_party_query);
    if($delete_party_result){
        $response['success'] = "Party deleted Successfully.";
        echo json_encode($response);
        die;
    }else{
        $response['error'] = "Error in deleting the party.";
        echo json_encode($response);
        die;
    }
}
#code to edit the p
if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['p_id']) && $_GET['p_id'] != ''){
    $p_id = $_GET['p_id'];
    $edit_p_query = "SELECT * FROM `parties` WHERE `p_id` = $p_id";
    $edit_p_result = mysqli_query($con, $edit_p_query);
    if($edit_p_result){
        $edit_p = mysqli_fetch_assoc($edit_p_result);
        $p_name = $edit_p['p_name'];
        $p_phone = $edit_p['p_number'];
        $p_commission = $edit_p['p_pay_commission'];
        $p_a0to9 = $edit_p['p_a0_to_a9'];
        $p_b0to9 = $edit_p['p_b0_to_b9'];
        $p_1to100 = $edit_p['p_1_to_100'];
        $p_pati = $edit_p['p_pati'];
        $p_refer_pati = $edit_p['p_referred_pati'];
        $p_refer_party = $edit_p['p_referred_party'];
        $p_limit = $edit_p['p_limit'];
        $p_status = $edit_p['p_status'];
        $sheet = $edit_p['sheet'];
    }else{
        $error['0'] = 'Not able to fetch the party data!';
    }
}
ob_end_flush(); // End output buffering and flush the buffer
$con->close();
?>