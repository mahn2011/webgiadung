<?php 
class Product_Model{
    private $db;
    function __construct(mysqli $db){
        $this->db = $db;
    }
    /* ---------------------------- SHOW PRODUCT LIST --------------------------- */
    function showProductList(){
        $stmt = $this->db->prepare("SELECT * FROM products");
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                return $result;
            }
        }
    }
    /* ---------------------------- SHOW PRODUCT LIST --------------------------- */
    /* ---------------------------- SHOW PRODUCT LIST OPTION --------------------------- */
    function showProductListBycategory($categoryId, $titleCategory){
        $stmt = $this->db->prepare("SELECT * FROM products WHERE categoryId = ?");
        $stmt->bind_param("i", $categoryId);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                return $result;
            }
        }
    }
    /* ---------------------------- SHOW PRODUCT LIST OPTION --------------------------- */
    /* ---------------------------- ADD PRODUCT --------------------------- */
    function createProduct(){
        $mess = "";
        
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            if(isset($_POST["add-product"])){
                $categoryId = $_POST["categoryId"];
                $image = $_FILES['image']['name'];
                $productName = $_POST["productName"];
                $price = $_POST["price"];
                $discount = $_POST["discount"];
                $quantity = $_POST["quantity"];
                $description = $_POST["description"];
                $details = $_POST["details"];
                $status = "none";
                
                if(!empty($productName) && !empty($image) && !empty($categoryId) && !empty($price) && !empty($quantity) && !empty($description) && !empty($details)){
                    $stmt = $this->db->prepare("INSERT INTO products(`categoryId`, `image`,`productName`,`price`,`discount`,`quantity`,`description`,`details`,`status`)VALUES (?,?,?,?,?,?,?,?,?) ");
                    $stmt->bind_param("issiiisss", $categoryId, $image, $productName, $price, $discount, $quantity, $description, $details, $status);
                    if($stmt->execute()){
                        $mess = "Thành công";
                    }else{
                        $mess = "Lỗi";
                    }
                }else{
                    $mess = "Chưa nhập đầy đủ thông tin";
                }
            }
        }
        return $mess;
    }
    /* ---------------------------- ADD PRODUCT --------------------------- */
    /* ---------------------------- DATA PRODUCT OLD --------------------------- */
    function dataProductOld(){
        $id = (isset($_GET["id"])) ? $_GET["id"] : "";
        if(!empty($id)){
            $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            if($stmt->execute()){
                $result = $stmt->get_result();
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    return $row;
                }
            }
        }
    }
    /* ---------------------------- DATA PRODUCT OLD --------------------------- */
    /* ---------------------------- EDIT PRODUCT --------------------------- */
    function editProduct(){
        $mess = "";
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            if(isset($_POST["edit-product"])){
                $id = (isset($_GET["id"])) ? $_GET["id"] : "";
                $categoryId = $_POST["categoryId"];
                $image = $_FILES['image']['name'];
                if($image === ""){
                    $image = $_POST["imageOld"];
                }
                $productName = $_POST["productName"];
                $price = $_POST["price"];
                $discount = $_POST["discount"];
                $quantity = $_POST["quantity"];
                $description = $_POST["description"];
                $details = $_POST["details"];
    
                if(!empty($id) && !empty($productName) && !empty($categoryId) && !empty($price) && !empty($quantity) && !empty($description) && !empty($details)){
                    $stmt = $this->db->prepare("UPDATE products SET categoryId = ?, image = ?, productName = ?, price = ?, discount = ?, quantity = ?, 
                    description = ?, details = ? WHERE id = ?");
                    $stmt->bind_param("issiiissi", $categoryId, $image, $productName, $price, $discount, $quantity, $description, $details, $id);
                    if($stmt->execute()){
                        $mess = "Thành công";
                    }else{
                        $mess = "Lỗi";
                    }
                }else{
                    $mess = "Chưa nhập đầy đủ thông tin";
                }
            }
        }
        return $mess;
    }
    /* ---------------------------- EDIT PRODUCT --------------------------- */
    /* ----------------------------- DELETE PRODUCT ----------------------------- */
    function deleteProduct(){
        $mess = "";
        $id = (isset($_GET["id"])) ? $_GET["id"] : "";
        if(!empty($id)){
            $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            if($stmt->execute()){
                $mess = "Thành công";
            }else{
                $mess = "Lỗi";
            }
        }else{
            $mess = "Lỗi";
        }
        return $mess;
    }
    /* ----------------------------- DELETE PRODUCT ----------------------------- */
    /* ----------------------------- UPDATE STATUS PRODUCT ----------------------------- */
    function updateStatusProduct(){
        $mess = "";
        $id = (isset($_GET["id"])) ? $_GET["id"] : "";
        $action = (isset($_POST["action"])) ? $_POST["action"] : "";
        if(isset($action)){
            if(!empty($id) && is_numeric($id) && !empty($action)){
                $stmt = $this->db->prepare("UPDATE products SET status = ? WHERE id = ?");
                $stmt->bind_param("si", $action, $id);
                if($stmt->execute()){
                    $mess = "Cập nhật thành công";
                }else{
                    $mess = "Lỗi";
                }
            }else{
                $mess = "Lỗi";
            }
        }
        return $mess;
    }
    /* ----------------------------- UPDATE STATUS PRODUCT ----------------------------- */
    /* ----------------------------- DETAILS PRODUCT ----------------------------- */
    function detailsProduct(){
        $mess = "";
        $id = (isset($_GET["id"])) ? $_GET["id"] : "";
        if(isset($id) && !empty($id)){
            $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            if($stmt->execute()){
                $result = $stmt->get_result();
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    return $row;
                }else{
                    $mess = "Lỗi";
                    return $mess;
                }
            }
        }else{
            $mess = "Lỗi";
            return $mess;
        }
    }
    /* ----------------------------- DETAILS PRODUCT ----------------------------- */
    /* ----------------------------- TOP PRODUCT ----------------------------- */
    function topProduct(){
        $productOld = $this->db->prepare("SELECT id FROM products");
        $productOld->execute();
        $result_productOld = $productOld->get_result();
        $data = [];
        while($row_productOld = $result_productOld->fetch_assoc()){ // Duyệt qua từng sản phẩm đã bán 
            $productId = $row_productOld['id'];
            $quantity = $this->db->prepare("SELECT SUM(quantity) AS totalQuantity FROM orderdetails WHERE productId = ?");
            $quantity->bind_param("i", $productId);
            $quantity->execute();
            $result_quantity = $quantity->get_result();
            $row_quantity = $result_quantity->fetch_assoc();
            $data[] = [
                "productId" => $productId,
                "totalQuantity" => $row_quantity['totalQuantity']
            ];
        }
        usort($data, function($a, $b){ // Sắp xếp mảng theo tổng số lượng giảm dần
            return $b['totalQuantity'] - $a['totalQuantity'];
        });
        $top5 = array_slice($data,0,10); // Lấy số lượng sản phẩm bán chạy nhất (giảm dần) - mảng, bắt đầu, kết thúc
        $dataTop5Product = [];
        foreach ($top5 as $product){
            $id = $product['productId'];
            $inforTop5 = $this->db->prepare("SELECT * FROM products WHERE id = ?");
            $inforTop5->bind_param("i", $id);
            $inforTop5->execute();
            $result = $inforTop5->get_result();
            $row = $result->fetch_assoc();
            $dataTop5Product[] = $row; 
        }
        return $dataTop5Product;
    }
    /* ----------------------------- TOP PRODUCT ----------------------------- */
    /* ----------------------------- FILTER PRODUCT ----------------------------- */
    function filterProduct(){
        $mess = "";
        $categoryId = (isset($_GET["categoryId"])) ? $_GET["categoryId"] : "";
        if(!empty($categoryId)){
            $stmt = $this->db->prepare("SELECT * FROM products WHERE categoryId = ?");
            $stmt->bind_param("i", $categoryId);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $products = [];
                while($row = $result->fetch_assoc()){
                    $products[] = $row;
                }
                return $products;
            }
        }
    }
    /* ----------------------------- FILTER PRODUCT ----------------------------- */
    /* ----------------------------- SEARCH PRODUCT ----------------------------- */
    function search(){
        $mess = "";
        $keyword = "%" . (isset($_GET["keyword"]) ? $_GET["keyword"] : "") . "%";
        if(!empty($keyword)){
            $stmt = $this->db->prepare("SELECT * FROM products WHERE productName LIKE ? ");
            $stmt->bind_param("s", $keyword);
            if($stmt->execute()){
                $result = $stmt->get_result();
                if($result->num_rows > 0){
                    $products = [];
                    while($row = $result->fetch_assoc()){
                        $products[] = $row;
                    }
                    return $products;
                }
            }
        }
    }
    /* ----------------------------- SEARCH PRODUCT ----------------------------- */
    /* ----------------------------- QUANTITY COMMENT ----------------------------- */
    function quantityComment(){
        $stmt = $this->db->prepare("SELECT * FROM comments");
        if($stmt->execute()){
            $result = $stmt->get_result();
            $quantity = $result->num_rows;
            return $quantity;
        }
    }
    /* ----------------------------- QUANTITY COMMENT ----------------------------- */
    /* ----------------------------- IMAGE PRODUCT ----------------------------- */
    function addImageProduct(){
        $mess = ""; 
        
        $productId = $_POST["productId"];
        $imageMore = $_POST["imageMore"];
        
        if(!empty($imageMore) && !empty($productId)){
            if(is_numeric($productId)){
                $stmt = $this->db->prepare("INSERT INTO images(`productId`,`image`) VALUES (?,?)");
                $stmt->bind_param("is", $productId, $imageMore);
                if($stmt->execute()){
                    $mess = "Thành công";
                }
            }else{
                $mess = "Lỗi";
            }
        }else{
            $mess = "Chưa nhập đầy đủ thông tin";
        }
        return $mess;
    }
    /* ----------------------------- IMAGE PRODUCT ----------------------------- */
    /* ----------------------------- SHOW LIST IMAGE WEBSITE ----------------------------- */
    function showListImageWeb(){
        $mess = "";
        $productId = (isset($_GET["id"])) ? $_GET["id"] : "";
        if(!empty($productId) && is_numeric($productId)){
            $stmt = $this->db->prepare("SELECT * FROM images WHERE productId = ?");
            $stmt->bind_param("i", $productId);
            if($stmt->execute()){
                $result = $stmt->get_result();
                if($result->num_rows > 0){
                    return $result;
                }
            }else{
                $mess = "Lỗi";
                return $mess;
            }
        }else{
            $mess = "Lỗi";
            return $mess;
        }
    }
    /* ----------------------------- SHOW LIST IMAGE WEBSITE ----------------------------- */
    /* ----------------------------- SHOW 1 LIST IMAGE MORE ----------------------------- */
    function showAListImageMore(){
        $mess = "Lỗi";
        $productId = (isset($_GET["productId"])) ? $_GET["productId"] : "";
        if(!empty($productId) && is_numeric($productId)){
            $stmt = $this->db->prepare("SELECT * FROM images WHERE productId = ?");
            $stmt->bind_param("i", $productId);
            if($stmt->execute()){
                $result = $stmt->get_result();
                if($result->num_rows > 0){
                    return $result;
                }
            }else{
                $mess = "Lỗi";
                return $mess;
            }
        }else{
            $mess = "Lỗi";
            return $mess;
        }
    }
    /* ----------------------------- SHOW 1 LIST IMAGE MORE ----------------------------- */
    /* ----------------------------- DELETE IMAGE MORE ----------------------------- */
    function deleteImageMore(){
        $mess = "";
        $image = (isset($_GET["image"])) ? $_GET["image"] : "";
        if(!empty($image)){
            $stmt = $this->db->prepare("DELETE FROM images WHERE image = ?");
            $stmt->bind_param("s", $image);
            if($stmt->execute()){
                $mess = "Thành công";
            }else{
                $mess = "Lỗi";
            }
        }else{
            $mess = "Lỗi";
        }
        return $mess;
    }
    /* ----------------------------- DELETE IMAGE MORE ----------------------------- */
    /* ------------------------------ QUANTITY OLD ------------------------------ */
    function quantityOld($productId){
        if(!empty($productId) && is_numeric($productId)){
            $stmtQuantityOld = $this->db->prepare("SELECT quantity FROM orderdetails WHERE productId = ?");
            $stmtQuantityOld->bind_param("i", $productId);
            if($stmtQuantityOld->execute()){
                $result = $stmtQuantityOld->get_result();
                $quantityOld = 0;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $quantityOld += $row['quantity'];
                    }
                    return $quantityOld;
                }
            }
        }
    }
    /* ------------------------------ QUANTITY OLD ------------------------------ */
        /* --------------------------------- SELECT --------------------------------- */
        function quantityProductOnCart(){
            $userId = (isset($_SESSION["user"])) ? $_SESSION["user"]['id'] : "";
            $productId = (isset($_GET["id"])) ? $_GET["id"] : "";
            $stmt = $this->db->prepare("SELECT quantity FROM carts WHERE productId = ? AND userId = ?");
            $stmt->bind_param("ii", $productId,$userId);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $quantity = $row['quantity'];
                return $quantity;
            }else{
                return 0;
            }
        }
        /* --------------------------------- SELECT --------------------------------- */
}