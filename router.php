<?php
session_start();
if(isset($_SESSION["user"])){
    $ss_role = (isset($_SESSION["user"])) ? $_SESSION["user"]['role'] : "" ;
    $ss_id = (isset($_SESSION["user"])) ? $_SESSION["user"]['id'] : "" ;
}
define("PAGE", (isset($_GET["page"])) ? $_GET["page"] : ""); 
define("ACTION", (isset($_GET["action"])) ? $_GET["action"] : "");
define("CATEGORY", (isset($_GET["category"])) ? $_GET["category"] : "") ;
include './component/functionsHTML.php';
/* ---------------------------------- MODEL --------------------------------- */
include './models/user-model.php';
include './models/category-model.php';
include './models/product-model.php';
include './models/comment-model.php';
include './models/banner-model.php';
include './models/cart-model.php';
include './models/order-model.php';
/* ---------------------------------- MODEL --------------------------------- */
/* ---------------------------------- CONTROLLER --------------------------------- */
include './controllers/user-controller.php';
include './controllers/category-controller.php';
include './controllers/product-controller.php';
include './controllers/comment-controller.php';
include './controllers/banner-controller.php';
include './controllers/cart-controller.php';
include './controllers/order-controller.php';
/* ---------------------------------- CONTROLLER --------------------------------- */
/* --------------------------------- HEADER --------------------------------- */
if(PAGE === 'admin'){
    // ADMIN
}else{
    include './layout/header.php';
}
/* --------------------------------- HEADER --------------------------------- */
$db = require './config/database.php';
$userController = new User_Controller($db);
$productController = new Product_Controller($db);
$categoryController = new Category_Controller($db);
$commentController = new Comment_Controller($db);
$bannerController = new Banner_Controller($db);
$cartController = new Cart_Controller($db);
$orderController = new Order_Controller($db);
/* -------------------------------- VIEW MAIN (ROUTER) ------------------------------- */
if(!empty(PAGE)){
    if(PAGE === 'home'){
        include './views/home.php';
    }elseif(PAGE === 'details'){
        $productController->detailsProductWeb();
    }elseif(PAGE === 'cart'){
        $cartController->showCartList();
    }elseif(PAGE === 'checkout'){
        $cartController->showCartListPageCheckout();
    }elseif(PAGE === 'contact'){
        include './views/contact.php';
    }elseif(PAGE === 'blogs'){
        include './views/blogs.php';
    }elseif(PAGE === 'profile'){
        $userController->showInformationOneUser();
    }elseif(PAGE === 'admin'){
        header("Location: ./admin/?room=statistical");
    }
    // NOT FOUND
    else{
        ?><script>window.location = './404/'</script><?php
    }
    // NOT FOUND
}else{ 
    include './views/home.php';
}
/* -------------------------------- VIEW MAIN (ROUTER) ------------------------------- */
/* --------------------------------- ACTION --------------------------------- */
if(ACTION === 'cancel-order'){
    $orderController->cancelOrder();
}
/* --------------------------------- ACTION --------------------------------- */
/* --------------------------------- LOADING -------------------------------- */
include './component/loading.php';
/* --------------------------------- LOADING -------------------------------- */
/* --------------------------------- FOOTER --------------------------------- */
if(PAGE === 'admin'){
    // ADMIN
}else{
    include './layout/footer.php';
}
/* --------------------------------- FOOTER --------------------------------- */
?>