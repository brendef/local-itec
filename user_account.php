<?php include('include/header.php') ?>

<div class="container account-page">
    <?php if(isset($_SESSION['user_id'])) { ?>
    <div class="row">
        <div class="col-lg-6">
            <?php 
                if(isset($_GET['action'])) {
                    $action = $_GET['action'];
                } else {
                    $action = '';
                }

                switch($action) {
                    case "order";
                        echo $action;
                        break;

                    case "edit_account";
                        include('./user/edit_account.php');
                    break;

                    case "change_password";
                        include('./user/change_password.php');
                    break;

                    case "delete_account";
                        include("./user/delete_account.php");  
                    break;

                    default;
                        echo "Do some other stuff";
                }

                
            ?>
        </div>
        <div class="col-lg-6">
            <ul>
                <li><a href="user_account.php?action=order">Active Order</a></li>
                <li><a href="user_account.php?action=edit_account">Edit Account</a></li>
                <li><a href="user_account.php?action=change_password">Change Password</a></li>
                <li><a href="user_account.php?action=delete_account">Delete Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            
        </div>
    </div>

    <?php } else { ?>
        <div class="container not-loggedin-page">
            <h5> You are currently not logged in, please <a href="login.php?action=login">log in</a> to access your account.</h5>
        </div>
    <?php } ?>
</div>

<script src="./js/js_functions.js"></script>
<?php include('include/footer.php') ?>