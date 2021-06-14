<?php 


        // // Get Heroku ClearDB connection information
        // $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        // $cleardb_server = $cleardb_url["heroku_170eef10b494f8d"];
        // $cleardb_username = $cleardb_url["bf8bbd806bdb73"];
        // $cleardb_password = $cleardb_url["bfb1ccb3"];
        // $cleardb_db = substr($cleardb_url["us-cdbr-east-04.cleardb.com"],1);
        // $active_group = 'default';
        // $query_builder = TRUE;
        // // Connect to DB
        // $con = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    $con = mysqli_connect("localhost", "root", "", "online_store");

    // if (mysqli_connect_errno()) {
    //     echo "Database connection failed" . mysqli_connect_errno();
    // }

    function cart() {
        global $con;
        if(isset($_GET['add_to_cart'])) {
            $product_id = $_GET['add_to_cart'];
            $ip_address = get_ip_address();
            $run_check_product = mysqli_query($con, "SELECT * FROM cart WHERE product_id = '$product_id' ");
            if(mysqli_num_rows($run_check_product) > 0) {
                echo "";
            } else {
                $fetch_product = mysqli_query($con, "SELECT * FROM products WHERE id = '$product_id' ");
                $fetch_product = mysqli_fetch_array($fetch_product);
                $product_name = $fetch_product['product_name'];

                mysqli_query($con, "INSERT INTO cart (product_id, product_name, ip_address) VALUES ('$product_id', '$product_name', '$ip_address') ");

                echo "<script>window.open('index.php', '_self')</script>";
            }
        }
    }

    function total_price() {
        global $con;

        $total = 0;

        $ip_address = get_ip_address();

        $run_cart = mysqli_query($con, "SELECT * FROM cart WHERE ip_address ='$ip_address' ");

        while($fetch_cart = mysqli_fetch_array($run_cart)) {
            $product_id = $fetch_cart['product_id'];
            $result_product = mysqli_query($con, "SELECT * FROM products WHERE id='$product_id' ");

            while($fetch_product = mysqli_fetch_array($result_product)) {
                $product_price = array($fetch_product['price']);
                $product_name = $fetch_product['product_name'];
                $product_image = $fetch_product['product_image'];

                $sing_price = $fetch_product['price'];
                $values = array_sum($product_price);

                $get_quantity = mysqli_query($con, "SELECT * FROM cart WHERE product_id = '$product_id' ");
                $row_quantity = mysqli_fetch_array($get_quantity);
                $quantity = $row_quantity['quantity'];
                $values_quantity = $values * $quantity;

                $total += $values_quantity;
            }
        }

        echo $total;
    }

    function cart_total() {
        global $con;
        $ip_address = get_ip_address();
        $run_items = mysqli_query($con, "SELECT * FROM cart WHERE ip_address = '$ip_address' ");
        echo $count_items = mysqli_num_rows($run_items);
    }

    function get_ip_address(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function getCategories() {
        global $con;
        $get_categories = "SELECT * FROM categories";

        $run_categories = mysqli_query($con, $get_categories);

        while($categories_row = mysqli_fetch_array($run_categories)) {
            $id = $categories_row['id'];
            $title = $categories_row['title'];
            echo "
                <li><a class='btn btn-dark mx-3' href='index.php?category=$id'>$title</a></li>
            ";
        }
    }

    function getProducts() {
        if(!isset($_GET['category'])) {
            global $con;
            $get_products = "SELECT * FROM products";
            $run_products = mysqli_query($con, $get_products);

            while($products_row = mysqli_fetch_array($run_products)) {
                $product_id = $products_row['id'];
                $category = $products_row['category'];
                $name = $products_row['product_name'];
                $price = $products_row['price'];
                $description = $products_row['product_description'];
                $image = $products_row['product_image'];
                
                echo "
                <div class='col-lg-3 col-md-6 col-sm-12 my-3'>
                    <div class='card h-100'>
                        <img class='card-img-top' src='admin_area/product_images/$image' style='width:100%; height: 200px;' />
                        <div class='card-body'>
                            <h5 class='card-title'>$name</h5>
                            <p class='card-text'>$description</p>
                            <h5 class='price'>R$price</h5>
                            <a href='index.php?add_to_cart=$product_id'> <button id='liveToastBtn' type='submit' class='add-to-cart-btn btn btn-dark' style='width:100%;'>Add to cart</button></a>
                        </div>
                    </div>
                </div>
                ";
            }
        }
    }

    function get_products_by_category_id() {
        global $con;

        if(isset($_GET['category'])) {
            $category_id = $_GET['category'];
            
            $get_products_from_category = "SELECT * FROM products WHERE category = '$category_id' ";

            $run_get_products_from_category = mysqli_query($con, $get_products_from_category);

            $count_categories = mysqli_num_rows($run_get_products_from_category);
            
            if($count_categories == 0) {
                echo "<h2 style='padding-top:100px; text-align:center;'> There are no products in this category  </h2>";
            }

            while($category_products_row = mysqli_fetch_array($run_get_products_from_category)){
                $product_id = $category_products_row['id'];
                $category = $category_products_row['category'];
                $name = $category_products_row['product_name'];
                $price = $category_products_row['price'];
                $description = $category_products_row['product_description'];
                $image = $category_products_row['product_image'];

                echo "
                <div class='col-lg-3 col-md-6 col-sm-12 my-3'>
                    <div class='card h-100'>
                        <img class='card-img-top' src='admin_area/product_images/$image' style='width:100%; height: 200px;' />
                        <div class='card-body'>
                            <h5 class='card-title'>$name</h5>
                            <p class='card-text'>$description</p>
                            <h5 class='price'>R$price</h5>
                            <a href='index.php?add_to_cart=$product_id'> <button id='liveToastBtn' type='submit' class='add-to-cart-btn btn btn-dark' style='width:100%;'>Add to cart</button></a>
                        </div>
                    </div>
                </div>
                ";
            }
        }
    }

?>