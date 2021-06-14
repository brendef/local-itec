
<?php 
    session_start();
    if(!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {

        echo "<script> window.open('login.php', '_self') </script>";

    } else {

?>
<?php include('include/database.php') ?>

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
    <title>Fisherman's Bay Admin Dashboard</title>
</head>
<body>

<nav class="navbar justify-content-end">
    <button class="btn btn-dark mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        Notifications <i class="bi bi-bell"></i>
    </button>
    <button class="btn btn-dark mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        Menu <i class="bi bi-list"></i>
    </button>
</nav>

<div class="container mt-3">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Admin menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul>
                <h5><li><i class="bi bi-speedometer2"></i> <a href="../index.php">View Site</a></li></h5>

                <h5><li> <i class="bi bi-ui-checks"></i><a href="index.php?action=view_orders"> Orders</a>  </li></h5>

                <h5><li> <i class="bi bi-columns-gap"></i> <a href="#">Products</a>  </li></h5>
                <li><a href="index.php?action=add_product">Add Products</a></li>
                <li><a href="index.php?action=view_products">View Products</a></li>


                <h5><li> <i class="bi bi-bar-chart-steps"></i> <a href="#">Categories</a></li></h5>
                <li><a href="index.php?action=add_category">Add Categories</a></li>
                <li><a href="index.php?action=view_categories">View Categories</a></li>
        
                <h5><li> <i class="bi bi-people"></i> <a href="#">Users</a></li></h5>
                <li><a href="index.php?action=add_user">Add User</a></li>
                <li><a href="index.php?action=view_users">View Users</a></li>
                
                <h5><li> <i class="bi bi-clock"></i> <a href="index.php?action=view_history">History</a>  </li></h5>
                
                <h5><li> <i class="bi bi-person-circle"></i> <a href="../user_account.php">Account settings</a> </li></h5>
                <h5><li> <i class="bi bi-door-open"></i> <a href='../logout.php'>Logout</a> </li></h5>
            </ul>  
        </div>
    </div>
</div>

                <?php 
                    if(isset($_GET['action'])) {
                        $action = $_GET['action'];
                    } else {
                        $action = 'view_orders';
                    }
                    
                    switch($action) {
                        case 'view_history';
                            include('./view_history.php');
                            break;
                        case 'view_orders';
                            include('./view_orders.php');
                            break;
                        case 'add_product';
                            include('./add_products.php');
                            break;
                        case 'view_products';
                            include('./view_products.php');
                            break;
                        case 'edit_product';
                            include('./edit_product.php');
                            break;
                        case 'add_category';
                            include('./add_category.php');
                            break;
                        case 'view_categories';
                            include('./view_categories.php');
                            break;
                        case 'edit_category';
                            include('./edit_category.php');
                            break;
                        case 'view_users';
                            include('./view_users.php');
                            break;
                        case 'edit_user';
                            include('./edit_user.php');
                            break;
                    }
                ?>



    <script src="https://www.gstatic.com/firebasejs/8.6.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.4/firebase-storage.js"></script>
    <script src="../js/js_functions.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>

<?php } ?>