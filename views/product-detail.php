<main>
    <article>
    <div id="product-details">
        <div class="image-pdts">
            <div class="image-main-pdts">
                <img id="imageMain" src="./assets/image/<?= $product['image'] ?>" alt="">
            </div>
        </div>
        <div class="information-pdts">
            <div class="infor-top">
                <div class="title-pdts">
                    <?= $product['productName'] ?>
                </div>
                <div class="quantity-sold-commment-pdts">
                    <span>
                        Lượt đánh giá:
                        <?php
                        $db = include './config/database.php';
                        $commentController = new Comment_Controller($db);
                        echo $commentController->quantityComment();
                        ?>
                    </span>
                </div>
                <div class="discount-pdts">
                    Giảm giá: <?= $product['discount'] ?> %
                </div>
                <!-- /* -------------------------------- QUANTITY -------------------------------- */ -->
                <div class="quantity-sold-commment-pdts keclass">
                    <?php 
                    $db = require './config/database.php';
                    $productController = new Product_Controller($db);
                    $quantityOld = $productController->quantityOld($product['id']);
                    $quantity = $product['quantity'];
                    if($quantityOld >= $quantity){
                        messRed("Sold old");
                    }else{
                        echo "Đã bán: " . $quantityOld . " / " . $quantity;
                    }
                    ?>
                </div>
                <!-- /* -------------------------------- QUANTITY -------------------------------- */ -->
                <div class="quantity-sold-commment-pdts keclass">Bảo hành: 1 tháng</div>
                <div class="quantity-sold-commment-pdts keclass">Vận chuyển: Miễn phí</div>
                <div class="price-pdts">
                    <?php 
                    if($product['discount'] > 0){
                        ?><span class="cost-pdts"><?= number_format($product['price']) ?> VNĐ</span><?php //HTML
                    }
                    ?>
                    <span class="price-pdts-end">
                        <?php 
                            $price = $product['price'] - ($product['price'] * $product['discount'] / 100);
                            ?><span><?= number_format($price) ?> VNĐ</span><?php //HTML
                        ?>
                    </span>
                </div>
                <!-- /* ------------------------------- ADD TO CART ------------------------------ */ -->
                <?php 
                    if($quantityOld !== $quantity){ // Kiểm tra xem hàng trong kho đã bán hết chưa
                        ?>
                        <form action="" method="POST" onsubmit="return false">
                            <!-- /* -------------------------- SỐ LƯỢNG HÀNG TỒN KHO ------------------------- */ -->
                            <input hidden type="number" readonly id="max-qtt" value="<?= $quantity - $quantityOld ?>">
                            <!-- /* -------------------------- SỐ LƯỢNG HÀNG TỒN KHO ------------------------- */ -->
                            <!-- /* -------------------------- SỐ LƯỢNG MAX BÊN CART ------------------------- */ -->
                            <input hidden type="number" readonly id="max-qtt-on-cart" value="<?= $quantityOnCart ?>">
                            <!-- /* -------------------------- SỐ LƯỢNG MAX BÊN CART ------------------------- */ -->
                            <div class="control-quantity">
                                <input type="hidden" id="productId" value="<?= (isset($_GET["id"])) ? $_GET["id"] : "" ?>">
                                <button type="button" id="down-qtt"><i class="fa-solid fa-minus"></i></button>
                                <input type="number" value="1" id="quantity_add_cart">
                                <button type="button" id="up-qtt"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <button type="submit" id="add-to-cart">Thêm vào giỏ hàng</button>
                        </form>
                        <?php // HTML
                    }
                ?>
                <!-- /* ------------------------------- ADD TO CART ------------------------------ */ -->
            </div>
            <div class="sub-image-pdts">
                <?php 
                $productController = new Product_Controller($db);
                $images = $productController->showListImageWeb();
                if(!is_null($images)){
                    $idDOM = 1;
                    $totalIdDOM = 0;
                    foreach($images as $image){
                        $number = $idDOM++;
                        ?>
                        <div class="box-subimage">
                            <img id="nextImageMore<?= $number ?>" onmouseover="nextImage(<?= $number ?>)" src="./assets/image/<?= $image['image'] ?>" alt="">
                        </div>
                        <?php // HTML
                        $totalIdDOM++;
                    }
                }
                ?>
                <!-- SỐ LƯỢNG ẢNH -->
                <input type="hidden" value="<?= $totalIdDOM ?>" id="quantitySubImage">
                <!-- SỐ LƯỢNG ẢNH -->
            </div>
        </div>
    </div>
    <div class="infor-more">
        <div class="detais-description-pdts">
            <div class="title-details-description-pdts">
                Mô tả sản phẩm
            </div>
            <div class="content-details-description-pdts">
                <?= $product['details'] ?>
            </div>
            <div class="title-details-description-pdts">
                Chi tiết sản phẩm
            </div>
            <div class="content-details-description-pdts">
                <?= $product['description'] ?>
            </div>
            <!-- /* ------------------------------- ALL PRODUCT ------------------------------ */ -->
            <?php 
            $commentController = new Comment_Controller($db);
            $productController = new Product_Controller($db);
            $commentController->showListCommentForProduct();
            $productController->showProductListWeb();
            ?>
            <!-- /* ------------------------------- ALL PRODUCT ------------------------------ */ -->
        </div>
        <!-- /* ---------------------------------- CODE DISCOUNT --------------------------------- */ -->
        <div class="all-discounts">
            <?php 
                for($i = 0; $i<9;$i++){
                    ?>
                        <div class="item-code-discount">
                            <div class="infor-item-code">
                                <span>Giảm 10%</span>
                                <span>Cho đơn hàng từ 200k</span>
                                <span>Tối đa 50k</span>
                                <span class="hsd">12/12/2024</span>
                            </div>
                            <div class="add-code-discount">
                                <button>Lấy mã</button>
                            </div>
                        </div>
                        <?php //HTML
                }
                ?>
        </div>
        <!-- /* ---------------------------------- CODE DISCOUNT --------------------------------- */ -->
    </div>
    </article>
</main>
<!-- /* ----------------------------------- JAVASCRIPT ----------------------------------- */ -->
<script src="./assets/javascript/comment.js"></script>
<script src="./assets/javascript/delete-comment.js"></script>
<script src="./assets/javascript/add-to-cart.js"></script>
<script src="./assets/javascript/quantity-actions.js"></script>
<script src="./assets/javascript/product-detail.js"></script>
<script src="./assets/javascript/search.js"></script>
<!-- /* ----------------------------------- JAVASCRIPT ----------------------------------- */ -->