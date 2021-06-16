<?php 
    session_start();
    include("functions/functions.php");
    include("include/database.php");

    $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <!-- Local CSS -->
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Fisherman's Bay</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand mx-5" href="index.php">
            <img src="./assets/images/logo.jpeg" alt="logo" width="30" height="24" class="d-inline-block align-text-top">
            Fisherman's Bay
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1">Contact</a>
                    </li>
                    <?php if(!isset($_SESSION['user_id'])) { ?>
                        <li class='nav-item'>
                            <a class='nav-link' href='login.php?action=login'>Login</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='signup.php'>Register</a>
                        </li>
                    <?php } else { ?>

                        <?php 
                            $select_user = mysqli_query($con, "SELECT * FROM users WHERE id='$_SESSION[user_id]' ");
                            $data_user = mysqli_fetch_array($select_user);
                        ?>

                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="btn dropdown-toggle user-icon" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person"></i>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="user_account.php?action=edit_account">Account settings</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li> <a class="dropdown-item" href='logout.php'>Logout</a> </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <a href="cart.php">
                        <div class="d-flex mx-5 cart">
                            <i class="bi bi-bag" style="font-size: 1.5rem; color: cornflowerblue;"></i>
                            <div class='badge badge-warning' id='cart'> 
                                <?php 
                                    cart_total();
                                ?>
                            </div>
                        </div>
                    </a>
                </ul>
            </div>
        </div>
    </nav>