<?php 
class Cart_Model{
    private $db;
    function __construct(mysqli $db){
        $this->db = $db;
    }
    /* ------------------------------- SHOW LIST CART ------------------------------ */
    function showCartList(){
        $userId = (isset($_SESSION["user"])) ? $_SESSION["user"]['id'] : "";
        if(!empty($userId) && is_numeric($userId)){
            $getIdCart = $this->db->prepare("SELECT productId FROM carts WHERE userId = ?");
            $getIdCart->bind_param("i", $userId);
            if($getIdCart->execute()){
                $listId = $getIdCart->get_result();
                if($listId->num_rows > 0){
                    $data = [];
                    while($row = $listId->fetch_assoc()){
                        $productId = $row['productId'];
                        $stmt = $this->db->prepare(
                            "SELECT products.id AS productId ,products.productName AS productName, products.image AS image, products.price AS price, carts.quantity AS quantity, products.quantity AS quantityPrd  
                            FROM carts
                            INNER JOIN products
                            ON carts.productId = products.id
                            WHERE products.id = ? AND userId = ?
                        ");
                        $stmt->bind_param("ii", $productId, $userId);
                        if($stmt->execute()){
                            $result = $stmt->get_result();
                            if($result->num_rows > 0){
                                $row = $result->fetch_assoc();
                                $data[] = $row;
                            }
                        }
                    }
                    return $data;
                }
            }
        }
    }
    /* ------------------------------- SHOW LIST CART ------------------------------ */
    /* ------------------------------- ADD TO CART ------------------------------ */
    function addToCart(){
        $mess = "";
        session_start();
        $userId = (isset($_SESSION["user"])) ? $_SESSION["user"]['id'] : "";
        $productId = (isset($_POST["productId"])) ? $_POST["productId"] : "";
        $quantity = (isset($_POST["quantity"])) ? $_POST["quantity"] : "";
        
        if(!empty($userId) && is_numeric($userId)){ // Kiểm tra đăng nhập chưa
            if(!empty($productId) && is_numeric($productId) && !empty($quantity) && is_numeric($quantity)){ // validate
                /* ---------------- Check sản phẩm đã được thêm từ trước chưa --------------- */
                $check = $this->db->prepare("SELECT * FROM carts WHERE userId = ? AND productId = ?");
                $check->bind_param("ii", $userId, $productId);
                if($check->execute()){
                    $result = $check->get_result();
                    if($result->num_rows === 1){ // Nếu đã có
                        $row = $result->fetch_assoc();
                        $dbQuantity = $row['quantity'];
                        $newQuantity = $quantity + $dbQuantity;
                        $update = $this->db->prepare("UPDATE carts SET quantity = ? WHERE productId = ? AND userId = ? ");
                        $update->bind_param("iii", $newQuantity, $productId, $userId);
                        if($update->execute()){
                            $mess = "Thành công";
                        }else{
                            $mess = "Lỗi";
                        }
                    }else{ // Nếu chưa có
                        $stmt = $this->db->prepare("INSERT INTO carts(`userId`,`productId`,`quantity`) VALUES (?,?,?)");
                        $stmt->bind_param("iii", $userId, $productId, $quantity);
                        if($stmt->execute()){
                            $mess = "Thành công";
                        }else{
                            $mess = "Lỗi";
                        }
                    }
                }
            }else{
                $mess = "Lỗi";
            }
        }else{
            $mess = "Bạn chưa đăng nhập";
        }
        return $mess;
    }
    /* ------------------------------- ADD TO CART ------------------------------ */
    /* ------------------------------- UPDATE QUANTITY CART ------------------------------ */
    function updateQuantityCart(){
        $mess = "";
        session_start();
        $userId = (isset($_SESSION["user"])) ? $_SESSION["user"]["id"] : "";
        $productId = (isset($_POST["productId"])) ? $_POST["productId"] : "";
        $action = (isset($_POST["action"])) ? $_POST["action"] : "";

        if(!empty($userId) && is_numeric($userId) && !empty($productId) && is_numeric($productId) && !empty($action)){
            /* -------------------------- Lấy số lượng sản phẩm ------------------------- */
            $check = $this->db->prepare("SELECT quantity FROM carts WHERE userId = ? AND productId = ?");
            $check->bind_param("ii", $userId, $productId);
            if($check->execute()){
                $result = $check->get_result();
                if($result->num_rows === 1){
                    $row = $result->fetch_assoc();
                    $dbQuantity = $row['quantity'];
                    if($action === "up"){
                        $dbQuantity++;
                    }
                    if($action === "down"){
                        $dbQuantity--;
                    }
                    // UPDATE QUANTITY
                    $update = $this->db->prepare("UPDATE carts SET quantity = ? WHERE userId = ? AND productId = ?");
                    $update->bind_param("iii", $dbQuantity, $userId, $productId);
                    if($update->execute()){
                        if($dbQuantity < 1){
                            $delete = $this->db->prepare("DELETE FROM carts WHERE userId = ? AND productId = ?");
                            $delete->bind_param("ii", $userId, $productId);
                            $delete->execute();
                        }
                    }else{
                        $mess = "Lỗi";
                    }
                    // UPDATE QUANTITY
                }
            }else{
                $mess = "Lỗi";
            }
        }else{
            $mess = "Lỗi";
        }
        return $dbQuantity;
    }
    /* ------------------------------- UPDATE QUANTITY CART ------------------------------ */
    /* ------------------------------- DELETE CART ------------------------------ */
    function deleteCart(){
        $mess = "";
        session_start();
        $userId = (isset($_SESSION["user"])) ? $_SESSION["user"]["id"] : "";
        $productId = (isset($_POST["productId"])) ? $_POST["productId"] : "";

        if(!empty($userId) && is_numeric($userId) && !empty($productId) && is_numeric($productId)){
            $stmt = $this->db->prepare("DELETE FROM carts WHERE userId = ? AND productId = ?");
            $stmt->bind_param("ii", $userId, $productId);
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
    /* ------------------------------- DELETE CART ------------------------------ */
    /* -------------------------------- QUANTITY CART -------------------------------- */
    function quantityCart(){
        $userId = (isset($_SESSION["user"])) ? $_SESSION["user"]['id'] : "";
        if(isset($userId) && is_numeric($userId)){
            $stmt = $this->db->prepare("SELECT * FROM carts WHERE userId = ?");
            $stmt->bind_param("i", $userId);
            if($stmt->execute()){
                $result = $stmt->get_result();
                $quantityCart = $result->num_rows;
                return $quantityCart;
                }
        }else{
            return 0;
        }
    }
    /* -------------------------------- QUANTITY CART -------------------------------- */
}
?>