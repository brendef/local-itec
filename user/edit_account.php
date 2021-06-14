<?php
$select_user = mysqli_query($con, "SELECT * FROM users WHERE id='$_SESSION[user_id]' ");
$fetch_user = mysqli_fetch_array($select_user);
?>

<div class="edit-account">
    <form action="" method="post">
        <h3>Edit account details</h3>
        <div class="mb-3">
            <label for="InputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="InputName" name="name" value="<?php echo $fetch_user['users_name']; ?>" required placeholder="Full name" />
        </div>
        <div class="mb-3">
            <label for="InputEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="InputEmail" name="email" value="<?php echo $fetch_user['email']; ?>" required placeholder="example@email.com" />
        </div>
        <button id="registerButton" type="submit" name="edit_account" class="btn btn-dark">Save changes</button>
    </form>
</div>


<?php 
    if(isset($_POST['edit_account'])) {
        if( !empty($_POST['email']) && !empty($_POST['name']) ) {
            $ip_address = get_ip_address();
            $name = $_POST['name'];
            $email = trim($_POST['email']);

            $check_exist = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' ");
            $email_count = mysqli_num_rows($check_exist);

            $row_register = mysqli_fetch_array($check_exist);
            if($email_count > 0) {
                echo "<script> alert('Email address is already registered to another account') </script>";
            } elseif( $fetch_user['password'] !== $email && $password == $confirm_password ) {
                $run_insert = mysqli_query($con, "INSERT INTO users (ip_address, users_name, email, users_password) VALUES ('$ip_address', '$name', '$email', '$hash_password') ");
        }
    }
}
?>

<script src="./js/js_functions.js"></script>