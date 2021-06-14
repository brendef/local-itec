<div class="container">
<h4 class="mb-5">View products</h4>

<form action="" method="post" enctype="multipart/form-data">

    <table class="table">
    <thead>
        <tr>
        <th><input type="checkbox" name="selectAll" value="" /></th>
        <th scope="col">id</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Views</th>
        <th scope="col">Date</th>
        <th scope="col">Status</th>
        <!-- <th scope="col">Edit</th> -->
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <?php 
            $all_products = mysqli_query($con, "SELECT * FROM products ORDER BY id ASC ");

            $iterate = 1;
            
            while($row=mysqli_fetch_array($all_products)) {
        ?>
    <tbody>
        <tr>
            <td><input class="checkbox-remove" type="checkbox" name="deleteAll[]" value="<?php echo $row['id']; ?>"></td>
            <td><?php echo $row['id']; ?></td>
            <td><img src="product_images/<?php echo $row['product_image']; ?>" width="70" height="50" /></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['views']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td>
                <?php 
                    if($row['visible'] ==  1) {
                        echo "Approved";
                    } else {
                        echo "Pending";
                    }
                ?>
            </td>
            <!-- <td><a href="index.php?action=edit_product&product_id=<?php echo $row['id']; ?>">Edit</a></td> -->
            <td><a href="index.php?action=view_products&delete_product=<?php echo $row['id']; ?>">           
                <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="bi bi-trash"></i>
                </button> 
            </a></td>
        </tr>
    </tbody>
    <?php $i++; } ?>
    </table>
    <button id="remove-thing" type="submit" name="delete_all" class="btn btn-outline-danger d-none">  <i class="bi bi-trash"></i> Remove</button>

</form>

<!-- <input type="checkbox" name="deleteAll[]" value="" /> Delete All -->
</div>

<?php 
    if(isset($_GET['delete_product'])) {
        $delete_product = mysqli_query($con, "DELETE FROM products WHERE id = '$_GET[delete_product]' ");
        if($delete_product) {
            echo "<script>alert('Product has been deleted.')</script>";
            echo "<script> window.open('index.php?action=view_products', '_self') </script>";
        }
    }

    if(isset($_POST['deleteAll'])) {
        $remove = $_POST['deleteAll'];

        foreach($remove as $key) {
            $run_remove = mysqli_query($con, "DELETE FROM products WHERE id = '$key' ");
            if($run_remove) {
                echo "<script>alert('Products has been deleted.')</script>";
                echo "<script> window.open('index.php?action=view_products', '_self') </script>";
            } else {
                echo "<script>alert('Connection failed: mysqli_error($con).')</script>";
                echo "<script> window.open('index.php?action=view_products', '_self') </script>";
            }
        }
    }
?>