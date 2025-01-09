<?php
ob_start(); // Start output buffering
require_once('connection.php');

# Variable declaration
$user_name = "";
$user_username = "";
$user_password = "";
$role = "";
$user_status = "";
$user_added_by = "";

# fetch data from users table
// Query:
/*SELECT
    u1.user_id,
    u1.user_name,
    u1.user_username,
    u1.user_status,
    u1.user_type,
    u2.user_name AS user_created_by
FROM
    users u1
LEFT JOIN users u2 ON
    u1.user_created_by = u2.user_id
*/
$user_query = "SELECT u1.user_id,u1.user_name,u1.user_username,u1.user_status,u1.user_type,u2.user_name as user_created_by FROM users u1 LEFT JOIN users u2 ON u1.user_created_by = u2.user_id WHERE u1.user_id != '1'";
$user_result = mysqli_query($con, $user_query);

if ($user_result) {
    // data has fetched successfully.
} else {
    $user_not_found_error = 'No User Found!';
}

$error = array();

#code to handle the form data at the time of new user creation.
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
    #variable declaration
    $user_name = $_POST['user_name'];
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $role = $_POST['role'];
    $user_status = $_POST['status'];
    $user_added_by = $_SESSION['user_id'];

    #Validate username before adding in the database.
    # Query to fetch the user by user name
    $fetch_user_query = 'SELECT * FROM `users` WHERE `user_username` = "' . $user_username . '";';
    $fetch_user_result = mysqli_query($con, $fetch_user_query);

    #Validate the data
    if (!empty_check($user_name)) {
        $error[1] = 'Please enter user name';
    }

    if (!empty_check($user_username)) {
        $error[2] = 'Please enter username';
    }

    if (!empty_check($user_password)) {
        $error[3] = 'Please enter password';
    }

    if (!empty_check($role)) {
        $error[4] = 'Please enter select the role';
    }

    if (!empty_check($user_status)) {
        $error[5] = 'Please select the account status';
    }

    if (empty($error)) {
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['u_id']) && $_GET['u_id'] != '') {
            #code to update the user
            $user_id = $_GET['u_id'];
            $update_user_query = "UPDATE users SET user_name = '" . $user_name . "', user_username = '" . $user_username . "', user_password = '" . md5($_POST['user_password']) . "',user_status = '" . $user_status . "', user_type = '" . $role . "', user_modified_date = CURRENT_TIMESTAMP WHERE user_id =" . $user_id;
            $update_user_result = mysqli_query($con, $update_user_query);
            if ($update_user_result) {
                header('Location: user_controller.php');
            } else {
                $error[6] = 'System unable to update the user';
            }
        } else {
            // validate unique username.
            if (mysqli_num_rows($fetch_user_result) > 0) {
                $error[2] = 'This username already exists in the system. Please change the username';
            }
            if (empty($error)) {
                #code to add the new user
                #code to add the new party
                /*INSERT INTO `users`(
                        `user_name`,
                        `user_username`,
                        `user_type`,
                        `user_password`,
                        `user_status`,
                        `user_created_by`,
                        `user_added_date`,
                        `user_modified_date`
                    )
                    VALUES(
                        'Admin1',
                        'admin1',
                        'Manager',
                        'admin\r\n',
                        'Active',
                        '1',
                        CURRENT_TIMESTAMP,
                        '2024-05-20 18:17:02.000000'
                    );
                */
                $add_user_query = "INSERT INTO `users` ( `user_name`, `user_username`, `user_type`, `user_password`, `user_status`, `user_created_by`, `user_added_date`, `user_modified_date`) VALUES ( '" . $user_name . "', '" . $user_username . "', '" . $role . "', '" . md5($_POST['user_password']) . "', '" . $user_status . "', '" . $user_added_by . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
                $add_user_result = mysqli_query($con, $add_user_query);
                if ($add_user_result) {
                    header('Location: user_controller.php');
                } else {
                    $error[6] = 'System unable to add the user';
                }
            }
        }
    }
}

#code to delete the User
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['u_id']) && $_GET['u_id'] != '') {
    $user_id = $_GET['u_id'];
    $delete_user_query = "DELETE FROM `users` WHERE `user_id` = $user_id";
    $delete_user_result = mysqli_query($con, $delete_user_query);
    if ($delete_user_result) {
        # Redirect to the user list page
        header('Location: user_controller.php');
        die;
    } else {
        $error[6] = 'System unable to delete the user';
    }
}

#code to edit the User
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['u_id']) && $_GET['u_id'] != '') {
    $user_id = $_GET['u_id'];
    $edit_user_query = "SELECT * FROM `users` WHERE `user_id` = $user_id";
    $edit_user_result = mysqli_query($con, $edit_user_query);
    if ($edit_user_result) {
        $edit_user = mysqli_fetch_assoc($edit_user_result);
        $user_name = $edit_user['user_name'];
        $user_username = $edit_user['user_username'];
        $role = $edit_user['user_type'];
        $user_status = $edit_user['user_status'];
    } else {
        $error[6] = 'System unable to fetch the user data from database';
    }
}
ob_end_flush(); // End output buffering and flush the buffer
$con->close();