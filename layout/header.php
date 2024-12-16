<header style="background-color: white !important;">
    <div class="sub-head">
        <p><i class="fa-regular fa-envelope"></i> hello@colorlib.com | Miễn phí vận chuyển cho tất cả đơn hàng từ 200k</p>
        <div class="app-sub-head">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-twitter"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-pinterest-p"></i></a>
        </div>
    </div>
    <div class="header-top">
        <div class="logo">
            <a href="?page=home">
                <span><i class="fa-solid fa-robot"></i> MANGA SHOP</span>
                <!-- <img src="https://themewagon.github.io/ogani/img/logo.png" width="100px" alt=""> -->
            </a>
        </div>
        <!-- /* ----------------------------- SEARCH DESKTOP ----------------------------- */ -->
        <form method="POST" action="" class="search" onsubmit="return false">
            <input type="text" name="keyword" id="keyword" placeholder="Tìm kiếm">
            <button name="search" id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <!-- /* ----------------------------- SEARCH DESKTOP ----------------------------- */ -->
        <div class="bell-cart-user">
            <a href="#">
                <i class="fa-regular fa-heart"></i>
            </a>
            <a href="?page=cart">
                <i class="fa-solid fa-bag-shopping"></i>
                <span id="quantityCart">
                    <?php
                    $db = require './config/database.php';
                    $newCartCtrl = new Cart_Controller($db);
                    echo $newCartCtrl->quantityCart();
                    ?>
                </span>
                <input type="hidden" id="quantityCartOld" value="<?= $newCartCtrl->quantityCart() ?>">
            </a>
            <?php
            if(isset($ss_role) && isset($ss_id)){ // Kiểm tra đã đăng nhập chưa
                ?>
                <div class="user">
                    <i class="fa-regular fa-user"></i>
                    <div class="profile-item">
                        <a href="?page=profile"><i class="fa-regular fa-user"></i> Tài khoản</a>
                        <!-- NHỚ VALIDATE  -->
                        <?php 
                        if($ss_role === "admin" || $ss_role === "staff"){
                            ?><a href="?page=admin"><i class="fa-solid fa-screwdriver-wrench"></i> Quản trị</a><?php // HTML
                        }
                        ?>
                        <!-- NHỚ VALIDATE  -->
                        <a href="./auth/?action=logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất</a>
                    </div>
                </div>
                <?php //HTML
            }else{
                ?><a href="./auth/?action=logout"><i class="fa-solid fa-arrow-right-to-bracket"></i></a><?php // HTML
            }
            ?>
        </div>
        <!-- /* --------------------------- FORM SEARCH MOBILE --------------------------- */ -->
        <form method="POST" action="" class="search search-mobile" onsubmit="return false">
            <input type="text" name="keyword" id="keyword_mobile" placeholder="Tìm kiếm">
            <button name="search" id="search_mobile"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <!-- /* --------------------------- FORM SEARCH MOBILE --------------------------- */ -->
    </div>
    <!-- /* ----------------------------------- NAV ---------------------------------- */ -->
    <nav>
        <ul>
            <li><a href="./">Trang chủ</a></li>
            <li><a href="./">Giới thiệu</a></li>
            <li><a href="./">Cửa hàng</a></li>
            <li><a href="./">Bài viết</a></li>
            <li><a href="?page=contact">Liên hệ</a></li>
        </ul>
    </nav>
    <!-- /* ----------------------------------- NAV ---------------------------------- */ -->
</header>