    <?php include("include/header.php"); ?>

    <div class="container-fluid login-main">
        <div class="row">
            <div class="col-lg-6 register-left">
                <div>
                <h1>Welcome,</h1>
                <p>Sign up to create your account to place an order</p>
                </div>
            </div>
            <div class="col-lg-6 right">
                <div class="container register-page">
                    <form action="" method="post">
                        <h3>Register</h3>
                        <div class="mb-3">
                            <label for="InputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="InputName" name="name" required placeholder="Full name" />
                        </div>
                        <div class="mb-3">
                            <label for="InputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="InputEmail" name="email" required placeholder="example@email.com" />
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
                            <input type="checkbox" class="form-check-input" id="showPassword" onclick="handleShowPassword()">
                            <label class="form-check-label" for="showPassword">Show password</label>
                        </div>
                        <button id="registerButton" type="submit" name="signup" class="btn btn-dark">Sign up</button>
                        <p class="mt-3"> Already have an account? <a href="login.php"> Log in</a> here.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
        if(isset($_POST['signup'])) {
            if( !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['name']) ) {
                $ip_address = get_ip_address();
                $name = $_POST['name'];
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $hash_password = md5($password);
                $confirm_password = trim($_POST['confirm_password']);

                $check_exist = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' ");
                $email_count = mysqli_num_rows($check_exist);

                $row_register = mysqli_fetch_array($check_exist);
                if($email_count > 0) {
                    echo "<script> alert('Email address is already registered to another account') </script>";
                } elseif( $row_register['email'] !== $email && $password == $confirm_password ) {
                    $run_insert = mysqli_query($con, "INSERT INTO users (ip_address, users_name, email, users_password) VALUES ('$ip_address', '$name', '$email', '$hash_password') ");

                    if($run_insert) {
                        $select_user = mysqli_query($con, "SELECT * FROM users WHERE email='$email' "); 
                        $row_user = mysqli_fetch_array($select_user);

                        $_SESSION['user_id'] = $row_user['id'];
                        $_SESSION['role'] = $row_user['role'];

                    }
                    $run_cart = mysqli_query($con, "SELECT * FROM cart WHERE ip_address='$ip_address' ");
                    $check_cart = mysqli_num_rows($run_cart);

                    if($check_cart == 0) {
                        $_SESSION['email'] = $email;
                        echo "<script> alert('Account created successfully')</script>";
                        echo "<script> window.open('user_account.php', '_self') </script>";
                    } else {
                        $_SESSION['email'] = $email;
                        echo "<script> alert('Account created successfully')</script>";
                        echo "<script> window.open('checkout.php', '_self') </script>";
                    }
                }  
            }
        }
    ?>

    <script src="./js/js_functions.js"></script>
    <?php include("./include/footer.php"); ?>