<?php include("include/header.php"); ?>

<?php cart(); ?>
<?php 
    if(isset($_SESSION['email'])) {
        echo 
        " <p>Currently logged in as: " . $_SESSION['email'];
    } else {
        echo "";
    }
?> 
<div class="container cart-accordion">
<div class="d-flex flex-column align-items-center mt-4 mb-3"> 
    <h3>Shopping Cart</h3>
    <p>You currently have <?php echo cart_total(); ?> in your cart</p>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <?php 
        $total = 0;

        $ip_address = get_ip_address();

        $run_cart = mysqli_query($con, "SELECT * FROM cart WHERE ip_address ='$ip_address' ");

        while($fetch_cart = mysqli_fetch_array($run_cart)) {
            $product_id = $fetch_cart['product_id'];
            $result_product = mysqli_query($con, "SELECT * FROM products WHERE id='$product_id' ");

            while($fetch_product = mysqli_fetch_array($result_product)) {
                $product_price = array($fetch_product['price']);
                $product_name = $fetch_product['product_name'];
                $product_description = $fetch_product['product_description'];
                $product_image = $fetch_product['product_image'];

                $item_price = $fetch_product['price'];
                $values = array_sum($product_price);

                $get_quantity = mysqli_query($con, "SELECT * FROM cart WHERE product_id = '$product_id' ");
                $row_quantity = mysqli_fetch_array($get_quantity);
                $quantity = $row_quantity['quantity'];
                $values_quantity = $values * $quantity;
                $user = $_SESSION['email'];

                $total += $values_quantity;

        ?>                     
        <div class="container mb-2">

        <div class="card mb-3" style="max-width: 1000px;">
            <div class="row g-0">
                <div class="col-md-4 d-flex align-items-center">
                <!-- <img src="..." alt="..."> -->
                <?php echo "<img src='admin_area/product_images/$product_image' style='width:70%; height: 150px;' />"; ?>
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product_name; ?></h5>
                    <p class="card-text"><?php echo $product_description; ?></p>
                    <p class="card-text">R <?php echo $item_price; ?></p>
                   <p><input class="checkbox-remove" type="checkbox" name="remove[]" value="<?php echo $product_id; ?>" /> Remove</p>
                </div>
                </div>
            </div>
        </div> 
        <?php } } ?> 
            <h4 class="d-flex flex-column align-items-end mx-2 my-3">Cart total price: R<?php total_price();?> </h4> 
            <div class="container form-controls mt-4">
                <div class="continue-shopping-button">                        
                    <i class="bi bi-arrow-left-short" style="font-size: 1.5rem; color: cornflowerblue;"></i>
                    <button type="submit" name="continue" class="btn btn-link p-0">Continue Shopping</button>
                </div>
                <div>
                    <button id="remove-thing" type="submit" name="update_cart"class="mx-2 btn btn-outline-danger d-none"> <i class="bi bi-trash"></i> Remove </button>
                    <button type="submit" name="checkout" class="btn btn-dark">Checkout</button>
                </div>
            </div>

        </form>
        <?php 
            if(isset($_POST['remove'])) {
                foreach($_POST['remove'] as $remove_id) {
                    $run_delete = mysqli_query($con, "DELETE FROM cart WHERE product_id = '$remove_id' AND ip_address = '$ip_address' ");

                    if($run_delete) {
                        echo "<script> window.open('cart.php', '_self') </script>";
                    }
                }
            }

            if(isset($_POST['continue'])) {
                echo "<script> window.open('index.php', '_self') </script>";
            }

            if(isset($_POST['checkout'])) {
                $ip_address = get_ip_address();
                $run_cart = mysqli_query($con, "SELECT * FROM cart WHERE ip_address ='$ip_address' ");

                while($fetch_cart = mysqli_fetch_array($run_cart)) {
                    $product_id = $fetch_cart['product_id'];
                    $result_product = mysqli_query($con, "SELECT * FROM products WHERE id='$product_id' ");
        
                    while($fetch_product = mysqli_fetch_array($result_product)) {
                        $product_name = $fetch_product['product_name'];
                        $user = $_SESSION['email'];

                        if(isset($_SESSION['email'])) {
                            $insert_order = mysqli_query($con, "INSERT INTO orders (product_id, email, item) VALUES ('$product_id', '$user', '$product_name') ");
                            if($insert_order) {
                                echo "<script> alert('Order has been placed') </script>";
                            }
                            continue;
                        } else {
                            echo "<script> window.open('login.php', '_self') </script>";
                        }
                    }
                }
            }
                
        ?>
</div>

<script src="./js/js_functions.js"></script>
<?php include("./include/footer.php"); ?>