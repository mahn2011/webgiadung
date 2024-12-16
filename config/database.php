<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'duan1_nhom10_db';

$db = new mysqli($host, $username, $password, $db_name);
if($db->connect_error){
    die("Kết nối database thất bại" . $db->connect_error);
}
if (!$db->set_charset("utf8")) {
    die("Lỗi không thể thiết lập utf8: " . $db->error);
}
return $db;
?>