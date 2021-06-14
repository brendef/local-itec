
    <?php include("include/header.php"); ?>
    <div class="container mt-3 place_order-page">
        <h4>Place Order</h4>
        <?php 
            if(!isset($_SESSION['user_id'])) {
                echo "<script> window.open('login.php', '_self') </script>";
            }
        ?>

        <p>Your order:</p>

    </div>

    <?php include("./include/footer.php"); ?>

