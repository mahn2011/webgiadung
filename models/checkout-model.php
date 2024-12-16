<?php 
class Checkout_Model{
    private $db;
    function __construct(mysqli $db){
        $this->db = $db;
    }
    function checkout(){
        $mess = "";
        session_start();
        $userId = (isset($_SESSION["user"])) ? $_SESSION["user"]['id'] : "";
        $fullname = (isset($_POST["fullname"])) ? $_POST["fullname"] : "";
        $email = (isset($_POST["email"])) ? $_POST["email"] : "";
        $address = (isset($_POST["address"])) ? $_POST["address"] : "";
        $numberphone = (isset($_POST["numberphone"])) ? $_POST["numberphone"] : "";
        $note = (isset($_POST["note"])) ? $_POST["note"] : "";
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $createdate = date("Y-m-d H:i:s");
        $total = (isset($_POST["total"])) ? $_POST["total"] : "";
        $process = "send";
        $status = "unpaid";

        if(!empty($userId) && is_numeric($userId)){
            if(!empty(trim($fullname)) && !empty(trim($email)) && !empty(trim($address)) && !empty(trim($numberphone)) ){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    // Thêm thông tin người dùng
                    // Check người dùng đã có thông tin chưa
                    $checkInformation = $this->db->prepare("SELECT * FROM userinformation WHERE userId = ?");
                    $checkInformation->bind_param("i",$userId);
                    if($checkInformation->execute()){
                        $resultCheck = $checkInformation->get_result();
                        if($resultCheck->num_rows > 0){
                            $updateInformation = $this->db->prepare("UPDATE userinformation SET fullName = ?, email = ?, address = ?, numberphone = ? WHERE userId = ?");
                            $updateInformation->bind_param("ssssi", $fullname, $email, $address, $numberphone, $userId);
                            $updateInformation->execute();
                        }else{
                            $createInformation = $this->db->prepare("INSERT INTO userinformation (`userId`,`fullName`,`email`,`address`,`numberphone`) VALUES (?,?,?,?,?)");
                            $createInformation->bind_param("issss", $userId, $fullname, $email, $address, $numberphone);
                            $createInformation->execute();
                        }
                        /* --------------------- SAU KHI XỬ LÍ THÔNG TIN CÁ NHÂN -------------------- */
                        // Tạo đơn hàng tổng quát
                        $createOrder = $this->db->prepare("INSERT INTO orders(`userId`,`createdate`,`total`,`note`,`process`,`status`) VALUES (?,?,?,?,?,?)");
                        $createOrder->bind_param("isisss", $userId, $createdate, $total, $note, $process, $status);
                        if($createOrder->execute()){
                            $orderId = $createOrder->insert_id; // Lấy id của đơn hàng vừa thêm
                            // Lấy tất cả sản phẩm trong giỏ hàng
                            $allCart = $this->db->prepare(
                                "SELECT carts.productId AS productId, carts.quantity AS quantity, products.price AS price 
                                FROM carts
                                INNER JOIN products 
                                ON carts.productId = products.id
                                WHERE userId = ?"
                            );
                            $allCart->bind_param("i", $userId);
                            if($allCart->execute()){
                                $resultAllCart = $allCart->get_result();
                                $quantityCart = $resultAllCart->num_rows;
                                $quantityCompleted = 0;
                                // Tạo đơn hàng chi tiết
                                while($aOrderDetails = $resultAllCart->fetch_assoc()){
                                    $producyId = $aOrderDetails['productId'];
                                    $quantity = $aOrderDetails['quantity'];
                                    $price = $aOrderDetails['price'];
                                    $total = $quantity * $price;
                                    $createOrderDetails = $this->db->prepare("INSERT INTO orderdetails (`orderId`,`productId`,`quantity`,`price`,`total`) VALUES (?,?,?,?,?)");
                                    $createOrderDetails->bind_param("iiiii", $orderId, $producyId, $quantity, $price,$total);
                                    if($createOrderDetails->execute()){
                                        $quantityCompleted ++;
                                    }
                                }
                                if($quantityCart === $quantityCompleted){
                                    // Xóa cart
                                    $deleteCart = $this->db->prepare("DELETE FROM carts WHERE userId = ?");
                                    $deleteCart->bind_param("i", $userId);
                                    if($deleteCart->execute()){
                                        $mess = "Thành công";
                                    }
                                }else{
                                    $mess = "Chưa đủ";
                                }
                            }else{
                                $mess = "Lỗi1";
                            }
                        }else{
                            $mess = "Lỗi2";
                        }
                        /* --------------------- SAU KHI XỬ LÍ THÔNG TIN CÁ NHÂN -------------------- */
                    }
                }else{
                    $mess = "Email không hợp lệ";
                }
            }else{
                $mess = "Lỗi";
            }
        }else{
            $mess = "Bạn chưa đăng nhập";
        }
        return $mess;
    }
}
?>