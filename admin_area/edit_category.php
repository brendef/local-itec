<?php 
    $edit_category = mysqli_query($con, "SELECT * FROM categories WHERE id = '$_GET[category_id]' ");
    $fetch_edit = mysqli_fetch_array($edit_category);
?>
    <div class="container product-insert-page my-3 py-3">
        <div class="d-flex flex-column col-lg-6">
            <h4 class="mb-5">Edit Category</h4>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="category_name">Category Name:</label>
                    <input id="category_name" type="text" name="category_name" value="<?php echo $fetch_edit['title']; ?>" class="form-control" required />
                </div>
                <button type="submit" name="edit_category" class="btn btn-dark mb-2">Save Changes</button>
            </form>
        </div>
        <div class="col-lg-6"></div>
    </div>
</body>
</html>

<?php 

    if(isset($_POST['edit_category'])) {
        $category_name = $_POST['category_name'];

        $update_category = mysqli_query($con, "UPDATE categories SET title='$category_name' WHERE id='$_GET[category_id]' ");

        if($update_category) {
            echo "<script> alert('Category updated successfully') </script>"; 
            echo "<script> window.open(window.location.href, '_self') </script>";
        }

    }

?>