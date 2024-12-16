<?php 
class Category_Model{
    private $db;
    public function __construct(mysqli $db){
        $this->db = $db;
    }
    /* --------------------------- SHOW CATEGOIES LIST -------------------------- */
    function showCategoriesList(){
        $stmt = $this->db->prepare("SELECT * FROM categories");
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                return $result;
            }
        }
    }
    /* --------------------------- SHOW CATEGOIES LIST -------------------------- */
    /* --------------------------- CREATE CATEGOIES -------------------------- */
    function createCategory(){
        $mess = "";
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            if(isset($_POST["add-category"])){
                $userId = $_SESSION["user"]['id'];
                $categoryName = $_POST["categoryName"];
                $description = $_POST["description"];
                
                if(!empty($categoryName) && !empty($description)){
                    $stmt = $this->db->prepare("INSERT INTO categories (`userId`,`categoryName`,`description`) VALUES (?,?,?)");
                    $stmt->bind_param("iss", $userId, $categoryName, $description);
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
    /* --------------------------- CREATE CATEGOIES -------------------------- */
    /* --------------------------- DATA CATEGORY OLD -------------------------- */
    function dataCategoryOld(){
        $id = isset($_GET["id"]) ? $_GET["id"] : "";
        if(!empty($id)){
            $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
            $stmt->bind_param("i",$id);
            if($stmt->execute()){
                $result = $stmt->get_result();
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    return $row;
                }
            }
        }
    }
    /* --------------------------- DATA CATEGORY OLD -------------------------- */
    /* --------------------------- EDIT CATEGORY -------------------------- */
    function editCategory(){
        $mess = "";
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            if(isset($_POST["edit-category"])){
                $id = $_GET["id"];
                $userId = $_SESSION["user"]['id'];
                $categoryName = $_POST["categoryName"];
                $description = $_POST["description"];
                
                if(!empty($id) && !empty($userId) && !empty($categoryName) && !empty($description)){
                    $stmt = $this->db->prepare("UPDATE categories SET userId = ?,categoryName = ?, description = ? WHERE id = ?");
                    $stmt->bind_param("issi", $userId, $categoryName, $description, $id);
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
    /* --------------------------- EDIT CATEGORY -------------------------- */
    /* --------------------------- DELETE CATEGORY -------------------------- */
    function deleteCategory(){
        $mess = "";
        $id = isset($_GET["id"]) ? $_GET["id"] : "" ;
        if(!empty($id)){
            $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
            $stmt->bind_param("i", $id);
            if($stmt->execute()){
                $mess = "Thành công";
            }else{
                $mess = "Lỗi";
            }
        }
        return $mess;
    }
    /* --------------------------- DELETE CATEGORY -------------------------- */
}
?>