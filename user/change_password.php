<?php
    $select_user = mysqli_query($con, "SELECT * FROM users WHERE id='$_SESSION[user_id]' ");
    $fetch_user = mysqli_fetch_array($select_user);
?>


<div class="">
    <form action="" method="post">
        <h3>Change password</h3>
        <div class="mb-3">
            <label for="old_password" class="form-label">Current Password</label>
            <input id="old_password" type="password" name="old_password" class="form-control" required placeholder="●●●●●●●●" />
        </div>
        <div class="mb-3">
            <label for="password1" class="form-label">Password</label>
            <input id="password1" type="password" name="password" class="form-control" required placeholder="●●●●●●●●" onkeyup='check()' />
        </div>
        <div class="mb-3">
            <label for="password2" class="form-label">Confirm Password</label>
            <input id="password2" type="password" name="confirm_password" class="form-control" required placeholder="●●●●●●●●" onkeyup='check()' />
        </div>
        <label id="message" class="form-label d-none"></label>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="showPassword" onclick="handleShowPasswordOldPassword()">
            <label class="form-check-label" for="showPassword">Show password</label>
        </div>
        <button id="registerButton" type="submit" name="change_password" class="btn btn-dark">Change Password</button>
    </form>
</div>

<?php 
    if(isset($_POST['change_password'])) {
        if(!empty($_POST['old_password']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
            $old_password = trim($_POST['old_password']);
            $old_hash_password = md5($old_password);
            $password = trim($_POST['password']);
            $new_hash_password = md5($password);
            $confirm_password = trim($_POST['confirm_password']);

            if($fetch_user['users_password'] != $old_hash_password) {
                    echo "<script> alert('Your current password is incorrect.') </script>";
            } else {
                if($password == $confirm_password) {
                    $update_password = mysqli_query($con, "UPDATE users SET users_password='$new_hash_password' WHERE id='$_SESSION[user_id]' ");
                }  
            }


        }
    }
?>

<script src="./js/js_functions.js"></script>