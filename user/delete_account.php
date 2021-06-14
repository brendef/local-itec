<div class="container">
    <h4>Confirm delete</h4>
    <p>Are you sure you want to delete your account</p>
    <form action="" method="post">
    <input type="submit" value="yes" name="yes" />
    <input type="submit" value="no" name="no"/>
    </form>
</div>

<?php 

    if(isset($_POST['yes'])) {
        $delete_account = mysqli_query($con, "DELETE FROM users WHERE id='$_SESSION[user_id]' ");

        session_destroy();

        echo "<script> alert ('Your account has been deleted') </script>";
        echo "<script>window.open('index.php', '_self')</script>";
    }
    if(isset($_POST['no'])) {
        echo "<script>window.open(window.location.href, '_self')</script>";
    }
?>