    <?php include("include/header.php"); ?>
    <div class="container checkout-page">
        <?php 
            if(!isset($_SESSION['email'])) {
                echo "<script> window.open('login.php', '_self') </script>";
            } else {
                echo "<script> window.open('place_order.php', '_self') </script>";
            }
        ?>
    </div>

    <?php include("./include/footer.php"); ?>

