<?php
# The database connection file.
if (require_once('connection.php')) {
    // echo "connection successful";
} else {
    echo "connection failed. connection file not found.";
}
# error array.
$error = array();

if (isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['user_name'] = $_COOKIE['user_name'];
    header("location: index.php");
    exit();
}

# check the login button is clicked or not.
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
    # Declare the variables to store the form data.
    $name = $_POST['name'];
    $password = $_POST['password'];
    # Check the form data is empty or not.
    if ($name == "") {
        $error[1] = "Please enter the username.";
    }
    if ($password == "") {
        $error[2] = "Please enter the password.";
    }
    # Check the login credentials found in the users table.
    # Convert the password into md5 formate.
    $md_password = md5($password);
    if ($name != "" && $md_password != "") {
        // Prepare the SQL query with placeholders
        $query = "SELECT * FROM `users` WHERE user_username=? AND `user_password`=?";

        // Create a prepared statement
        $stmt = $con->prepare($query);

        // Bind the parameters
        $stmt->bind_param("ss", $name, $md_password);

        // Execute the statement
        $stmt->execute();

        // Fetch the result if needed
        $result = $stmt->get_result();

        // Process the result as required
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_status'] = $row['user_status'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['user_name'] = $row['user_name'];
            // check the login user type
            if(strtolower($_SESSION['user_type']) == 'admin'){
                // fetch all the user_id created by the admin
                $stmt = $con->prepare("SELECT user_id FROM users WHERE user_created_by = ?");
                $stmt->bind_param("s", $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $user_id = array();
                while($row1 = $result->fetch_assoc()){
                    $user_id[] = $row1['user_id'];
                }
                $stmt->close();
                $_SESSION['all_user_id'] = $_SESSION['user_id'].",".implode(",",$user_id);
            }else if(strtolower($_SESSION['user_type']) == 'user'){
                $user_id = $_SESSION['user_id'];
                $_SESSION['all_user_id'] = $user_id;
            }else if(strtolower($_SESSION['user_type']) == 'manager'){
                // fetch the id of the user who created the user
                $stmt = $con->prepare("SELECT user_created_by FROM users WHERE user_id = ?");
                $stmt->bind_param("s", $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row1 = $result->fetch_assoc();
                $admin_user_id = $row1['user_created_by'];
            
                // fetch all the user_id created by the admin
                $stmt = $con->prepare("SELECT user_id FROM users WHERE user_created_by = ?");
                $stmt->bind_param("s", $admin_user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $user_id = array();
                while($row1 = $result->fetch_assoc()){
                    $user_id[] = $row1['user_id'];
                }
                $stmt->close();
                $_SESSION['all_user_id'] = implode(",",$user_id);
            }
            if (strtolower($row['user_status']) == 'active') {
                // Set a cookie for 24 hours
                setcookie("user_id", $row['user_id'], time() + (86400), "/"); // 86400 = 1 day
                setcookie("user_name", $row['user_name'], time() + (86400), "/");

                header("location: index.php");
            } else {
                $error[3] = "Your account is not activated yet. Please ask to active the account to Admin.";
            }
        } else {
            $error[3] = "Please enter a valid username and password.";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="assets/images/ms_chat_photo_3.ico">
    <link rel="stylesheet" href="assets/css/login_page.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Welcome to MS Chat!</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(assets/images/login_side_pic.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                            </div>
                            <form action="#" class="signin-form" method="post">
                                <font color="#f00000" size="2px"><?php if (isset($error[3])) {
                                                                        echo $error[3];
                                                                    } ?></font>
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username</label>
                                    <input type="text" name="name" class="form-control" value="<?php if (isset($name)) {
                                                                                                    echo $name;
                                                                                                } ?>" id="username" placeholder="Enter username" autocomplete="off">
                                </div>
                                <font color="#f00000" size="2px"><?php if (isset($error[1])) {
                                                                        echo $error[1];
                                                                    } ?></font>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" value="" id="userpassword" placeholder="Enter password" autocomplete="off">
                                </div>
                                <font color="#f00000" size="2px"><?php if (isset($error[2])) {
                                                                        echo $error[2];
                                                                    } ?></font>
                                <div class="form-group">
                                    <button value="submit" name="submit" type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v55bfa2fee65d44688e90c00735ed189a1713218998793" integrity="sha512-FIKRFRxgD20moAo96hkZQy/5QojZDAbyx0mQ17jEGHCJc/vi0G2HXLtofwD7Q3NmivvP9at5EVgbRqOaOQb+Rg==" data-cf-beacon='{"rayId":"876f7113f92b33ae","version":"2024.3.0","token":"cd0b4b3a733644fc843ef0b185f98241"}' crossorigin="anonymous"></script>
</body>

</html>