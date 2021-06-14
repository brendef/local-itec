<?php 
    $edit_product = mysqli_query($con, "SELECT * FROM products WHERE id = '$_GET[product_id]' ");
    $fetch_edit = mysqli_fetch_array($edit_product);
?>
    <div class="container product-insert-page my-3 py-3">
        <div class="d-flex flex-column col-lg-6">
            <h4 class="mb-5">Edit Product</h4>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="product_title">Product Name:</label>
                    <input id="product_title" type="text" name="product_title" value="<?php echo $fetch_edit['product_name']; ?>" class="form-control" required />
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
                                if($fetch_edit['category'] == $id) {
                                    echo "<option value='$fetch_edit[category]' selected>$title</option>";
                                } else {
                                    echo "<option value='$id'>$title</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="product_price">Product Price:</label>
                    <input id="product_price" type="number" name="product_price" class="form-control" required value="<?php echo $fetch_edit['price']; ?>" />
                </div>
                <div class="form-group mb-4">
                    <label for="product_description">Product Description:</label>
                    <textarea id="product_description" type="text" name="product_description" class="form-control" rows="3" required><?php echo $fetch_edit['product_description']; ?></textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="product_image">Product Image:</label>
                    <input id="product_image" type="file" name="product_image" class="form-control" />
                    <img class="mt-2" src="product_images/<?php echo $fetch_edit['product_image']; ?>" width="100" height="70" />
                </div>
                <button type="submit" name="edit_product" class="btn btn-dark mb-2">Save Changes</button>
            </form>
        </div>
        <div class="col-lg-6"></div>
    </div>
</body>
</html>

<?php 

    if(isset($_POST['edit_product'])) {
        $product_title = trim(mysqli_real_escape_string($con, $_POST['product_title']));
        $product_category = $_POST['product_category'];
        $product_price = $_POST['product_price'];
        $product_description = trim(mysqli_real_escape_string($con, $_POST['product_description']));
        $date = date("F d, Y");
        
        $product_image = $_FILES['product_image']['name'];
        $product_image_temp = $_FILES['product_image']['temp_name'];

        if(!empty($_FILES['product_image']['name'])) {
            if(move_uploaded_file($product_image_temp, 'product_images/$product_image')) {
                $update_product = mysqli_query($con, "UPDATE products SET category='$product_category', product_name='$product_title', price='$product_price', product_description='$product_description', product_image='$product_image' WHERE id='$_GET[product_id]' ");
            }
        } else {
            $update_product = mysqli_query($con, "UPDATE products SET category='$product_category', product_name='$product_title', price='$product_price', product_description='$product_description' WHERE id='$_GET[product_id]' ");
        }

        if($update_product) {
            echo "<script> alert('Product updated successfully') </script>"; 
            echo "<script> window.open(window.location.href, '_self') </script>";
        }

    }

?>