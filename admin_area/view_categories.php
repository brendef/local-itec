<div class="container">
<h4 class="mb-5">View categories</h4>

<form action="" method="post" enctype="multipart/form-data">

    <table class="table">
    <thead>
        <tr>
        <th><input type="checkbox" name="selectAll" value="" /></th>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <?php 
            $all_categories = mysqli_query($con, "SELECT * FROM categories ORDER BY id ASC ");

            $iterate = 1;
            
            while($row=mysqli_fetch_array($all_categories)) {
        ?>
    <tbody>
        <tr>
            <td><input class="checkbox-remove" type="checkbox" name="deleteAll[]" value="<?php echo $row['id']; ?>"></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><a href="index.php?action=edit_category&category_id=<?php echo $row['id']; ?>>">
                <button class="btn btn-dark" type="button">
                    <i class="bi bi-pencil"></i>
                </button> 
            </a></td>
            <td><a href="index.php?action=view_categories&delete_category=<?php echo $row['id']; ?>>"> 
                <button class="btn btn-dark" type="button">
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
    if(isset($_GET['delete_category'])) {
        $delete_category = mysqli_query($con, "DELETE FROM categories WHERE id = '$_GET[delete_category]' ");
        if($delete_category) {
            echo "<script>alert('Category has been deleted.')</script>";
            echo "<script> window.open('index.php?action=view_categories', '_self') </script>";
        }
    }

    if(isset($_POST['deleteAll'])) {
        $remove = $_POST['deleteAll'];

        foreach($remove as $key) {
            $run_remove = mysqli_query($con, "DELETE FROM categories WHERE id = '$key' ");
            if($run_remove) {
                echo "<script>alert('categories has been deleted.')</script>";
                echo "<script> window.open('index.php?action=view_categories', '_self') </script>";
            } else {
                echo "<script>alert('Connection failed: mysqli_error($con).')</script>";
                echo "<script> window.open('index.php?action=view_categories', '_self') </script>";
            }
        }
    }
?>