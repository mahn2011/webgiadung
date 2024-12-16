<?php
$db = include './config/database.php';
$categoryController = new Category_Controller($db);
$productController = new Product_Controller($db);
$bannerController = new Banner_Controller($db);
?>
<main>
    <div id="home">
        <?= $categoryController->showCategoriesAside() ?>
        <article>
            <?= $bannerController->showBannerListWeb() ?>
            <?= $productController->showProductListWeb() ?>
        </article>
    </div>
</main>
<!-- /* ------------------------------- JAVASCRIPT ------------------------------- */ -->
<script src="./assets/javascript/filter-product.js"></script>
<script src="./assets/javascript/search.js"></script>
<!-- /* ------------------------------- JAVASCRIPT ------------------------------- */ -->