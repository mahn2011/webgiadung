<?php 
class Product_Controller{
    private $db;
    private $categoryModel;
    private $productModel;
    public function __construct(mysqli $db){
        $this->db = $db;
        $this->categoryModel = new Category_Model($this->db);
        $this->productModel = new Product_Model($this->db);
    }
    function showProductList(){
        $result = $this->productModel->showProductList();
        include './products/products.php';
    }
    function showProductListWeb(){
        $products = $this->productModel->showProductList();
        include './component/products.php';
    }
    function noFilterOrSearch($url, $db){
        $maylike = $this->productModel->showProductList();
        include $url;
    }
    function addProduct(){
        $categories = $this->categoryModel->showCategoriesList();
        $result = $this->productModel->createProduct();
        include './products/add-product.php';
    }
    function editProduct(){
        $dataOld = $this->productModel->dataProductOld();
        if(isset($dataOld)){
            $categories = $this->categoryModel->showCategoriesList();
            $result = $this->productModel->editProduct();
            include './products/edit-product.php';
        }else{
            header("Location: ../404/");
        }
    }
    function deleteProduct(){
        $result = $this->productModel->showProductList();
        $alertDelete = $this->productModel->deleteProduct();
        include './products/products.php';
    }
    function updateStatusProduct(){
        $alertUpdate = $this->productModel->updateStatusProduct();
        include './products/products.php';
    }
    function detailsProduct(){
        $result = $this->productModel->detailsProduct();
        include './products/details-product.php';
    }
    function detailsProductWeb(){
        $quantityOnCart = $this->productModel->quantityProductOnCart();
        $product = $this->productModel->detailsProduct();
        if($product !== "Lỗi"){
            include './views/product-detail.php';
        }else{
            include './views/home.php';
        }
    }
    function filterProduct(){
        $products = $this->productModel->filterProduct();
        include '../component/filter-products.php';
        if(is_null($products)){
            $this->noFilterOrSearch("../component/maylike.php", require '../config/database.php');
        }
    }
    function searchProduct(){
        require_once '../component/functionsHTML.php';
        $products = $this->productModel->search();
        include '../component/search.php';
        if(is_null($products)){ // Nếu không có sản phẩm nào
            $this->noFilterOrSearch("../component/maylike.php",require '../config/database.php');
            require_once '../component/functionsHTML.php';
        }
    }
    function addImageProduct(){
        $result = $this->productModel->addImageProduct();
        return $result;
    }
    function showAImageMore(){
        $result = $this->productModel->showAListImageMore();
        include '../admin/products/images.php'; 
    }
    function deleteImageMore(){
        $alertDelete = $this->productModel->deleteImageMore();
        include '../admin/products/images.php';
    }
    function showListImageWeb(){
        $images = $this->productModel->showListImageWeb();
        return $images;
    }
    function quantityOld($productId){
        return $this->productModel->quantityOld($productId);
    }
}
?>