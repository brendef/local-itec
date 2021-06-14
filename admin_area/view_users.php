<div class="container">
<h4 class="mb-5">View users</h4>

<form action="" method="post" enctype="multipart/form-data">

    <table class="table">
    <thead>
        <tr>
        <th><input type="checkbox" name="selectAll" value="" /></th>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col">Role</th>
        <!-- <th scope="col">Edit</th> -->
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <?php 
            $all_users = mysqli_query($con, "SELECT * FROM users ORDER BY id ASC ");

            $iterate = 1;
            
            while($row=mysqli_fetch_array($all_users)) {
        ?>
    <tbody>
        <tr>
            <td><input class="checkbox-remove" type="checkbox" name="deleteAll[]" value="<?php echo $row['id']; ?>"></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['users_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['users_password']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <!-- <td><a href="index.php?action=edit_user&user_id=<?php echo $row['id']; ?>>">Edit</a></td> -->
            <td><a href="index.php?action=view_users&delete_user=<?php echo $row['id']; ?>>">           
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
    if(isset($_GET['delete_user'])) {
        $delete_user = mysqli_query($con, "DELETE FROM users WHERE id = '$_GET[delete_user]' ");
        if($delete_user) {
            echo "<script>alert('User has been deleted.')</script>";
            echo "<script> window.open('index.php?action=view_users', '_self') </script>";
        }
    }

    if(isset($_POST['deleteAll'])) {
        $remove = $_POST['deleteAll'];

        foreach($remove as $key) {
            $run_remove = mysqli_query($con, "DELETE FROM users WHERE id = '$key' ");
            if($run_remove) {
                echo "<script>alert('User has been deleted.')</script>";
                echo "<script> window.open('index.php?action=view_users', '_self') </script>";
            } else {
                echo "<script>alert('Connection failed: mysqli_error($con).')</script>";
                echo "<script> window.open('index.php?action=view_users', '_self') </script>";
            }
        }
    }
?>