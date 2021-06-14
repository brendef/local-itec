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
    <title>Insert Products</title>
</head>
<body>
    <div class="container product-insert-page my-3 py-3">
        <div class="d-flex flex-column col-lg-6">
            <h4 class="mb-5">Add Product</h4>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="product_title">Product Name:</label>
                    <input id="product_title" type="text" name="product_title" class="form-control" required />
                </div>
                <div class="form-group mb-4">
                    <label for="product_category">Product Category:</label>
                    <select id="product_category" class="form-select" name="product_category">
                        <option selected>Select a category</option>
                        <?php 
                            $get_categories = "SELECT * FROM categories";

                            $run_categories = mysqli_query($con, $get_categories);
                    
                            while($categories_row = mysqli_fetch_array($run_categories)) {
                                $id = $categories_row['id'];
                                $title = $categories_row['title'];
                    
                                echo "<option value='$id'>$title</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="product_price">Product Price:</label>
                    <input id="product_price" type="number" name="product_price" class="form-control" required />
                </div>
                <div class="form-group mb-4">
                    <label for="product_description">Product Description:</label>
                    <textarea id="product_description" type="text" name="product_description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="product_image">Product Image:</label>
                    <input id="product_image" type="file" name="product_image" class="form-control" required />
                </div>
                <button type="submit" name="add_product" class="btn btn-dark mb-2">Add Product</button>
            </form>
        </div>
        <div class="col-lg-6"></div>
    </div>
</body>
</html>

<?php 

    if(isset($_POST['add_product'])) {
        echo "<script src='./js/uploadImage.js'> uploadImage() </script>";
        $product_title = $_POST['product_title'];
        $product_category = $_POST['product_category'];
        $product_price = $_POST['product_price'];
        $product_description = trim(mysqli_real_escape_string($con, $_POST['product_description']));
        
        $product_image = $_FILES['product_image']['name'];
        $product_image_temp = $_FILES['product_image']['temp_name'];

        move_uploaded_file($product_image_temp, "product_images/$product_image");

        $insert_product_query = " INSERT INTO products (category, product_name, price, product_description, product_image) VALUES ('$product_category', '$product_title', '$product_price', '$product_description', '$product_image') ";
        $insert_product = mysqli_query($con, $insert_product_query);

        if ($insert_product) {
            echo "<script> alert('Product has been inserted successfully') </script>";
            // echo "<script> window.open('index.php?add_product', '_self') </script>";

        }

    }

?>