<link rel="stylesheet" href="./assets/css/checkout.css">
<main>
    <article>
    <div id="checkout">
        <div class="main-cart">
            <div class="all-cart">
                <h1>Thanh Toán</h1>
                <table id="all-cart">
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng</th>
                    </tr>
                    <?php
                    // Tổng tiền
                    $total = 0;
                    foreach ($result as $cart):
                        ?>
                        <tr class="aCartItem">
                            <td class="infc-product">
                                <img src="./assets/image/<?= $cart['image'] ?>" width="100px" alt="">
                                <span>
                                    <?= $cart['productName'] ?>
                                </span>
                            </td>
                            <td>
                                <?= number_format($cart['price'], 0, ',', '.') ?>₫
                            </td>
                            <td class="quantity-checkout">
                                <input type="number" min="1" value="<?= $cart['quantity'] ?>" readonly class="update_quantity_cart">
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
                        </tr>
                        <?php 
                        $total += $subTotal;
                    endforeach;
                    ?>
                </table>
            </div>
            <input id="total" type="hidden" value="<?= $total ?>">
            <span class="quantity-checkout">Tổng: <?= number_format($total, 0, ',', '.') ?>₫</span>
        </div>
        <div class="information-checkout">
            <!-- Lấy thông tin người dùng cũ -->
            <?php 
            $db = require './config/database.php';
            $userController = new User_Controller($db);
            $dataOld = $userController->showInformationUserOld();
            ?>
            <div><span class="title-inff">Thông Tin Đặt Hàng</span></div>
            <div>
                <label for="fullName">Họ và Tên</label>
                <input type="text" name="full-name" id="fullname" placeholder="Nhập Họ và Tên" value="<?= (!is_null($dataOld)) ? $dataOld['fullName'] : "" ?>">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Nhập Email" value="<?= (!is_null($dataOld)) ? $dataOld['email'] : "" ?>">
            </div>
            <div>
                <label for="address">Địa Chỉ</label>
                <input type="text" name="address" id="address" placeholder="Nhập Địa Chỉ" value="<?= (!is_null($dataOld)) ? $dataOld['address'] : "" ?>">
            </div>
            <div>
                <label for="numberphone">Số Điện Thoại</label>
                <input type="text" name="numberphone" id="numberphone" placeholder="Nhập Số Điện Thoại" value="<?= (!is_null($dataOld)) ? $dataOld['numberphone'] : "" ?>">
            </div>
            <div>
                <label for="note">Ghi Chú</label>
                <input type="text" name="note" id="note" placeholder="Nhập Ghi Chú">
            </div>
            <button id="CHECKOUT" class="btn-53">
                <div class="original">Thanh Toán</div>
                <div class="letters">
                    <span>T</span>
                    <span>H</span>
                    <span>A</span>
                    <span>N</span>
                    <span>H</span>
                    <span> </span>
                    <span>T</span>
                    <span>O</span>
                    <span>Á</span>
                    <span>N</span>
                </div>
            </button>
        </div>
    </div>
    </article>
</main>
<!-- Scripts -->
<script src="./assets/javascript/checkout.js"></script>
<script src="./assets/javascript/search.js"></script>
