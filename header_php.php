<?php
# The database connection file.
if (require_once('connection.php')) {
    // echo "connection successful";
} else {
    echo "connection failed. connection file not found.";
}

# Date 
date_default_timezone_set('Europe/London');
$date = date('Y-m-d');


# Check if the user is logged into the system or not.
if ($_SESSION['user_id'] == "") {
    header("location: login.php");
}

# Get the current script name
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>MS CHAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Skote is a fully featured premium admin dashboard template built on top of awesome Bootstrap 4.4.1" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/ms_chat_photo_3.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script type="text/javascript" src="./assets/js/jquery.validate.js"></script>
    <script type="text/javascript" src="./assets/js/validation.js"></script>

    <script src="assets/js/app.js"></script>
</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div>
                <nav class="navbar-header navbar-expand-lg" style="background-color: #f1b44c;">
                    <button class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="20" style="height: 45px;">
                    </button>
                    <ul class="navbar-nav mr-auto mt-3 mt-lg-0">
                        <?php if (isset($_SESSION['user_type']) && strtolower($_SESSION['user_type']) == 'admin') { ?>
                            <li class="nav-item <?php echo ($current_page == 'user_controller.php') ? 'active' : ''; ?>">
                                <a class="nav-link" href="user_controller.php" style="font-size: 20px;">User <span class="sr-only">(current)</span></a>
                            </li>
                        <?php } ?>
                        <li class="nav-item <?php echo ($current_page == 'party_controller.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="party_controller.php" style="font-size: 20px;">Party</a>
                        </li>
                        <li class="nav-item <?php echo ($current_page == 'game_controller.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="game_controller.php" style="font-size: 20px;">Game</a>
                        </li>
                        <li class="nav-item <?php echo ($current_page == 'coupon_controller.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="coupon_controller.php" style="font-size: 20px;">Coupon</a>
                        </li>
                        <li class="nav-item <?php echo ($current_page == 'game_history_controller.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="game_history_controller.php" style="font-size: 20px;">History</a>
                        </li>
                    </ul>
                    <div class="navbar-text" style="margin-top: 15px">
                        <p class="navbar-text" style="padding-right: 20px;">Welcome, <?php if (isset($_SESSION['user_name'])) {
                                                                                            echo $_SESSION['user_name'];
                                                                                        } ?>!</p>
                        <a href="logout.php" class="btn btn-outline-danger" style="background-color: red; color: white;">Logout</a>
                    </div>
                </nav>
            </div>
        </header>