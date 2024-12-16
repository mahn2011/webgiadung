<!-- /* --------------------------------- ROUTER --------------------------------- */ -->
<?php
include '../component/functionsHTML.php';
/* ---------------------------------- MODEL --------------------------------- */
include '../models/product-model.php';
include '../models/category-model.php';
include '../models/order-model.php';
include '../models/comment-model.php';
include '../models/banner-model.php';
include '../models/email-model.php';
include '../models/statistical-model.php';
/* ---------------------------------- MODEL --------------------------------- */
/* ---------------------------------- CONTROLLER --------------------------------- */
include '../controllers/product-controller.php';
include '../controllers/category-controller.php';
include '../controllers/order-controller.php';
include '../controllers/comment-controller.php';
include '../controllers/banner-controller.php';
include '../controllers/email-controller.php';
include '../controllers/statistical-controller.php';
/* ---------------------------------- CONTROLLER --------------------------------- */
/* ---------------------------------- AUTH ---------------------------------- */ 
include './auth-role.php'; // Xác thực quyền
// controller và model user nằm trong auth-role
/* ---------------------------------- AUTH ---------------------------------- */ 
define("ROOM", isset($_GET["room"]) ? $_GET["room"] : "");
define("ACTION", isset($_GET["action"]) ? $_GET["action"] : "");
/* -------------------------------- VIEW MAIN ------------------------------- */
$db = require '../config/database.php';
$userController = new User_Controller($db);
$categoryController = new Category_Controller($db);
$productController = new Product_Controller($db);
$orderController = new Order_Controller($db);
$commentController = new Comment_Controller($db);
$bannerController = new Banner_Controller($db);
$emailController = new Email_Controller($db);
$statisticalController = new Statistical_Controller($db);
if (!empty(ROOM)) {
    if (ROOM === 'statistical') {
        $statisticalController->statisticalOrder();
    }elseif (ROOM === 'users') {
        $userController->disableBomm();
        $userController->showUserList();
    }elseif (ROOM === 'information-user') {
        $userController->showInformationUser();
    }elseif(ROOM === 'logs'){
        $userController->showLogs();
    }elseif (ROOM === 'products') {
        $productController->showProductList();
    }elseif (ROOM === 'add-product') {
        $productController->addProduct();
    }elseif (ROOM === 'edit-product') {
        $productController->editProduct();
    }elseif (ROOM === 'images') {
        $productController->showAImageMore();
    }elseif (ROOM === 'banners') {
        $bannerController->showBannerList();
    }elseif(ROOM === 'add-banner'){
        include './banners/add-banner.php';
    }elseif(ROOM === 'edit-banner'){
        $bannerController->editBanner();
    }elseif (ROOM === 'details-product') {
        $productController->detailsProduct();
    }elseif (ROOM === 'add-category') {
        include './categories/add-category.php';
    }elseif (ROOM === 'edit-category') {
        $categoryController->editCategory();
    }elseif (ROOM === 'categories') {
        $categoryController->showCategories();
    }elseif (ROOM === 'orders') {
        $orderController->showOrderList();
    }elseif(ROOM === 'order-details'){
        $orderController->showOrderDetails();
    }elseif (ROOM === 'note-details') {
        $orderController->showNoteOrder();
    }elseif(ROOM === 'comments'){
        $commentController->showListComment();
    }elseif(ROOM === 'comment-details'){
        $commentController->showListCommentDetails();
    }elseif(ROOM === 'emails'){
        $emailController->showEmailList();
    }elseif(ROOM === 'email-details'){
        $emailController->showMessageEmail();
    }elseif(ROOM === 'reply-email'){
        include './emails/reply-email.php';
    }
    // NOT FOUND
    else {
        header("Location: ../404/");
    }
    // NOT FOUND
}
/* -------------------------------- VIEW MAIN ------------------------------- */
/* --------------------------------- ACTION --------------------------------- */
if(!empty(ACTION)){
    if(ACTION === 'updateUser'){
        $userController->updateUser();
        header("Location: ./?room=users");
    }elseif(ACTION === 'add-category'){
        $categoryController->addCategory();
    }elseif(ACTION === 'edit-category'){
        $categoryController->editCategory();
    }elseif(ACTION === 'delete-category'){
        $categoryController->deleteCategory();
    }elseif(ACTION === 'add-product'){
        $productController->addProduct();
    }elseif(ACTION === 'edit-product'){
        $productController->editProduct();
    }elseif(ACTION === 'update-status-product'){
        $productController->updateStatusProduct();
    }elseif(ACTION === 'delete-product'){
        $productController->deleteProduct();
    }elseif(ACTION === 'delete-image'){
        $productController->deleteImageMore();
    }elseif(ACTION === 'receive-order'){
        $orderController->receiveOrder();
    }elseif(ACTION === 'update-order'){
        $orderController->updateOrder();
    }elseif(ACTION === 'delete-order'){
        $orderController->deleteOrder();
    }elseif(ACTION === 'delete-order-details'){
        $orderController->deleteOrderDetails();
    }elseif(ACTION === 'delete-comment'){
        $commentController->deleteCommentAdmin();
    }elseif(ACTION === 'update-rate-comment'){
        $commentController->updateRateComment();
    }elseif(ACTION === 'delete-comment-details'){
        $commentController->deleteCommentDetails();
    }elseif(ACTION === 'add-banner'){
        $bannerController->addBanner();
    }elseif(ACTION === 'edit-banner'){
        $bannerController->editBanner();
    }elseif(ACTION === 'update-banner'){
        $bannerController->updateBanner();
    }elseif(ACTION === 'delete-banner'){
        $bannerController->deleteBanner();
    }elseif(ACTION === 'delete-email'){
        $emailController->deleteEmail();
    }elseif(ACTION === 'reply-email'){
        $emailController->replyEmail();
    }
}
/* --------------------------------- ACTION --------------------------------- */
?>
<!-- /* --------------------------------- ROUTER --------------------------------- */ -->
