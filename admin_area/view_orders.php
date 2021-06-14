<div class="container">
<h4 class="mb-5">All orders</h4>

<form action="" method="post" enctype="multipart/form-data">

    <table class="table">
    <thead>
        <tr>
        <th><input type="checkbox" name="selectAll" value="" /></th>
        <th scope="col">Order id</th>
        <th scope="col">Product id</th>
        <th scope="col">Email</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Date</th>
        <th scope="col">Status</th>
        <th scope="col">Complete</th>
        </tr>
    </thead>
    <?php 
            $all_orders = mysqli_query($con, "SELECT * FROM orders ORDER BY id ASC ");

            $iterate = 1;
            
            while($row=mysqli_fetch_array($all_orders)) {
        ?>
    <tbody>
        <tr>
            <td><input class="checkbox-remove" type="checkbox" name="deleteAll[]" value="<?php echo $row['id']; ?>"></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['item']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td>
                <?php 
                    if($row['visible'] ==  1) {
                        echo "Served";
                    } else {
                        echo "Processing";
                    }
                ?>
            </td>
            <!-- <td><a href="index.php?action=edit_product&product_id=<?php echo $row['id']; ?>>">Edit</a></td> -->
            <!-- <td><a href="index.php?action=view_products&delete_product=<?php echo $row['id']; ?>>">Delete</a></td> -->
            <td><a href="index.php?action=view_orders&complete_order=<?php echo $row['id']; ?>&product_id=<?php echo $row['product_id']; ?>&email=<?php echo $row['email']; ?>">Complete</a></td>
        </tr>
    </tbody>
    <?php $i++; } ?>
    </table>
    <button id="remove-thing" type="submit" name="delete_all" class="btn btn-outline-danger d-none">  <i class="bi bi-trash"></i> Remove</button>

</form>

<!-- <input type="checkbox" name="deleteAll[]" value="" /> Delete All -->
</div>

<?php 
    if(isset($_GET['complete_order'])) {
        $product_id = $_GET['product_id'];
        $user = $_GET['email'];

        $complete_order = mysqli_query($con, "DELETE FROM orders WHERE id = '$_GET[complete_order]' ");
        if($complete_order) {
            $result_product = mysqli_query($con, "SELECT * FROM products WHERE id='$product_id' ");
            while($fetch_product = mysqli_fetch_array($result_product)) {
                $product_name = $fetch_product['product_name'];

                $insert_order = mysqli_query($con, "INSERT INTO history (email, item) VALUES ('$user', '$product_name') ");
            }
        }
        echo "<script>alert('Order has been marked as completed.')</script>";
        echo "<script> window.open('index.php?action=view_orders', '_self') </script>";
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