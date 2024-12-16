<main>
    <article>
    <?php 
    include './config/database.php';
    $productController = new Product_Controller($db);
    if(isset($result)){
        ?>
        <div id="cart">
            <div class="main-cart">
                <div class="all-cart">
                    <h1>Giỏ Hàng Của Tôi</h1>
                    <table id="all-cart">
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Tổng</th>
                            <th></th>
                        </tr>
                        <?php 
                        // Tổng tiền
                        $total = 0;
                        foreach ($result as $cart):
                            ?>
                            <tr class="aCartItem">
                                <td class="infc-product">
                                    <img src="./assets/image/<?= $cart['image'] ?>" width="100px" alt="">
                                    <span><?= $cart['productName'] ?></span>
                                </td>
                                <td><?= number_format($cart['price'], 0, ',', '.') ?>₫</td>
                                <td>
                                    <!-- Số lượng hàng tồn kho -->
                                    <?php 
                                        $db = require './config/database.php';
                                        $productController = new Product_Controller($db);
                                        $quantityOld = $productController->quantityOld($cart['productId']);
                                        $maxQuantity = $cart['quantityPrd'] - $quantityOld;
                                    ?>
                                    <input type="hidden" id="max-qtt" value="<?= $maxQuantity ?>">
                                    <div class="control-quantity" id="ctrQttCart">
                                        <button type="button" class="down-qtt-cart"><i class="fa-solid fa-minus"></i></button>
                                        <input type="number" min="1" value="<?= $cart['quantity'] ?>" readonly class="update_quantity_cart">
                                        <button type="button" class="up-qtt-cart"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <!-- Dữ liệu ẩn gốc -->
                                    <input type="hidden" value="<?= $cart['price'] ?>" class="defaultTotalPrice">
                                    <!-- Dữ liệu ẩn sau khi thao tác -->
                                    <input type="hidden" value="<?= $cart['price'] * $cart['quantity'] ?>" class="afterTotalPrice">
                                    <div class="totalPrice">
                                        <?php
                                            $subTotal = $cart['price'] * $cart['quantity'];
                                            echo number_format($subTotal, 0, ',', '.') . "₫";
                                        ?>
                                    </div>
                                </td>
                                <th>
                                    <button class="delete-cart">
                                        <!-- Dữ liệu ẩn -->
                                        <input type="hidden" class="productId" value="<?= $cart['productId'] ?>">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </th>
                            </tr>
                            <?php 
                            $total += $subTotal;
                        endforeach
                        ?>
                    </table>
                </div>
            </div>
            <div class="sub-cart">
                <div class="box-sub-cart">
                    <div class="title-sub-cart">
                        Tóm Tắt Đơn Hàng
                    </div>
                    <div class="row-infor">
                        <span>Tổng Tạm Tính</span>
                        <span id="subTotal"><?= number_format($total, 0, ',', '.') ?>₫</span>
                    </div>
                    <div class="row-infor">
                        <span>Phí Vận Chuyển</span>
                        <span><span id="totalShip">Miễn phí</span></span>
                    </div>
                    <div class="title-sub-cart">
                        <span>Tổng Cộng</span>
                        <span id="total"><?= number_format($total, 0, ',', '.') ?>₫</span>
                    </div>
                </div>
                <button class="checkout-btn">
                    <a href="?page=checkout">Thanh Toán</a>
                </button>
            </div>
        </div>
        <?php 
        $productController->noFilterOrSearch("./component/maylike.php", require './config/database.php');
    }else{
        ?>
        <div class="empty-cart">
            <img src="./assets/image/empty-cart.png" width="100px" alt="">
            <span>Giỏ hàng của bạn đang trống</span>
            <a href="?page=home">Mua ngay</a>
        </div>
        <?php 
        $productController->noFilterOrSearch("./component/maylike.php", require './config/database.php');
    }
    ?>
    </article>
</main>
<!-- JAVASCRIPT -->
<script src="./assets/javascript/update-quantity-cart.js"></script>
<script src="./assets/javascript/delete-cart.js"></script>
<script src="./assets/javascript/search.js"></script>
