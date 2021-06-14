<?php 
    session_start();
    include("../functions/functions.php");
    include("../include/database.php");

    $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <!-- Local CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Fisherman's Bay Admin Login</title>
</head>
<body>

    <div class="container-fluid login-main">
        <div class="row">
            <div class="col-lg-6 left">
                <div>
                <h1>Welcome Admin,</h1>
                <p>Sign into to access the admin dashboard.</p>
                </div>
            </div>
            <div class="col-lg-6 right">
                <div class="container login-page">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>Admin Login</h3>
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
                        <p class="mt-3"> Not an admin? <a href="../login.php">Go to user login</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
    if(isset($_POST['login'])) {
        $email =  trim(mysqli_real_escape_string($con, $_POST['email']));
        $password = trim(mysqli_real_escape_string($con, $_POST['password']));
        $password = md5($password);

        $run_login = mysqli_query($con, "SELECT * FROM users WHERE users_password = '$password' AND email = '$email' ");
        $check_login = mysqli_num_rows(($run_login));

        if($check_login == 0) {
            echo "<script> alert('Email or password is incorrect') </script>";
            exit();
        }

        if($check_login > 0) {
            $row_login = mysqli_fetch_array($run_login);
            $_SESSION['user_id'] = $row_login['id'];
            $_SESSION['role'] = $row_login['role'];

            $_SESSION['email'] = $email;

            if($row_login['role'] == 'admin') {
                echo "<script> window.open('index.php', '_self') </script>";
            } elseif($row_login['role'] == 'guest') {
                echo "<script> alert('Admin rights required, please contact store owner or administrator.') </script>";
                echo "<script> window.open('../index.php', '_self') </script>";
            } else {
                echo "<script> alert('Email or password is incorrect') </script>";
            }
        } 
    }
?>

<script src="../js/js_functions.js"></script>
<?php include("./include/footer.php"); ?>