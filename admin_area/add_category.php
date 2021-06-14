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
            <h4 class="mb-5">Add Category</h4>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="category_name">Category Name:</label>
                    <input id="category_name" type="text" name="category_name" class="form-control" required />
                </div>
                <button type="submit" name="add_category" class="btn btn-dark mb-2">Add Category</button>
            </form>
        </div>
        <div class="col-lg-6"></div>
    </div>
</body>
</html>

<?php 

    if(isset($_POST['add_category'])) {
        $product_category = $_POST['category_name'];

        $product_category = mysqli_real_escape_string($con, $_POST['category_name']);
        $add_category = mysqli_query($con, "INSERT INTO categories (title) VALUES ('$product_category') ");

        if ($add_category) {
            echo "<script> alert('Category was successfully added') </script>";
            // echo "<script> window.open('index.php?add_product', '_self') </script>";

        }

    }

?>