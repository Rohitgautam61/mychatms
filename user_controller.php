<?php
include('header_php.php');
require_once('constant.php');
require_once('user_crud.php');
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">User Control</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Add/Edit User</h5>
                            <form class="" id="user_form" method="post">
                                <font color="#f00000" size="2px"><?php if (isset($error[6])) {
                                                                        echo $error[6];
                                                                    } ?></font>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        <label for="user_name">User Name</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name" value="<?php if (empty_check($user_name)) {
                                                                                                                            echo $user_name;
                                                                                                                        } ?>" placeholder="User Name" required autocomplete="off">
                                        <font color="#f00000" size="2px"><?php if (isset($error[1])) {
                                                                                echo $error[1];
                                                                            } ?></font>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label for="user_username">Username</label>
                                        <input type="text" class="form-control" id="user_username" name="user_username" value="<?php if (empty_check($user_username)) {
                                                                                                                                    echo $user_username;
                                                                                                                                } ?>" placeholder="Username" required autocomplete="off">
                                        <font color="#f00000" size="2px"><?php if (isset($error[2])) {
                                                                                echo $error[2];
                                                                            } ?></font>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label for="user_password">Password</label>
                                        <input type="text" class="form-control" id="user_password" name="user_password" value="<?php if (empty_check($user_password)) {
                                                                                                                                    echo $user_password;
                                                                                                                                } ?>" placeholder="Password" required autocomplete="off">
                                        <font color="#f00000" size="2px"><?php if (isset($error[3])) {
                                                                                echo $error[3];
                                                                            } ?></font>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="user" <?php if (empty_check($role) && strtolower($role) == 'user') {
                                                                        echo 'selected';
                                                                    } ?>>User</option>
                                            <option value="admin" <?php if (empty_check($role) && strtolower($role) == 'admin') {
                                                                    echo 'selected';
                                                                } ?>>Admin</option>
                                            <option value="manager" <?php if (empty_check($role) && strtolower($role) == 'manager') {
                                                                        echo 'selected';
                                                                    } ?>>Manager</option>
                                        </select>
                                        <font color="#f00000" size="2px"><?php if (isset($error[4])) {
                                                                                echo $error[4];
                                                                            } ?></font>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" data-rule-mandatory="true">
                                            <option value="active" <?php if (empty_check($user_status) && strtolower($user_status) == 'active') {
                                                                        echo 'selected';
                                                                    } ?>>Active</option>
                                            <option value="inactive" <?php if (empty_check($user_status) && strtolower($user_status) == 'inactive') {
                                                                            echo 'selected';
                                                                        } ?>>Inactive</option>
                                        </select>
                                        <font color="#f00000" size="2px"><?php if (isset($error[5])) {
                                                                                echo $error[5];
                                                                            } ?></font>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 text-right">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary mb-2" onclick="save_new_user()">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="TableHeader">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h4 class="card-title">User List</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 listingData dt-responsive" id="datatable">
                                    <thead>
                                        <tr>
                                            <th style="background: #f1b44c;">S. No.</th>
                                            <th style="background: #f1b44c;">User Name</th>
                                            <th style="background: #f1b44c;">Username</th>
                                            <th style="background: #f1b44c;">Role</th>
                                            <th style="background: #f1b44c;">User Added By</th>
                                            <th style="background: #f1b44c;">Status</th>
                                            <th style="background: #f1b44c;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($user_result) {
                                            $i = 1;
                                            while ($user = mysqli_fetch_assoc($user_result)) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php if (empty_check($i)) {
                                                                        echo $i;
                                                                    } ?></th>
                                                    <td><?php if (empty_check($user['user_name'])) {
                                                            echo $user['user_name'];
                                                        } ?></td>
                                                    <td><?php if (empty_check($user['user_username'])) {
                                                            echo $user['user_username'];
                                                        } ?></td>
                                                    <td><?php if (empty_check($user['user_type'])) {
                                                            echo $user['user_type'];
                                                        } ?></td>
                                                    <td><?php if (empty_check($user['user_created_by'])) {
                                                            echo strtoupper($user['user_created_by']);
                                                        } ?></td>
                                                    <td><?php if (empty_check($user['user_status']) && strtolower($user['user_status']) == 'active') {
                                                            echo '<span class="badge badge-pill badge-success">Active</span>';
                                                        } else {
                                                            echo '<span class="badge badge-pill badge-danger">Inactive</span>';
                                                        } ?></td>
                                                    <td>
                                                        <a href="user_controller.php?action=edit&u_id=<?php echo urlencode($user['user_id']); ?>" class="text-primary mr-2"><img style="height: 25px;" src="assets/images/edit.gif"></a>
                                                        <a href="javascript:void(0);" class="text-danger" onclick="confirmUserDeletion('<?php echo urlencode($user['user_id']); ?>');"><img style="height: 25px;" src="assets/images/delete.gif"></a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <script>
        function confirmUserDeletion(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX call to delete the user
                    $.ajax({
                        url: 'user_crud.php?action=delete&u_id=' + userId,
                        type: 'GET',
                        success: function(response) {
                            // Assuming the response is a success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The user has been deleted successfully.',
                            }).then(() => {
                                // Optionally, refresh the page or remove the user row from the DOM
                                location.reload(); // Refresh the page
                            });
                        },
                        error: function() {
                            // Handle errors here
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'There was an error deleting the user. Please try again.',
                            });
                        }
                    });
                }
            });
        }

        function save_new_user(){
            // AJAX call to delete the user
            $.ajax({
                    url: 'user_crud.php?action=save&u_id=' + userId,
                    type: 'GET',
                    success: function(response) {
                        // Assuming the response is a success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The user has been added successfully.',
                        }).then(() => {
                            // Optionally, refresh the page or remove the user row from the DOM
                            location.reload(); // Refresh the page
                        });
                    },
                    error: function() {
                        // Handle errors here
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'There was an error deleting the user. Please try again.',
                        });
                    }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('user_form');
            const inputs = form.querySelectorAll('input, select, button');

            inputs.forEach((input, index) => {
                input.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        const nextInput = inputs[index + 1];
                        if (nextInput) {
                            nextInput.focus();
                        }
                    }
                });
            });
        });
    </script>
    <!-- End Page-content -->
    <?php require('footer.php') ?>
