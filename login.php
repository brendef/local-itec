<?php include("include/header.php"); ?>

    <div class="container-fluid login-main">
        <div class="row">
            <div class="col-lg-6 left">
                <div>
                <h1>Welcome Back,</h1>
                <p>Sign into your account to place an order</p>
                </div>
            </div>
            <div class="col-lg-6 right">
                <div class="container login-page">
                    <form action="" method="post">
                        <h3>Login</h3>
                        <div class="mb-3">
                            <label for="InputEmail" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="email" required placeholder="example@email.com" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required placeholder="●●●●●●●●" />
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="showPassword" onclick="handleShowPasswordLogin()">
                            <label class="form-check-label" for="checkbox">Show password</label>
                        </div>
                        <button type="submit" name="login" class="btn btn-dark">Log in</button>
                        <p class="mt-3"> Don't have an account? <a href="signup.php"> Create account</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
    if(isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password = md5($password);

        $run_login = mysqli_query($con, "SELECT * FROM users WHERE users_password = '$password' AND email = '$email' ");
        $check_login = mysqli_num_rows(($run_login));

        $row_login = mysqli_fetch_array(($run_login));

        if($check_login == 0) {
            echo "<script> alert('Email or password is incorrect') </script>";
            exit();
        }

        $ip_address = get_ip_address();
        $run_cart = mysqli_query($con, "SELECT * FROM cart WHERE ip_address='$ip_address' ");
        $check_cart = mysqli_num_rows(($run_cart));

        if($check_login > 0 AND $check_cart == 0) {

            $_SESSION['user_id'] = $row_login['id'];
            $_SESSION['role'] = $row_login['role'];

            $_SESSION['email'] = $email;
            echo "<script> alert('Login successful') </script>";
            echo "<script> window.open('index.php', '_self') </script>";
        } else {

            $_SESSION['user_id'] = $row_login['id'];
            $_SESSION['role'] = $row_login['role'];

            $_SESSION['email'] = $email;
            echo "<script> alert('Login successful') </script>";
            echo "<script> window.open('checkout.php', '_self') </script>";
        }
    }
?>

<script src="./js/js_functions.js"></script>
<?php include("./include/footer.php"); ?>