<div class="container">
<h4 class="mb-5">Order history</h4>

<form action="" method="post" enctype="multipart/form-data">

    <table class="table">
    <thead>
        <tr>
        <th><input type="checkbox" name="selectAll" value="" /></th>
        <th scope="col">id</th>
        <th scope="col">Email Address</th>
        <th scope="col">Product</th>
        <th scope="col">Date of order</th>
        <th scope="col">Status</th>
        </tr>
    </thead>
    <?php 
            $all_history = mysqli_query($con, "SELECT * FROM history ORDER BY id ASC ");

            $iterate = 1;
            
            while($row=mysqli_fetch_array($all_history)) {
        ?>
    <tbody>
        <tr>
            <td><input class="checkbox-remove" type="checkbox" name="deleteAll[]" value="<?php echo $row['id']; ?>"></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['item']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td>
                <?php 
                    if($row['visible'] ==  1) {
                        echo "Cancelled";
                    } else {
                        echo "Completed";
                    }
                ?>
            </td>
        </tr>
    </tbody>
    <?php $i++; } ?>
    </table>
    <button id="remove-thing" type="submit" name="delete_all" class="btn btn-outline-danger d-none">  <i class="bi bi-trash"></i> Remove</button>

</form>

<!-- <input type="checkbox" name="deleteAll[]" value="" /> Delete All -->
</div>

<?php 

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