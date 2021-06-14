<?php include("include/header.php"); ?>
<div class="container">
    <ul class="categories">
        <span class="btn btn-outline-dark d-none d-lg-block">Categories:</span>
        <?php 
            echo "<li><a class='btn btn-dark mx-3' href='/'>All Food</a></li>";
            getCategories();
        ?>
    </ul>
    <?php cart(); ?>
    <div class="products">
        <div class="row">
            <?php 
                getProducts(); 
            ?>
            <?php get_products_by_category_id(); ?>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>